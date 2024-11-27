<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->stateless()->user();

            // service tìm id facebook trong database
            $user = User::where('facebook_id', $facebookUser->id)->first();

            if (!$user) {
                // TH3: Email hoặc ID Facebook chưa tồn tại
                $user = User::where('email', $facebookUser->email)->first();

                if (!$user) {
                    // Xử lý khi không có email
                    $email = $facebookUser->email ?? "facebook_{$facebookUser->id}@noemail.com";

                    $user = User::create([
                        'name' => $facebookUser->name ?? 'Người dùng Facebook',
                        'email' => $email,
                        'facebook_id' => $facebookUser->id,
                        'password' => bcrypt('default-password'), // Tùy chọn
                    ]);
                } else {
                    // TH4: Email tồn tại nhưng chưa có ID Facebook
                    $user->update(['facebook_id' => $facebookUser->id]);
                }
            }

            Auth::login($user);

            if (!$facebookUser->email) {
                // return redirect()->route('update.email')->with('warning', 'Vui lòng cập nhật email của bạn.');
            }

            if ($user->role == 0) {
                return redirect()->route('frontend.index')->with('success', 'Đăng nhập thành công');
            } else {
                return redirect()->route('admin.index')->with('success', 'Đăng nhập thành công');
            }

        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Đã xảy ra lỗi khi đăng nhập bằng Facebook.');
        }
    }
}
