<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Midtrans\Snap;
use Midtrans\Config;

class TagihanController extends Controller
{
    public function index()
    {
        $tagihan = Pembayaran::with('user', 'kamar')
            ->orderBy('bulan_tahun', 'desc')
            ->paginate(15);

        return view('pages.tagihan-index', compact('tagihan'));
    }

    public function update($id)
{
    $tagihan = Pembayaran::findOrFail($id);

    $tagihan->update([
        'status_pembayaran' => 'Lunas', 
    ]);

    return back()->with('success', 'Tagihan berhasil ditandai sebagai LUNAS!');
}



    public function generate()
    {
        $kamarsTerisi = Kamar::where('status', 'Terisi')->whereNotNull('user_id')->get();
        $bulanIni = Carbon::now()->startOfMonth();
        $tagihanBaruCount = 0;

        foreach ($kamarsTerisi as $kamar) {
            $tagihanAda = Pembayaran::where('kamar_id', $kamar->id)
                ->where('bulan_tahun', $bulanIni->toDateString())
                ->exists();

            if (!$tagihanAda) {
                Pembayaran::create([
                    'kamar_id' => $kamar->id,
                    'user_id' => $kamar->user_id,
                    'bulan_tahun' => $bulanIni->toDateString(),
                    'jumlah_bayar' => $kamar->harga_perbulan,
                    'status_pembayaran' => 'Belum Bayar',
                ]);
                $tagihanBaruCount++;
            }
        }

        return redirect()->route('admin.tagihan.index')
            ->with('success', "$tagihanBaruCount tagihan baru berhasil dibuat.");
    }

    public function bayar(Pembayaran $tagihan)
    {
        // Setup Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production') === true;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Buat order_id jika belum ada
        if (!$tagihan->order_id) {
    $tagihan->update([
        'order_id' => 'TAGIHAN-' . $tagihan->id
    ]);
}


        $params = [
            'transaction_details' => [
                'order_id' => $tagihan->order_id,
                'gross_amount' => $tagihan->jumlah_bayar,
            ],
            'customer_details' => [
                'first_name' => $tagihan->user->name,
                'email' => $tagihan->user->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('pages.tagihan-bayar', compact('tagihan', 'snapToken'));
    }
}