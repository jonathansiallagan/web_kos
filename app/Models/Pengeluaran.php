<?php

namespace App\Models;

// INI ADALAH BARIS YANG HILANG/SALAH:
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    // Baris ini (baris 7) yang sebelumnya menyebabkan error
    use HasFactory; 

    // Kolom yang boleh diisi
    protected $fillable = [
        'kategori',
        'deskripsi',
        'jumlah',
        'tanggal',
    ];
}