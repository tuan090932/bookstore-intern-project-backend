<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FavoriteRequest;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Book;
use Tymon\JWTAuth\Exceptions\JWTException;

class FavoriteController extends Controller
{
    /**
     * Create a new FavoriteController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except('getFavorites');
    }

    /**
     * Add a book to favorites.
     *
     * @param FavoriteRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addFavorite(FavoriteRequest $request)
    {
        try {
            $user = auth('api')->user();

            if (Favorite::where('user_id', $user->user_id)->where('book_id', $request->book_id)->exists()) {
                return response()->json(['message' => 'Book already in favorites'], 400);
            }
            if (!Book::where('book_id', $request->book_id)->exists()) {
                return response()->json(['message' => 'Book not found'], 404);
            }

            $favorite = Favorite::create([
                'user_id' => $user->user_id,
                'book_id' => $request->book_id,
            ]);

            return response()->json(['message' => 'Favorite added successfully', 'favorite' => $favorite], 201);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error occurred: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove a book from favorites.
     *
     * @param Favorite $favorite
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeFavorite($favoriteId)
    {
        try {
            $user = auth('api')->user();
            $favorite = Favorite::where('user_id', $user->user_id)->where('favorite_id', $favoriteId)->first();
            if (!$favorite) {
                return response()->json(['message' => 'Favorite not found'], 404);
            }
            $favorite->delete();
            return response()->json(['message' => 'Favorite removed successfully'], 200);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error occurred: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Get all favorites for the authenticated user.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getFavorites(Request $request)
    {
        try {
            $user = auth('api')->user();

            $favorites = Favorite::where('user_id', $user->user_id)
                ->with('book')
                ->get();
            
            return response()->json(['favorites' => $favorites], 200);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error occurred: ' . $e->getMessage()], 500);
        }
    }
}
