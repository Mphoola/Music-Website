<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class SocialLoginController extends Controller
{
    public function redirect_to($provider){
        return Socialite::driver($provider)->redirect();
    }

    public function callback($prov){

        try {
            $user = Socialite::driver($prov)->user();
        } catch (InvalidStateException $e) {
            $user = Socialite::driver($prov)->stateless()->user();
        }
        
        $authUser = User::firstOrCreate(
            ['email' => $user->email], 
            ['name' => $user->name]
        );
        Auth::login($authUser, true);
        return redirect('/home');
        
    }

}
