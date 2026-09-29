<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\User;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Notifications\PemesananDisetujui;
use App\Notifications\PemesananDitolak;
use App\Models\Pembayaran;

class PenghuniController extends Controller
{
    /**
     * Menampilkan daftar PENGHUNI AKTIF dan PESANAN PENDING
     */
    public function index()
    {
        // 1. Ambil data pesanan yang masih pending (baru)
        $pemesanansPending = Pemesanan::where('status', 'pending')
            ->with('user', 'kamar')
            ->latest()
            ->get();

        // 2. Ambil data kamar yang sudah terisi (lama)
        $kamarsTerisi = Kamar::where('status', 'Terisi')
            ->with('user', 'pembayaranBulanIni')
            ->paginate(10);

        // 3. Kirim kedua data ke view
        return view('pages.penghuni-index', compact('kamarsTerisi', 'pemesanansPending'));
    }

    /**
     * Menyetujui Pemesanan (Approve)
     */
    public function approve(Request $request, $id)
    {
        // Kita cari dulu datanya
        $pemesanan = Pemesanan::findOrFail($id);

        // Gunakan Transaksi Database
        try {
            DB::transaction(function () use ($pemesanan) {
                // 1. Ambil kamar terkait
                $kamar = $pemesanan->kamar;

                // 2. Validasi ulang: Pastikan kamar masih tersedia
                if ($kamar->status != 'Tersedia') {
                    throw new \Exception('Gagal! Kamar ini baru saja terisi oleh orang lain.');
                }

                // 3. Update Data Kamar (Isi pemilik & ubah status)
                $kamar->update([
                    'user_id' => $pemesanan->user_id,
                    'status'  => 'Terisi'
                ]);

                // 4. Buat Tagihan Pertama (Sesuai snippet Anda)
                // Pastikan nama Model sesuai (Pembayaran atau Tagihan)
                \App\Models\Pembayaran::create([
                    'kamar_id'          => $kamar->id,
                    'user_id'           => $pemesanan->user_id,
                    'bulan_tahun'       => Carbon::now()->startOfMonth(), // Tgl 1 bulan ini
                    'status_pembayaran' => 'Belum Bayar',
                    'jumlah_bayar'      => $kamar->harga // Asumsi kolom harga di tabel kamars
                ]);

                // 5. Update Status Pemesanan jadi 'Disetujui'
                // SARAN SAYA: Jangan di-delete ($pemesanan->delete()), lebih baik ubah statusnya
                // agar Admin punya riwayat siapa saja yang pernah request.
                $pemesanan->update(['status' => 'diterima']);

                // 6. KIRIM NOTIFIKASI KE USER (Fitur yang kita bahas sebelumnya)
                // Mengirim info nama kamar ke notifikasi
                $pemesanan->user->notify(new PemesananDisetujui($kamar->nomor_kamar));
            });
        } catch (\Exception $e) {
            // Jika ada error di tengah proses, semua perubahan dibatalkan (Rollback)
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->route('penghuni.index')->with('success', 'Penghuni diterima, Tagihan dibuat, & Notifikasi dikirim!');
    }

    /**
     * Menolak Pemesanan (Reject)
     * Method ini dipanggil saat tombol "Tolak" ditekan
     */
    public function reject($id)
    {
        // 1. Cari data pemesanan
        $pemesanan = \App\Models\Pemesanan::with('kamar', 'user')->findOrFail($id);

        // 2. Validasi status (hanya pending yang bisa ditolak)
        if ($pemesanan->status != 'pending') {
            return redirect()->back()->with('error', 'Permintaan ini sudah diproses sebelumnya.');
        }

        // 3. Simpan info kamar & user SEBELUM status diubah/data dihapus
        // Kita butuh ini untuk notifikasi
        $user = $pemesanan->user;
        $namaKamar = $pemesanan->kamar->nomor_kamar;

        // 4. UPDATE Status jadi 'ditolak'
        // (Aman dilakukan karena kita sudah menghapus Unique Key tadi)
        $pemesanan->update(['status' => 'ditolak']);

        // 5. KIRIM NOTIFIKASI KE USER
        // Mengirim notifikasi ke user yang memesan
        $user->notify(new PemesananDitolak($namaKamar));

        return redirect()->back()->with('success', 'Permintaan ditolak dan User telah diberitahu melalui notifikasi.');
    }

    /**
     * Menampilkan form untuk menambah penghuni baru ke kamar KOSONG
     */
    public function create()
    {
        $kamarsKosong = Kamar::where('status', 'Tersedia')->get();
        $calonPenghuni = User::where('role', 'user')->doesntHave('kamar')->get();

        return view('pages.penghuni-create', compact('kamarsKosong', 'calonPenghuni'));
    }

    /**
     * Menyimpan data penghuni baru (assign user ke kamar)
     */
    public function store(Request $request)
    {
        $request->validate([
            'kamar_id' => 'required|exists:kamars,id',
            'user_id' => 'required|exists:users,id',
        ]);

        DB::transaction(function () use ($request) {
            $kamar = Kamar::find($request->kamar_id);
            $kamar->user_id = $request->user_id;
            $kamar->status = 'Terisi';
            $kamar->save();

            // Buat tagihan pertama
            \App\Models\Pembayaran::create([
                'kamar_id' => $kamar->id,
                'user_id' => $request->user_id,
                'bulan_tahun' => now()->startOfMonth(),
                'status_pembayaran' => 'Belum Bayar',
                'jumlah_bayar' => $kamar->harga_perbulan
            ]);
        });

        return redirect()->route('penghuni.index')->with('success', 'Penghuni berhasil ditambahkan ke kamar.');
    }

    /**
     * Menghapus penghuni dari kamar (mengosongkan kamar)
     */
    public function destroy(Kamar $kamar)
    {
        $kamar->user_id = null;
        $kamar->status = 'Tersedia';
        $kamar->save();

        return redirect()->route('penghuni.index')->with('success', 'Penghuni berhasil dikeluarkan, kamar sekarang tersedia.');
    }

    public function markLunas($kamarId)
    {
        $kamar = Kamar::findOrFail($kamarId);

        if (!$kamar->user_id) {
            return back()->with('error', 'Kamar ini belum memiliki penghuni.');
        }

        // Update pembayaran bulan ini
        $pembayaran = \App\Models\Pembayaran::where('user_id', $kamar->user_id)
                        ->where('kamar_id', $kamar->id)
                        ->where('bulan_tahun', now()->startOfMonth())
                        ->first();

        if ($pembayaran) {
            $pembayaran->status_pembayaran = 'Lunas';
            $pembayaran->tanggal_bayar = now();
            $pembayaran->metode_pembayaran = 'Offline';
            $pembayaran->save();
        } else {
            // Kalau belum ada tagihan, buat tagihan baru
            \App\Models\Pembayaran::create([
                'kamar_id' => $kamar->id,
                'user_id' => $kamar->user_id,
                'bulan_tahun' => now()->startOfMonth(),
                'status_pembayaran' => 'Lunas',
                'jumlah_bayar' => $kamar->harga_perbulan,
                'tanggal_bayar' => now(),
                'metode_pembayaran' => 'Offline',
            ]);
        }

        return back()->with('success', 'Status pembayaran berhasil diubah menjadi Lunas.');
    }
}
