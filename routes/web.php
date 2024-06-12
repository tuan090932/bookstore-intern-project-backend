<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Models\Author;
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

Route::resource('admin/books', BookController::class);

Route::group([

    'prefix' => 'admin'

], function ()
{

    Route::get('authors/trashed', [AuthorController::class, 'trashed'])->name('authors.trashed');
    Route::delete('authors/deleteSelected', [AuthorController::class, 'deleteSelected'])->name('authors.deleteSelected');
    Route::get('authors/delete-all', [AuthorController::class, 'deleteAll'])->name('authors.delete-all');
    Route::patch('authors/restore-selected', [AuthorController::class, 'restoreSelected'])->name('authors.restore-selected');
    Route::patch('authors/restore-all', [AuthorController::class, 'restoreAll'])->name('authors.restore-all');
    Route::get('authors/search', [AuthorController::class, 'search'])->name('authors.search');
    Route::resource('authors', AuthorController::class);
    Route::patch('authors/{id}/restore', [AuthorController::class, 'restore'])->name('authors.restore');

});
