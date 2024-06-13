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

    // // Apply middleware to routes that require session handling
    // Route::middleware(['auth:admin', 'store.admin.session'])->group(function ()
    // {

    //     Route::get('/', [DashboardController::class, 'indexPage'])->name('admin.dashboard');
    //     // Other routes that require admin authentication and session handling
    // });

});

Route::resource('admin/users', UserController::class);

Route::resource('admin/books', BookController::class);
Route::get('admin/dashboard', [DashboardController::class, 'indexPage'])->name('dashboard');
Route::get('admin/users', [UserController::class, 'index'])->name('users.index');
Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
Route::resource('admin/books', BookController::class);

Route::get('/', [DashboardController::class, 'indexPage'])->name('dashboard');
