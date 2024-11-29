<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\ProfileController;
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

Route::get('/', function () {
    return view('frontend.index');
})->name('frontend.index');


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

Route::middleware(['auth', 'verified'])->group(function () {

    // Frontend routes
    Route::get('/tai-khoan', [ProfileController::class, 'index'])->name('profile');
    Route::put('/tai-khoan', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/tai-khoan', [ProfileController::class, 'changePassword'])->name('profile.changePassword');
    Route::delete('/tai-khoan', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/gio-hang', [CartController::class, 'index'])->name('cart');
    Route::post('/gio-hang', [CartController::class, 'store'])->name('cart.store');//chưa xử lý
    Route::put('/gio-hang/{item}', [CartController::class, 'update'])->name('cart.update');//chưa xử lý
    Route::delete('/gio-hang/{item}', [CartController::class, 'destroy'])->name('cart.destroy');//chưa xử lý
    Route::get('/gio-hang/lam-moi', [CartController::class, 'clear'])->name('cart.clear');//chưa xử lý

    Route::get('/thanh-toan', [CheckoutController::class, 'index'])->name('checkout.index');//chưa xử lý

    Route::get('/dat-hang', [OrderController::class, 'index'])->name('order');//chưa xử lý
    Route::post('/dat-hang', [OrderController::class, 'store'])->name('order.store');//chưa xử lý
    Route::get('/dat-hang/{id}', [OrderController::class, 'show'])->name('order.show');//chưa xử lý





    // Backend routes
    Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.index');

    });
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

