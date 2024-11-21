<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function facebookPage()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $findUser = User::where('email', $user->email)->first();
            if ($findUser) {
                Auth::login($findUser);
                return redirect()->intended('dashboard');
            } else {
                $newUser = User::updateOrCreate(
                    [
                        'email' => $user->email,
                    ],
                    [
                        'name' => $user->name,
                        'facebook_id' => $user->id,
                        'password' => bcrypt('12345678')
                    ],
                );
                Auth::login($newUser);
                return redirect()->intended('dashboard');
            }
        } catch (Exception $e) {
            return redirect('/')->with('error', 'Something went wrong');
        }

    }
}
