<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'indexPage'])->name('dashboard');

Route::get('/login', function () {
    return view('admin.pages.auth.login');
})->name('login');
Route::get('/register', function () {
    return view('admin.pages.auth.register');
})->name('register');
Route::get('/forgot-password', function () {
    return view('admin.pages.auth.forgot-password');
})->name('forgot-password');

Route::resource('admin/users', UserController::class);

Route::resource('admin/books', BookController::class);
Route::get('admin/dashboard', [DashboardController::class, 'indexPage'])->name('dashboard');
Route::get('admin/users', [UserController::class, 'index'])->name('users.index');
Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
Route::resource('admin/books', BookController::class);

Route::get('/', [DashboardController::class, 'indexPage'])->name('dashboard');



/**
 * Web Routes for Admin Panel
 *
 * This route group handles all admin-related web endpoints.
 * The group is prefixed with 'admin'
 *
 * Endpoints:
 * - GET /admin/categories: Displays a list of categories.
 *
 * These endpoints use the `CategoryController` to handle the corresponding logic.
 *
 * The following web routes are listed below:
 *
 * Example: http://localhost/admin/categories
 */
Route::prefix('admin')->group(function () {

    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    });
});
