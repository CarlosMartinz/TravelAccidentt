<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(Request $request)
    {
        $userLogin = Socialite::driver('facebook')->user();
        $user = User::where('email', $userLogin->getEmail())->first();
        if ($user) {
            Auth::login($user);
            return redirect('/dash');
        } else {
            $user = new User();
            $user->name = $userLogin->getName();
            $user->email = $userLogin->getEmail();
            $user->password = bcrypt($userLogin->getId());
            $user->save();
            Auth::login($user);
            return redirect('/dash');
        }
    }
}
