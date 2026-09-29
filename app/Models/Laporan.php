<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kamar_id',
        'judul',
        'deskripsi',
        'status',
    ];

    /**
     * Relasi: Satu laporan dimiliki oleh satu User (Pelapor)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Satu laporan terkait dengan satu Kamar
     */
    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
}