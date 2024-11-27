<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Show the registration form.
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }
    /**
     * Handle login functionality.
     */
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        if (Auth::attempt($validated)) {

            request()->session()->regenerate();

            $user = Auth::user();

            if ($user->role == 0) {
                return redirect()->route('frontend.index')->with('success', 'Đăng nhập thành công');
            } else {
                return redirect()->route('admin.index')->with('success', 'Đăng nhập thành công');
            }
        }

        return redirect()->route('login');
    }

    /**
     * Handle registration functionality.
     */
    public function register(RegisterRequest $request)
    {
        $userData = $request->validated();

        $this->userService->create($userData);

        return redirect()->route('login')->with('success', 'Đăng ký thành công');
    }

    /**
     * Log the user out.
     */
    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('frontend.index')->with('success', 'Đăng xuất thành công');
    }
}
