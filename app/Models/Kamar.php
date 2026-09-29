<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi secara massal.
     * Kita tambahkan 'user_id' dari migrasi baru kita.
     */
    protected $fillable = [
        'no_kamar',
        'tipe_kamar',
        'harga_perbulan',
        'ukuran',
        'fasilitas',
        'status',
        'foto',
        'user_id', // <--- DITAMBAHKAN
    ];

    /**
     * RELASI BARU:
     * Satu kamar dimiliki oleh satu User (Penghuni).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * RELASI BARU:
     * Satu kamar memiliki banyak data pembayaran.
     */
    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }

    /**
     * RELASI BARU:
     * Relasi khusus untuk mengecek pembayaran bulan ini.
     */
    public function pembayaranBulanIni()
{
    return $this->hasOne(Pembayaran::class)
                ->whereMonth('bulan_tahun', now()->month)
                ->whereYear('bulan_tahun', now()->year)
                ->orderByDesc('id'); // ambil yang terbaru
}

}