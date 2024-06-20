<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\AddressController;
use App\Models\Author;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\LocationController;
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

Route::get('/forgot-password', function () {
    return view('admin.pages.auth.forgot-password');
})->name('forgot-password');




Route::prefix('admin')->group(function () {
    Route::middleware(['auth.admin'])->group(function () {
        Route::resource('/books', BookController::class);
        Route::get('/dashboard', [DashboardController::class, 'indexPage'])->name('dashboard');
        Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
        Route::resource('/books', BookController::class);
        Route::resource('/authors', AuthorController::class);

        Route::resource('users', UserController::class);
        Route::resource('addresses', AddressController::class);

        Route::get('/', [DashboardController::class, 'indexPage'])->name('admin.dashboard');
        Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');
        Route::get('profile', [AuthController::class, 'showProfile'])->name('admin.profile');
        Route::get('profile/edit', [AuthController::class, 'editProfile'])->name('admin.profile.edit');
        Route::put('profile/update/{id}', [AuthController::class, 'updateProfile'])->name('admin.profile.update');
    });



    Route::get('register', [AuthController::class, 'register'])->name('admin.register');
    Route::post('register', [AuthController::class, 'store'])->name('admin.register.submit');
    Route::get('login', [AuthController::class, 'loginForm'])->name('admin.login');
    Route::post('login', [AuthController::class, 'login'])->name('admin.login.submit');
});


Route::prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/{id}', [OrderController::class, 'show'])->name('orders.show');
});
