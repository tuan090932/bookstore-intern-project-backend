<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use App\Models\CartItem;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\AddCartItemRequest;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    /**
     * Get the cart items for a specific user.
     *
     * @param int $userId The ID of the user whose cart items are to be retrieved.
     * @return \Illuminate\Http\JsonResponse A JSON response containing the cart items or an error message.
     */
    public function index($userId)
    {
        try {
            $user = User::findOrFail($userId);
            $cart = Cart::where('user_id', $user->id)->with('cartItems')->firstOrFail();
            return response()->json($cart->cartItems);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'User or cart not found.', 'exception' => $e->getMessage()], 404);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Add an item to the cart.
     *
     * @param AddCartItemRequest $request The request object containing the cart item data.
     * @return \Illuminate\Http\JsonResponse A JSON response containing the newly added cart item or an error message.
     */
    public function store(AddCartItemRequest $request)
    {
        try {
            $user = User::findOrFail($request->user_id);
            $cart = Cart::firstOrCreate(['user_id' => $user->id]);
            $cartItem = CartItem::create([
                'cart_id' => $cart->cart_id,
                'book_id' => $request->book_id,
                'quantity' => $request->quantity
            ]);
            return response()->json($cartItem, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove an item from the cart.
     *
     * @param int $cartItemId The ID of the cart item to be removed.
     * @return \Illuminate\Http\JsonResponse A JSON response indicating the result of the deletion.
     */
    public function destroyItem($cartItemId)
    {
        try {
            $cartItem = CartItem::findOrFail($cartItemId);
            $cartItem->delete();
            return response()->json(['message' => 'Item removed successfully.'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Cart item not found.', 'exception' => $e->getMessage()], 404);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
