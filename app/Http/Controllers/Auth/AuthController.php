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

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        return $this->authService->login($validated);
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $result = $this->authService->register($validated);
        if ($result) {
            return redirect()->route('login')->with('success', 'Đăng ký thành công');
        }
        return redirect()->route('register')->with('error', 'Đăng ký thất bại');
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
}
