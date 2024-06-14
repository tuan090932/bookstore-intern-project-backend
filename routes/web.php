<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
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

Route::prefix('admin')->group(function ()
{

    Route::get('/', [DashboardController::class, 'indexPage'])->name('admin.dashboard');
    Route::get('register', [AuthController::class, 'register'])->name('admin.register');
    Route::post('register', [AuthController::class, 'store'])->name('admin.register.submit');
    Route::get('login', [AuthController::class, 'loginForm'])->name('admin.login');
    Route::post('login', [AuthController::class, 'login'])->name('admin.login.submit');
    Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::get('profile', [AuthController::class, 'showProfile'])->name('admin.profile');
    Route::get('profile/edit', [AuthController::class, 'editProfile'])->name('admin.profile.edit');
    Route::put('profile/update/{id}', [AuthController::class, 'updateProfile'])->name('admin.profile.update');

});

Route::get('/api/districts/{provinceId}', [LocationController::class, 'getDistricts']);
Route::get('/api/wards/{districtId}', [LocationController::class, 'getWards']);

Route::resource('admin/books', BookController::class);
Route::get('admin/dashboard', [DashboardController::class, 'indexPage'])->name('dashboard');
Route::get('/books/search', [BookController::class, 'search'])->name('books.search');

Route::prefix('admin')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});
