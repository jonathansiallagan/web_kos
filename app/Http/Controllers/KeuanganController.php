<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KeuanganController extends Controller
{
    /**
     * Menampilkan halaman dashboard keuangan
     */
    public function index()
    {
        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;

        // 1. Ambil data untuk Kartu Laporan
        $totalPemasukan = Pembayaran::where('status_pembayaran', 'Lunas')
                                    ->whereMonth('updated_at', $bulanIni)
                                    ->whereYear('updated_at', $tahunIni)
                                    ->sum('jumlah_bayar');
        
        $totalPengeluaran = Pengeluaran::whereMonth('tanggal', $bulanIni)
                                      ->whereYear('tanggal', $tahunIni)
                                      ->sum('jumlah');

        $keuntunganBersih = $totalPemasukan - $totalPengeluaran;

        // 2. Ambil data untuk Tabel Riwayat
        $daftarPemasukan = Pembayaran::where('status_pembayaran', 'Lunas')
                                      ->with('user') // Ambil data user
                                      ->latest('updated_at') // Urutkan dari yg terbaru
                                      ->take(5) // Ambil 5 terakhir
                                      ->get();
        
        $daftarPengeluaran = Pengeluaran::latest('tanggal')->take(5)->get();

        return view('pages.keuangan', compact(
            'totalPemasukan',
            'totalPengeluaran',
            'keuntunganBersih',
            'daftarPemasukan',
            'daftarPengeluaran'
        ));
    }

    /**
     * Menyimpan data pengeluaran baru
     */
    public function storePengeluaran(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jumlah' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
        ]);

        Pengeluaran::create($request->all());

        return redirect()->route('keuangan.index')->with('success', 'Pengeluaran berhasil dicatat.');
    }
}