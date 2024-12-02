<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Backend\PaymentController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Backend\CartController;
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

    Route::get('/dat-hang', [HomeController::class, 'purchaseOrder'])->name('order');
    Route::get('/dat-hang/{orderId}', [HomeController::class, 'purchaseOrderDetail'])->name('order.show');



    // Admin routes
    Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.index');

    });
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

