<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\UserController;
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

Route::get('/login', function () {
    return view('admin.pages.auth.login');
})->name('login');
Route::get('/register', function () {
    return view('admin.pages.auth.register');
})->name('register');
Route::get('/forgot-password', function () {
    return view('admin.pages.auth.forgot-password');
})->name('forgot-password');

//Users
Route::resource('users', UserController::class);

Route::prefix('admin')->group(function(){

    //Dashboard
    Route::get('/', [DashboardController::class, 'indexPage'])->name('dashboard');

    //Books
    Route::resource('books', BookController::class);
    Route::get('books/search', [BookController::class, 'search'])->name('books.search');

    //Languages
    Route::resource('languages', LanguageController::class);
});



