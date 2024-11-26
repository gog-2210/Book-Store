<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Backend\DashboardController;
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

Route::middleware('auth')->group(function () {
    // Frontend routes
    Route::get('/gio-hang', function () {
        return view('frontend.cart');
    })->name('frontend.cart');

    Route::get('/tai-khoan', function () {
        return view('frontend.profile');
    })->name('frontend.profile');

    Route::get('/dat-hang', function () {
        return view('frontend.orders');
    })->name('frontend.orders');

    // Backend routes
    Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.index');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

