<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
    $googleUser = Socialite::driver('google')->stateless()->user();

    // cari user berdasarkan email
    $user = User::where('email', $googleUser->getEmail())->first();

    if (! $user) {
        $user = User::create([
            'name'      => $googleUser->getName(),
            'email'     => $googleUser->getEmail(),
            'google_id' => $googleUser->getId(),
            'password'  => bcrypt(str()->random(16)),
            'role'      => 'user', // atau apa pun default-mu
        ]);
    }

    Auth::login($user);
    return redirect()->route('user.home');
    }

}
