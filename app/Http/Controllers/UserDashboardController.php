<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kamar;
use App\Models\Pembayaran;
use Illuminate\View\View;// Pastikan View di-import
use App\Models\Pemesanan;
class UserDashboardController extends Controller
{
    /**
     * Menampilkan dashboard untuk pengguna (penghuni).
     */
    public function index(): View // Tentukan return type-nya adalah View
    {
        $user = Auth::user();

        // 1. Cari kamar yang sedang ditempati oleh user ini
        $kamar = Kamar::where('user_id', $user->id)->first();

        // 2. Cari tagihan bulan ini untuk user ini
        $tagihanBulanIni = null;
        if ($kamar) {
            $tagihanBulanIni = Pembayaran::where('kamar_id', $kamar->id)
                                         ->whereMonth('bulan_tahun', now()->month)
                                         ->whereYear('bulan_tahun', now()->year)
                                         ->first();
        }
        // 3. (BARU) Cek apakah user punya pemesanan pending
        $pemesananPending = Pemesanan::where('user_id', $user->id)
        ->where('status', 'pending')
        ->with('kamar') // Ambil info kamar yg dipesan
        ->first();

        // 4. (BARU) Ambil daftar kamar yang tersedia
        $kamarsKosong = [];
        if (!$kamar && !$pemesananPending) {
        $kamarsKosong = Kamar::where('status', 'Tersedia')->get();
        }
        // PERBAIKAN: Arahkan ke view 'user.home' (di folder 'user')
        return view('user.home', compact(
            'user', 
            'kamar', 
            'tagihanBulanIni', 
            'pemesananPending', 
            'kamarsKosong'
        ));
    }
}