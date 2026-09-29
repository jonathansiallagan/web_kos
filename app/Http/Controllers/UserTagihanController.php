<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Pembayaran;
use Midtrans\Snap;
use Midtrans\Config;

class UserTagihanController extends Controller
{
    public function __construct()
    {
        // Setup Midtrans Config di constructor
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = false; // SANDBOX MODE
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function index()
    {
        $userId = Auth::id();
        $tagihan = Pembayaran::where('user_id', $userId)
                    ->with('kamar')
                    ->orderBy('bulan_tahun', 'desc')
                    ->paginate(15);

        return view('user.tagihan-index', compact('tagihan'));
    }

    public function bayar(Pembayaran $tagihan)
{
    // Cek kepemilikan
    if ($tagihan->user_id !== auth()->id()) {
        abort(403, 'Unauthorized');
    }

    // Cek apakah sudah lunas
    if ($tagihan->status_pembayaran === 'Lunas') {
        return redirect()->route('user.tagihan.index')
            ->with('status', 'Tagihan sudah dibayar.');
    }

    // Hanya generate order_id sekali
    if (!$tagihan->order_id) {
        $tagihan->update([
            'order_id' => 'TAGIHAN-' . $tagihan->id
        ]);
    }

    $params = [
        'transaction_details' => [
            'order_id' => $tagihan->order_id,
            'gross_amount' => (int)$tagihan->jumlah_bayar,
        ],
        'customer_details' => [
            'first_name' => auth()->user()->name,
            'email' => auth()->user()->email,
        ],
        'item_details' => [
            [
                'id' => $tagihan->id,
                'price' => (int)$tagihan->jumlah_bayar,
                'quantity' => 1,
                'name' => 'Pembayaran Kos'
            ]
        ]
    ];

    Log::info('Generating Snap Token', [
        'order_id' => $tagihan->order_id
    ]);

    $snapToken = Snap::getSnapToken($params);

    return view('user.tagihan-bayar', compact('tagihan', 'snapToken'));
}

}