<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        $parameters = ['access_type' => 'offline'];
        return Socialite::driver('google')->scopes(['https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/userinfo.profile'])->redirect(env('GOOGLE_REDIRECT_URI'), $parameters);
    }
    public function callback()
    {
        $userLogin = Socialite::driver('google')->stateless()->user();
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
