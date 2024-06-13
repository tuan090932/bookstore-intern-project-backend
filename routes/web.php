<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AuthController;
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

Route::get('/admin/register', [AuthController::class, 'register'])->name('admin.register');
Route::post('/admin/register', [AuthController::class, 'store'])->name('admin.store');

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
