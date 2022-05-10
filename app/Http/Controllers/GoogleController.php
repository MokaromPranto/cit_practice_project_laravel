<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callback()
    {
        $user = Socialite::driver('google')->user();

        // echo $user->getName();
        // echo $user->getEmail();

        if(!User::where('email', $user->getEmail())->exists()){
            User::insert([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => bcrypt('abc123'),
                'role' => 'customer',
                'created_at' => Carbon::now(),
            ]);
        }
        Auth::attempt(['email' => $user->getEmail(), 'password' => 'abc123']);
        return redirect('customer/dashboard')->with('success', 'Successfully Logged in With Google Account!');

    }
}
