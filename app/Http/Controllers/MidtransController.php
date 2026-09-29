<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Pembayaran;
use App\Models\Kamar;
use Exception;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function __construct()
    {
        // Setup Midtrans Config
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = false; // Sandbox
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    /**
     * Callback endpoint untuk menerima notifikasi dari Midtrans
     */
    public function callback(Request $request)
    {
        try {
            $notif = new Notification();
            Log::info('Midtrans Callback', (array) $notif);

            $order_id = $notif->order_id;
            $transaction = $notif->transaction_status;
            $type = $notif->payment_type;
            $fraud = $notif->fraud_status;

            $pembayaran = Pembayaran::where('order_id', $order_id)->first();

            if (!$pembayaran) {
                Log::error("Order ID Not Found: $order_id");
                return response()->json(['error' => 'Order not found'], 404);
            }

            // === Update status pembayaran berdasarkan notifikasi Midtrans ===
            switch ($transaction) {
                case 'capture':
                    if ($type == 'credit_card') {
                        if ($fraud == 'challenge') {
                            $pembayaran->update(['status_pembayaran' => 'Pending']);
                        } else {
                            $this->updateLunas($pembayaran, $type);
                        }
                    }
                    break;

                case 'settlement':
                    $this->updateLunas($pembayaran, $type);
                    break;

                case 'pending':
                    $pembayaran->update(['status_pembayaran' => 'Pending']);
                    break;

                case 'deny':
                case 'expire':
                case 'cancel':
                    $pembayaran->update(['status_pembayaran' => 'Gagal']);
                    break;
            }

            return response()->json(['success' => true]);

        } catch (Exception $e) {
            Log::error("Midtrans Callback Error: " . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Fungsi bantu untuk update pembayaran menjadi Lunas
     */
    private function updateLunas(Pembayaran $pembayaran, $paymentType)
    {
        $pembayaran->update([
            'status_pembayaran' => 'Lunas',
            'metode_pembayaran' => $paymentType,
            'tanggal_bayar' => now(),
        ]);

        // Optional: update relasi kamar/penghuni supaya badge di admin otomatis berubah
        $kamar = Kamar::find($pembayaran->kamar_id);
        if ($kamar) {
            // Relasi sudah otomatis lewat $kamar->pembayaranBulanIni
            $kamar->save();
        }
    }

    /**
     * Finish handler: redirect user setelah pembayaran berhasil
     */
    public function finish(Request $request)
    {
        Log::info('Payment Finish', $request->all());

        return redirect()->route('user.tagihan.index')
            ->with('status', 'Pembayaran berhasil! Terima kasih.');
    }

    /**
     * Unfinish handler: user keluar sebelum selesai
     */
    public function unfinish(Request $request)
    {
        Log::info('Payment Unfinish', $request->all());

        return redirect()->route('user.tagihan.index')
            ->with('warning', 'Pembayaran belum selesai.');
    }

    /**
     * Error handler
     */
    public function error(Request $request)
    {
        Log::error('Payment Error', $request->all());

        return redirect()->route('user.tagihan.index')
            ->with('error', 'Terjadi kesalahan pada pembayaran.');
    }
}