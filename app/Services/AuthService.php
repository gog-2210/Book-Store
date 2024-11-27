<?php
namespace App\Services;

use App\Models\User;
use Auth;
use Exception;
use Laravel\Socialite\Facades\Socialite;
use Log;

class AuthService
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function login($validated)
    {
        if (Auth::attempt($validated)) {

            $user = Auth::user();

            if ($user->role == 0) {
                return redirect()->route('frontend.index')->with('success', 'Đăng nhập thành công');
            } else {
                return redirect()->route('admin.index')->with('success', 'Đăng nhập thành công');
            }
        }

        return redirect()->route('login')->with('error', 'Đăng nhập thất bại');
    }

    public function register($validated)
    {
        try {
            return $this->model->create($validated);
        } catch (Exception $e) {
            Log::error($e);

            return false;
        }
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return true;
    }

    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookCallback()
    {
        $facebookUser = Socialite::driver('facebook')->stateless()->user();

        $user = User::where('email', $facebookUser->getEmail())->first();

        if ($user) {
            // Nếu user đã tồn tại nhưng chưa có facebook_id, cập nhật thêm facebook_id
            if (!$user->facebook_id) {
                $user->update([
                    'facebook_id' => $facebookUser->getId(),
                ]);
            }

            if ($user->block) {
                throw new Exception('Tài khoản của bạn đã bị khóa. Vui lòng liên hệ bộ phận hỗ trợ.');
            }
            return $user;
        }

        $facebookId = User::where('facebook_id', $facebookUser->getId())->first();

        if ($facebookId) {
            return $facebookId;
        }

        // Tạo user mới nếu không tồn tại
        $user = User::create([
            'name' => $facebookUser->getName(),
            'email' => $facebookUser->getEmail(),
            'facebook_id' => $facebookUser->getId(),
            'password' => bcrypt(uniqid()),
        ]);

        return $user;
    }

    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            if ($user->block) {
                throw new Exception('Tài khoản của bạn đã bị khóa. Vui lòng liên hệ bộ phận hỗ trợ.');
            }
            return $user;
        }

        // Tạo user mới nếu không tồn tại
        $user = User::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'password' => bcrypt(uniqid()),
        ]);

        return $user;
    }
}
