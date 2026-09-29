<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Menampilkan halaman daftar semua user (Manajemen Akun).
     */
    public function index()
    {
        // Ambil semua user, pisahkan dengan pagination
        $users = User::paginate(10);
        
        // Tampilkan view dari template 'laravel-examples'
        // Pastikan file ini ada: resources/views/laravel-examples/user-management.blade.php
        return view('laravel-examples.user-management', compact('users'));
    }

    /**
     * Menampilkan halaman edit untuk user tertentu.
     */
    public function edit(User $user)
    {
        // Tampilkan view 'user-profile' dari template 'laravel-examples'
        // Pastikan file ini ada: resources/views/laravel-examples/user-profile.blade.php
        return view('laravel-examples.user-profile', compact('user'));
    }

    /**
     * Update data user
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|'. Rule::unique('users')->ignore($user->id),
            'role' => 'required|in:admin,user',
            'no_hp' => 'nullable|string',
            'alamat' => 'nullable|string',
        ]);

        $user->update($request->all());

        return redirect()->route('user.index')->with('success', 'Data user berhasil diperbarui.');
    }

    /**
     * Hapus user
     */
    public function destroy(User $user)
    {
        // Proteksi agar admin tidak bisa menghapus akunnya sendiri
        if (auth()->id() == $user->id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();
        return redirect()->route('user.index')->with('success', 'User berhasil dihapus.');
    }
}