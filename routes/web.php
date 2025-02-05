<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\CategoryController;
use App\Models\Author;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CommonController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController;


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

Route::get('/', function () {
    return redirect('/admin/dashboard');
});




Route::prefix('admin')->group(function () {
    Route::get('register', [AuthController::class, 'register'])->name('admin.register');
    Route::post('register', [AuthController::class, 'store'])->name('admin.register.submit');
    Route::get('login', [AuthController::class, 'loginForm'])->name('admin.login');
    Route::post('login', [AuthController::class, 'login'])->name('admin.login.submit');
    Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/common/show-confirm-modal', [CommonController::class, 'showConfirmModal'])->name('common.showConfirmModal');

    Route::middleware(['auth.admin'])->group(function () {
        Route::get('profile', [AuthController::class, 'showProfile'])->name('admin.profile');
        Route::get('profile/edit', [AuthController::class, 'editProfile'])->name('admin.profile.edit');
        Route::put('profile/update/{id}', [AuthController::class, 'updateProfile'])->name('admin.profile.update');

        Route::middleware('role:ALL')->group(function () {
            Route::delete('admins/delete-selected', [AdminController::class, 'deleteSelected'])->name('admins.delete-selected');
            Route::delete('admins/delete-all', [AdminController::class, 'deleteAll'])->name('admins.delete-all');

            Route::get('admins/trashed', [AdminController::class, 'trashed'])->name('admins.trashed');
            Route::patch('admins/restore-selected', [AdminController::class, 'restoreSelected'])->name('admins.restore-selected');
            Route::patch('admins/restore-all', [AdminController::class, 'restoreAll'])->name('admins.restore-all');
            Route::patch('admins/{id}/restore', [AdminController::class, 'restore'])->name('admins.restore');

            Route::resource('admins', AdminController::class);
        });

        Route::middleware('role:ALL,MG,CUST')->group(function () {
            Route::resource('users', UserController::class);
        });

        Route::middleware('role:ALL,MG,BOOK')->group(function () {
            Route::get('search', [BookController::class, 'search'])->name('books.search');
            Route::resource('books', BookController::class);
            Route::resource('languages', LanguageController::class);
        });

        Route::middleware('role:ALL,MG,AUTHO')->group(function () {
            Route::prefix('authors')->group(function () {
                Route::delete('delete-selected', [AuthorController::class, 'deleteSelected'])->name('authors.delete-selected');
                Route::delete('delete-all', [AuthorController::class, 'deleteAll'])->name('authors.delete-all');

                Route::get('trashed', [AuthorController::class, 'trashed'])->name('authors.trashed');
                Route::patch('restore-selected', [AuthorController::class, 'restoreSelected'])->name('authors.restore-selected');
                Route::patch('restore-all', [AuthorController::class, 'restoreAll'])->name('authors.restore-all');
                Route::get('authors/search', [AuthorController::class, 'search'])->name('authors.search');
                Route::patch('{id}/restore', [AuthorController::class, 'restore'])->name('authors.restore');
            });
            Route::resource('authors', AuthorController::class);
        });
        Route::middleware('role:ALL,MG,ORD')->group(function () {
            Route::prefix('orders')->group(function () {
                Route::get('/', [OrderController::class, 'index'])->name('orders.index');
                Route::get('/{id}', [OrderController::class, 'show'])->name('orders.show');
                Route::put('/{id}', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
                Route::delete('delete/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
                Route::post('/orders/send-email/{order}', [OrderController::class, 'sendOrderNotificationEmail'])->name('orders.sendEmail');
    });
        });
        Route::middleware('role:ALL,MG,CAT')->group(function () {
            Route::prefix('categories')->group(function () {
                Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
                Route::get('create', [CategoryController::class, 'create'])->name('categories.create');
                Route::post('store', [CategoryController::class, 'store'])->name('categories.store');
                Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
                Route::put('update/{id}', [CategoryController::class, 'update'])->name('categories.update');
                Route::delete('destroy/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
            });
        });
    });
});


