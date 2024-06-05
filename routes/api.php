<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\RegisterController;

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
    'prefix' => 'auth'

], function () {
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::get('profile', [AuthController::class, 'profile']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);

});
