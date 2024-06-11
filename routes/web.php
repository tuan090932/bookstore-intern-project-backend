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


Route::get('admin/users', [UserController::class, 'index'])->name('users.index');
Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
Route::resource('admin/books', BookController::class);

Route::get('/', [DashboardController::class, 'indexPage'])->name('dashboard');

Route::resource('books', BookController::class);


/*
|--------------------------------------------------------------------------
| Languages Routes
|--------------------------------------------------------------------------
|
|
*/

Route::get('admin/language', [LanguageController::class, 'index'])->name('languages.index');    

Route::resource('languages', LanguageController::class);