<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AddressController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('admin.pages.auth.login');
})->name('login');
Route::get('/register', function () {
    return view('admin.pages.auth.register');
})->name('register');
Route::get('/forgot-password', function () {
    return view('admin.pages.auth.forgot-password');
})->name('forgot-password');

Route::get('admin/dashboard', [DashboardController::class, 'indexPage'])->name('dashboard');
// Route::get('admin/users', [UserController::class, 'index'])->name('users.index');
// Route::get('admin/users/create', [UserController::class, 'create'])->name('users.create');
Route::resource('/admin/users', UserController::class)->names([
    'index' => 'users.index',
    'create' => 'users.create',
    'store' => 'users.store',
    'show' => 'users.show',
    'edit' => 'users.edit',
    'update' => 'users.update',
    'destroy' => 'users.destroy',
]);

Route::post('admin/addresses', [AddressController::class, 'store'])->name('addresses.store');

Route::get('admin/books', [BookController::class, 'index'])->name('books.index');
Route::get('admin/books/create', [BookController::class, 'create'])->name('books.create');
Route::get('admin/books/edit', [BookController::class, 'show'])->name('books.edit');
