<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Http\Requests;

class UserController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

     public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();
        $result = App\User::create([
        		'email' => $user->email ,
        		'name' => $user->nickname,
        		'github_user_token' => $user->uid
        	]);
        if (!$result)
        {
        	return redirect()->back();
        }
        return 'You are authenticated!!'; //Or redirect to dashboard
    }

}
