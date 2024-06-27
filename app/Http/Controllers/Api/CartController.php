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
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
class CartController extends Controller
{

     public function __construct()
     {
         $this->middleware('auth:api');
     }

    /**
     * Get the cart items for the authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse A JSON response containing the cart items or an error message.
     */
    public function index()
    {
        try {
            $user = auth('api')->user();
            $cart = Cart::where('user_id', $user->user_id)->with('cartItems')->firstOrFail();
            return response()->json($cart->cartItems);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => __('messages.cart.not_found'), 'exception' => $e->getMessage()], 404);
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
            $user = auth('api')->user();
            $cart = Cart::firstOrCreate(['user_id' => $user->user_id]);
            $cartItem = CartItem::where('cart_id', $cart->cart_id)->where('book_id', $request->book_id)->first();
            if ($cartItem) {
                $cartItem->quantity += $request->quantity;
                $cartItem->save();
            } else {
                $cartItem = CartItem::create([
                    'cart_id' => $cart->cart_id,
                    'book_id' => $request->book_id,
                    'quantity' => $request->quantity
                ]);
            }
            return response()->json(['cartItem' => $cartItem, 'message' => __('messages.cart.item_added_success')], 201);
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
            $user = auth('api')->user();
            $cart = Cart::where('user_id', $user->user_id)->firstOrFail();
            $cartItem = CartItem::where('cart_id', $cart->cart_id)->where('item_id', $cartItemId)->firstOrFail();
            $cartItem->delete();
            return response()->json(['message' => __('messages.cart.item_removed_success')], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => __('messages.cart.item_not_found'), 'exception' => $e->getMessage()], 404);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
