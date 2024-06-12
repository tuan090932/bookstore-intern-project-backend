<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

/**
 * API Routes for Authentication
 *
 * This route group handles all authentication-related API endpoints.
 * The group is prefixed with 'api/auth' and requires the 'api' middleware.
 *
 * Endpoints:
 * - POST /api/auth/login: Handles user login and returns an access token.
 * - GET /api/auth/profile: Retrieves the authenticated user's profile information.
 * - POST /api/auth/logout: Logs out the authenticated user and invalidates the access token.
 * - POST /api/auth/refresh: Refreshes the access token for the authenticated user.
 *
 * These endpoints use the `AuthController` to handle the corresponding logic.
 *
 * The following api with API routes bellow:
 *
 * 127.0.0.1/api/auth/{action}
 * Example: 127.0.0.1/api/auth/login
 */

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth',

], function ()
{

    Route::post('register', [RegisterController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::get('profile', [AuthController::class, 'profile']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);

});

/**
 * API Routes for Books
 *
 * This route group handles all book-related API endpoints.
 * The group is prefixed with 'api/books'.
 *
 * Endpoints:
 * - GET /api/books: Retrieves a list of all books.
 * - GET /api/books/{id}: Retrieves a specific book by its ID.

 * These endpoints use the `BookController` to handle the corresponding logic.
 *
 * The following api with API routes bellow:
 *
 * 127.0.0.1/api/books
 * Example: 127.0.0.1/api/books/
 */
Route::group([
    'prefix' => 'books',
], function () {
    Route::get('/', [BookController::class, 'index']);
    Route::get('/{id}', [BookController::class, 'show']);
});

/**
 * API Routes for Categories
 *
 * This route group handles all category-related API endpoints.
 * The group is prefixed with 'api/categories'.
 *
 * Endpoints:
 * - GET /api/categories: Retrieves a list of all categories.
 *
 * These endpoints use the `CategoryController` to handle the corresponding logic.
 *
 * The following api with API routes bellow:
 *
 * 127.0.0.1/api/categories
 * Example: 127.0.0.1/api/categories/
 */
Route::group([
    'prefix' => 'categories',
], function () {
    Route::get('/', [CategoryController::class, 'index']);
});

/**
 * API Routes for Address
 *
 * This route group handles all address-related API endpoints.
 * The group is prefixed with 'api/address'.
 *
 * Endpoints:
 * - GET /api/address: Retrieves a list of all addresses.
 * - POST /api/address: Creates a new address.
 * - GET /api/address/{id}: Retrieves a specific address by ID.
 * - PUT /api/address/{id}: Updates a specific address by ID.
 *
 * These endpoints use the `AddressController` to handle the corresponding logic.
 *
 * The following api with API routes bellow:
 */
Route::prefix('address')->group(function () {
    Route::get('/', [AddressController::class, 'index']);
    Route::post('/', [AddressController::class, 'store']);
    Route::get('/{id}', [AddressController::class, 'show']);
    Route::put('/{id}', [AddressController::class, 'update']);
    Route::delete('/{id}', [AddressController::class, 'destroy']);
});
