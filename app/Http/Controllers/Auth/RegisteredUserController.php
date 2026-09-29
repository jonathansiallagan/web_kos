<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Menampilkan view registrasi.
     */
    public function create(): View
    {
        // Pastikan path view-nya benar (sesuai struktur folder kita)
        return view('static-sign-up');
    }

    /**
     * Menangani request registrasi yang masuk.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. VALIDASI DIPERBARUI
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'no_hp' => ['required', 'string', 'max:20'],
            'jenis_kelamin' => ['required', 'string', 'in:Laki-laki,Perempuan'],
            'pekerjaan' => ['required', 'string', 'max:100'],
            'alamat' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2. PROSES CREATE DIPERBARUI
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pekerjaan' => $request->pekerjaan,
            'alamat' => $request->alamat,
            'password' => Hash::make($request->password),
            'role' => 'user', // Set role default ke 'user'
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Redirect ke 'home' (dashboard user)
        return redirect(route('user.home'));
    }
}