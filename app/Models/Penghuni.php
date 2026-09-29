<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penghuni extends Model
{
    protected $fillable = [
        'nama',
        'email',
        'no_telepon',
        'kamar_id',
        'tanggal_masuk',
        'tanggal_keluar',
        'status',
        'foto',
    ];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
}
