<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    /**
     * Menampilkan daftar semua laporan kerusakan. (HANYA UNTUK ADMIN)
     */
    public function index()
    {
        $laporans = Laporan::with('user', 'kamar')
                         ->orderBy('status', 'asc')
                         ->orderBy('created_at', 'desc')
                         ->paginate(10);
                         
        return view('pages.laporan-index', compact('laporans'));
    }

    /**
     * Menampilkan form untuk membuat laporan baru.
     * (Sekarang bisa untuk ADMIN dan USER)
     */
    public function create()
    {
        $kamars = Kamar::orderBy('no_kamar', 'asc')->get();
        
        // === PERBAIKAN LOGIKA ROLE DIMULAI DI SINI ===
        if (Auth::user()->role == 'admin') {
            // Jika ADMIN, tampilkan view admin
            return view('pages.laporan-create', compact('kamars'));
        } else {
            // Jika USER, tampilkan view user
            return view('user.laporan-create', compact('kamars'));
        }
        // === AKHIR PERBAIKAN ===
    }

    /**
     * Menyimpan laporan baru ke database.
     * (Sekarang bisa untuk ADMIN dan USER)
     */
    public function store(Request $request)
    {
        $request->validate([
            'kamar_id' => 'nullable|exists:kamars,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        Laporan::create([
            'user_id' => Auth::id(), // Otomatis ambil ID user yang login (admin/user)
            'kamar_id' => $request->kamar_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'status' => 'Baru',
        ]);
        
        // === PERBAIKAN LOGIKA REDIRECT ===
        if (Auth::user()->role == 'admin') {
            // Jika ADMIN, kembalikan ke daftar laporan admin
            return redirect()->route('laporan.index')->with('success', 'Laporan kerusakan berhasil dikirim.');
        } else {
            // Jika USER, kembalikan ke dashboard user
            return redirect()->route('user.home')->with('success', 'Laporan kerusakanmu berhasil dikirim.');
        }
        // === AKHIR PERBAIKAN ===
    }

    /**
     * Mengubah status laporan (HANYA UNTUK ADMIN).
     */
    public function updateStatus(Request $request, Laporan $laporan)
    {
        $request->validate([
            'status' => 'required|in:Baru,Dikerjakan,Selesai',
        ]);

        $laporan->status = $request->status;
        $laporan->save();

        return redirect()->route('laporan.index')->with('success', 'Status laporan berhasil diperbarui.');
    }

    /**
     * Menghapus laporan (HANYA UNTUK ADMIN).
     */
    public function destroy(Laporan $laporan)
    {
        $laporan->delete();
        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus.');
    }
}