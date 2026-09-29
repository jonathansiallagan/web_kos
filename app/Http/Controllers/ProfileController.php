<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

// Hapus 'use App\Http\Requests\ProfileUpdateRequest;' jika ada

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman edit profil untuk user yang sedang login.
     */
    public function edit(Request $request): View
    {
        // PASTIKAN INI MENGARAH KE 'pages.profile'
        return view('pages.profile', [
            'user' => $request->user()
        ]);
    }

    /**
     * Update profil user yang sedang login.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|'. Rule::unique('users')->ignore($user->id),
            'no_hp' => 'nullable|string',
            'alamat' => 'nullable|string',
            'pekerjaan' => 'nullable|string',
            // 'jenis_kelamin' => 'nullable|string', (jika ada)
        ]);

        // Hanya update data yang diizinkan
        $user->update($request->only('name', 'email', 'no_hp', 'alamat', 'pekerjaan'));

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
    }

    // Kita bisa biarkan fungsi destroy() dari file lamamu jika kamu mau,
    // tapi pastikan validasinya tidak menggunakan ProfileUpdateRequest
}