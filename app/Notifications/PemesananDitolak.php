<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PemesananDitolak extends Notification
{
    use Queueable;

    public $nama_kamar;

    /**
     * Kita butuh data nomor/nama kamar untuk ditampilkan di pesan
     */
    public function __construct($nama_kamar)
    {
        $this->nama_kamar = $nama_kamar;
    }

    public function via(object $notifiable): array
    {
        return ['database']; // Simpan ke database
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title'   => 'Pemesanan Ditolak',
            'message' => 'Maaf, permintaan sewa kamar ' . $this->nama_kamar . ' Anda tidak dapat kami setujui saat ini.',
            // Arahkan user kembali ke halaman Home untuk mencari kamar lain
            'url'     => route('user.home'),
            'icon'    => 'fa fa-times-circle', // Icon silang
            'color'   => 'danger' // Warna merah
        ];
    }
}