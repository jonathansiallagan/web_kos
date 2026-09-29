<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Pemesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PemesananBaru;

class PemesananController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        // --- SATPAM BARU (VALIDASI LEVEL APLIKASI) ---
        // Cek apakah user masih punya pesanan yang STATUSNYA 'Pending'
        // Kita hanya melarang kalau statusnya 'pending'. 
        // Kalau statusnya 'ditolak' (histori), dia BOLEH pesan lagi.
        $cekPending = \App\Models\Pemesanan::where('user_id', $user->id)
            ->where('status', 'pending')
            ->exists();

        if ($cekPending) {
            return redirect()->back()->with('error', 'Anda masih memiliki pemesanan yang sedang menunggu persetujuan. Tunggu admin memprosesnya dulu.');
        }

        
        $request->validate([
            'kamar_id' => 'required|exists:kamars,id',
        ]);

        $user = Auth::user();
        $kamarId = $request->kamar_id;

        // 1. Validasi User sudah punya kamar
        if ($user->kamar) {
            return redirect()->route('user.home')->with('error', 'Anda sudah memiliki kamar.');
        }

        // 2. Validasi Pending
        $pemesananPending = Pemesanan::where('user_id', $user->id)
            ->where('status', 'pending')
            ->exists();
        if ($pemesananPending) {
            return redirect()->route('user.home')->with('error', 'Anda sudah memiliki pemesanan yang sedang ditinjau.');
        }

        // 3. Validasi Ketersediaan
        $kamar = Kamar::find($kamarId);
        if ($kamar->status != 'Tersedia') {
            return redirect()->route('user.home')->with('error', 'Kamar ini sudah tidak tersedia.');
        }

        // 4. Buat Pemesanan
        $pemesanan = Pemesanan::create([
            'user_id' => $user->id,
            'kamar_id' => $kamar->id,
            'status' => 'pending',
        ]);

        // 5. Notifikasi HANYA ke Admin
        $admins = User::where('role', 'admin')->get();

        if ($admins->count() > 0) {
            // Mengirim instance $pemesanan ke class Notification
            Notification::send($admins, new PemesananBaru($pemesanan));
        }

        return redirect()->route('user.home')->with('success', 'Kamar berhasil dipesan! Mohon tunggu persetujuan Admin.');
    }

    public function show(Pemesanan $pemesanan)
    {
        // Pastikan notifikasi terkait ditandai "sudah dibaca" jika admin membuka detail ini
        // (Opsional, tapi bagus untuk UX)
        $notificationId = request()->query('id');
        if ($notificationId) {
            auth::user()->notifications->where('id', $notificationId)->markAsRead();
        }

        // Tampilkan view detail (Anda perlu membuat file view ini nanti)
        return view('admin.pemesanan.show', compact('pemesanan'));
    }
}
