<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\CategoryController;
use App\Models\Author;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\LocationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController;
use App\Jobs\SendEmail;


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

Route::get('admin/dashboard', [DashboardController::class, 'indexPage'])->name('dashboard');
Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
Route::resource('admin/books', BookController::class);

Route::get('/', function () {
    return redirect('/admin');
});

Route::prefix('admin')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('addresses', AddressController::class);

    Route::get('/', [DashboardController::class, 'indexPage'])->name('admin.dashboard');
    Route::get('register', [AuthController::class, 'register'])->name('admin.register');
    Route::post('register', [AuthController::class, 'store'])->name('admin.register.submit');
    Route::get('login', [AuthController::class, 'loginForm'])->name('admin.login');
    Route::post('login', [AuthController::class, 'login'])->name('admin.login.submit');
    Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::get('profile', [AuthController::class, 'showProfile'])->name('admin.profile');
    Route::get('profile/edit', [AuthController::class, 'editProfile'])->name('admin.profile.edit');
    Route::put('profile/update/{id}', [AuthController::class, 'updateProfile'])->name('admin.profile.update');

    Route::delete('authors/delete-selected', [AuthorController::class, 'deleteSelected'])->name('authors.delete-selected');
    Route::delete('authors/delete-all', [AuthorController::class, 'deleteAll'])->name('authors.delete-all');

    Route::get('authors/trashed', [AuthorController::class, 'trashed'])->name('authors.trashed');
    Route::patch('authors/restore-selected', [AuthorController::class, 'restoreSelected'])->name('authors.restore-selected');
    Route::patch('authors/restore-all', [AuthorController::class, 'restoreAll'])->name('authors.restore-all');
    Route::patch('authors/{id}/restore', [AuthorController::class, 'restore'])->name('authors.restore');

    Route::resource('authors', AuthorController::class);
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/{id}', [OrderController::class, 'show'])->name('orders.show');
        Route::put('/{id}', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
        Route::delete('delete/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
        Route::post('/orders/send-email/{order}', [OrderController::class, 'sendEmail'])->name('orders.sendEmail');
    });    
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('store', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('update/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('destroy/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });
});


