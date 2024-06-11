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

Route::get('admin/books', [BookController::class, 'index'])->name('books.index');
Route::get('admin/books/create', [BookController::class, 'create'])->name('books.create');
Route::get('admin/books/edit', [BookController::class, 'edit'])->name('books.edit');
Route::get('admin/books/update', [BookController::class, 'update'])->name('books.update');
Route::get('admin/books/search',[BookController::class, 'search'])->name('books.search');

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
Route::get('admin/language/create', [LanguageController::class, 'create'])->name('languages.create');
Route::get('admin/languages/edit', [LanguageController::class, 'edit'])->name('languages.edit');
Route::get('admin/languages/update', [LanguageController::class, 'update'])->name('languages.update');

Route::resource('languages', LanguageController::class);