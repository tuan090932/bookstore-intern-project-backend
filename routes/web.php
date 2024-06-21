<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
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

Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
Route::resource('admin/books', BookController::class);

Route::get('/', function () {
    return redirect('/admin');
});

Route::prefix('admin')->group(function () {
    Route::get('register', [AuthController::class, 'register'])->name('admin.register');
    Route::post('register', [AuthController::class, 'store'])->name('admin.register.submit');
    Route::get('login', [AuthController::class, 'loginForm'])->name('admin.login');
    Route::post('login', [AuthController::class, 'login'])->name('admin.login.submit');
    Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::get('/', [DashboardController::class, 'indexPage'])->name('admin.dashboard');

    Route::middleware(['auth.admin'])->group(function () {
        Route::get('profile', [AuthController::class, 'showProfile'])->name('admin.profile');
        Route::get('profile/edit', [AuthController::class, 'editProfile'])->name('admin.profile.edit');
        Route::put('profile/update/{id}', [AuthController::class, 'updateProfile'])->name('admin.profile.update');

        Route::middleware('role:ALL')->group(function () {
            Route::get('admins-account', [AdminController::class, 'index'])->name('admin.admins-account');
        });

        Route::middleware('role:ALL,MG,CUST')->group(function () {
            Route::resource('users', UserController::class);
        });

        Route::middleware('role:ALL,MG,BOOK')->group(function () {
            Route::resource('books', BookController::class);
        });

        Route::middleware('role:ALL,MG,AUTHO')->group(function () {
            Route::resource('authors', AuthorController::class);
        });
    });
});


