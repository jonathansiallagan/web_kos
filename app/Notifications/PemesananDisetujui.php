<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PemesananDisetujui extends Notification
{
    use Queueable;
    
    // Kita butuh data nama kamar atau pesan custom
    public $nama_kamar;

    public function __construct($nama_kamar)
    {
        $this->nama_kamar = $nama_kamar;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'title'   => 'Hore! Pemesanan Diterima',
            'message' => 'Pemesanan kamar ' . $this->nama_kamar . ' telah disetujui Admin. Silakan cek tagihan.',
            // Arahkan user ke halaman tagihan/dashboard mereka
            'url'     => route('user.tagihan.index'), 
            'icon'    => 'fa fa-check-circle',
            'color'   => 'success'
        ];
    }
}