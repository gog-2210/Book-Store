<?php
namespace App\Services;

use App\Models\User;
use Auth;
use Exception;
use Hash;
use Illuminate\Auth\Events\PasswordReset;
use Laravel\Socialite\Facades\Socialite;
use Log;
use Password;
use Psy\Readline\Hoa\Console;
use Str;

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
            // Nếu user.email đã tồn tại nhưng chưa có facebook_id, cập nhật thêm facebook_id
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

            if(!$user->email_verified_at){
                $user->update([
                    'email_verified_at' => now(),
                ]);
            }

            return $user;
        }

        // Tạo user mới nếu không tồn tại
        $user = User::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt(uniqid()),
        ]);

        return $user;
    }

    public function sendResetLink($validated)
    {
        // Gửi email với reset link
        $status = Password::sendResetLink($validated);

        if ($status !== Password::RESET_LINK_SENT) {
            return redirect()->route('password.request')->with('error', 'Không thể gửi email reset password.');
        }
        return redirect()->route('password.request')->with('success', 'Email reset password đã được gửi.');
    }

    public function resetPassword($validated)
    {
        // Thực hiện reset mật khẩu
        $status = Password::reset(
            $validated,
            function ($user) use ($validated) {
                $user->forceFill([
                    'password' => $validated['password'],
                ])->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', 'Đổi mật khẩu thành công.');
        } elseif ($status == Password::INVALID_TOKEN) {
            return redirect()->route('login')->with('error', 'Mã xác thực không hợp lệ.');
        } else {
            return redirect()->route('login')->with('error', 'Thay đổi mật khẩu thất bại.');
        }

    }
}
