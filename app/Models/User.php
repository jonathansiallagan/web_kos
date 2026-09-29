<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'no_hp',          // <-- TAMBAHKAN INI
        'jenis_kelamin',  // <-- TAMBAHKAN INI
        'pekerjaan',      // <-- TAMBAHKAN INI
        'alamat',         // <-- TAMBAHKAN INI
        'role',           // <-- (Penting untuk disetel)
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function kamar()
    {
        return $this->hasOne(Kamar::class); // Satu user punya satu kamar
    }
    public function pembayaranBulanIni()
{
    return $this->hasOne(Pembayaran::class)
                ->whereMonth('bulan_tahun', now()->month)
                ->whereYear('bulan_tahun', now()->year);
}

}