<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Services\AuthService;
use Auth;
use Exception;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Password;
use Request;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function showResetPasswordForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function notice()
    {
        return view('auth.verify-email');
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        return $this->authService->login($validated);
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $result = $this->authService->register($validated);
        if (!$result) {
            return redirect()->route('register')->with('error', 'Đăng ký thất bại');
        }
        return redirect()->route('login')->with('success', 'Đăng ký thành công');
    }

    public function logout()
    {
        $result = $this->authService->logout();

        if ($result) {
            return redirect()->route('frontend.index');
        }
    }


    public function facebookRedirect()
    {
        return $this->authService->facebookRedirect();
    }

    public function facebookCallback()
    {
        try {
            $user = $this->authService->facebookCallback();

            if ($user) {
                Auth::login($user);

                if ($user->role == 0) {
                    return redirect()->route('frontend.index')->with('success', 'Đăng nhập thành công');
                } else {
                    return redirect()->route('admin.index')->with('success', 'Đăng nhập thành công');
                }
            }

            return redirect()->route('login')->with('error', 'Không thể đăng nhập bằng Facebook.');
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', $e->getMessage());
        }
    }

    public function googleRedirect()
    {
        return $this->authService->googleRedirect();
    }

    public function googleCallback()
    {
        try {
            $user = $this->authService->googleCallback();

            if ($user) {
                Auth::login($user);

                if ($user->role == 0) {
                    return redirect()->route('frontend.index')->with('success', 'Đăng nhập thành công');
                } else {
                    return redirect()->route('admin.index')->with('success', 'Đăng nhập thành công');
                }
            }

            return redirect()->route('login')->with('error', 'Không thể đăng nhập bằng Google.');
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', $e->getMessage());
        }
    }

    public function sendResetLink(ForgotPasswordRequest $request)
    {
        $validated = $request->validated();
        return $this->authService->sendResetLink($validated);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        $validated = $request->validated();
        return $this->authService->resetPassword($validated);
    }

    public function verify(EmailVerificationRequest $request)
    {
        $result = $this->authService->verify($request);

        if ($result) {
            return redirect()->route('frontend.index')->with('success', 'Email của bạn đã được xác minh.');
        }

        return redirect()->route('frontend.index')->with('error', 'Không thể xác minh email của bạn.');
    }

    public function resend()
    {
        $user = Auth::user();
        $result = $this->authService->resend($user);

        if ($result) {
            return back()->with('info', 'Email của bạn đã được xác minh.');
        }

        return back()->with('success', 'Email đã được gửi thanh công.');
    }
}
