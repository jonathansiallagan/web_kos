<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Pemesanan;

class PemesananBaru extends Notification
{
    use Queueable;

    public $pemesanan;

    public function __construct(Pemesanan $pemesanan)
    {
        $this->pemesanan = $pemesanan;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Pemesanan Baru',
            // Pesan dinamis
            'message' => $this->pemesanan->user->name . ' memesan kamar ' . $this->pemesanan->kamar->nomor_kamar,
            // URL Dinamis: Pastikan route 'admin.pemesanan.show' ada di web.php Anda
            'url' => route('admin.pemesanan.show', $this->pemesanan->id),
            // Icon untuk UI
            'icon' => 'fa fa-file-invoice-dollar',
            'color' => 'success'
        ];
    }
}