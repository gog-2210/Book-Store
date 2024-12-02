<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Backend\BookController;
use App\Http\Controllers\Backend\PaymentController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Backend\CartController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CompanyController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProfileController;
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

// Authentication routes
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/facebook', [AuthController::class, 'facebookRedirect'])->name('facebook');
    Route::get('auth/facebook/callback', [AuthController::class, 'facebookCallback']);

    Route::get('/google', [AuthController::class, 'googleRedirect'])->name('google');
    Route::get('auth/google/callback', [AuthController::class, 'googleCallback']);

    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::get('/email/verify', [AuthController::class, 'notice'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', [AuthController::class, 'resend'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('/', [HomeController::class, 'home'])->name('client.index');
Route::get('/sach/{bookId}', [HomeController::class, 'book'])->name('book.show');
Route::get('/danh-muc/{categoryId}', [HomeController::class, 'category'])->name('category.show');

Route::middleware(['auth', 'verified'])->group(function () {
    // Client routes
    Route::get('/tai-khoan', [ProfileController::class, 'index'])->name('profile');
    Route::put('/tai-khoan', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/tai-khoan', [ProfileController::class, 'changePassword'])->name('profile.changePassword');
    Route::delete('/tai-khoan', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/gio-hang', [CartController::class, 'index'])->name('cart');
    Route::post('/gio-hang', [CartController::class, 'store'])->name('cart.store');
    Route::put('/gio-hang/{cartId}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/gio-hang/{cartId}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/thanh-toan', [PaymentController::class, 'create'])->name('payment.create');
    Route::get('/thanh-toan/khoi-tao', [PaymentController::class, 'store'])->name('payment.store');
    Route::get('/thanh-toan/ket-qua', [PaymentController::class, 'return'])->name('payment.return');

    Route::get('/dat-hang', [HomeController::class, 'purchaseOrder'])->name('order');//chưa xử lý
    Route::get('/dat-hang/{orderId}', [HomeController::class, 'purchaseOrderDetail'])->name('order.show');//chưa xử lý



    // Admin routes
    Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.index');

        // Route for Categories
        Route::prefix('categories')->name('admin.categories.')->group(function () {
            // Route để hiển thị danh sách category
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            
            // Route để tạo mới category
            Route::get('create', [CategoryController::class, 'create'])->name('create');
            Route::post('create', [CategoryController::class, 'store'])->name('store');
            
            Route::get('{id}', [CategoryController::class, 'show'])->name('show'); 

            // Route để sửa category
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit');
            Route::put('edit/{id}', [CategoryController::class, 'update'])->name('update');
            
            // Route để xóa category
            Route::delete('delete/{id}', [CategoryController::class, 'destroy'])->name('destroy');    
            
            Route::post('admin/categories/getSubCategories', [CategoryController::class, 'getSubCategories'])->name('getSubCategories');

        });

        // Route for Companies
        Route::prefix('companies')->name('admin.companies.')->group(function () {
            // Route để hiển thị danh sách company
            Route::get('/', [CompanyController::class, 'index'])->name('index');

            // Route để tạo mới company
            Route::get('create', [CompanyController::class, 'create'])->name('create');
            Route::post('create', [CompanyController::class, 'store'])->name('store');

            // Route để hiển thị chi tiết company
            Route::get('{id}', [CompanyController::class, 'show'])->name('show');

            // Route để sửa company
            Route::get('edit/{id}', [CompanyController::class, 'edit'])->name('edit');
            Route::put('edit/{id}', [CompanyController::class, 'update'])->name('update');

            // Route để xóa company
            Route::delete('delete/{id}', [CompanyController::class, 'destroy'])->name('destroy');
        });

        // Route for Books
        Route::prefix('books')->name('admin.books.')->group(function () {
            // Hiển thị danh sách sách
            Route::get('/', [BookController::class, 'index'])->name('index');

            // Tạo mới sách
            Route::get('create', [BookController::class, 'create'])->name('create');
            Route::post('/', [BookController::class, 'store'])->name('store'); // Lưu sách mới

            // Sửa sách
            Route::get('/{book}/edit', [BookController::class, 'edit'])->name('edit'); // Trang chỉnh sửa sách
            Route::put('/{book}', [BookController::class, 'update'])->name('update'); // Cập nhật sách

            // Xóa sách
            Route::delete('delete/{id}', [BookController::class, 'destroy'])->name('destroy');
            
            // Chi tiết sách (nếu có cần)
            Route::get('{id}', [BookController::class, 'show'])->name('show');
        });

    });
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

