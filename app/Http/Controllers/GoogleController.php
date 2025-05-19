<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            // dd($user);
            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);

                return redirect('/');

            } else {
                $newUser = User::create([
                    'email' => $user->email,
                    'name' => $user->name,
                    'google_id' => $user->id,
                    'password' => Hash::make('password'),
                    'is_admin' => 0,
                    'is_verified' => 0
                ]);

                Auth::login($newUser);
                return redirect('/');
            }
        } catch (\Exception $th) {
            dd($th->getMessage());
        }
    }
}
