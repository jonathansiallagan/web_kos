<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}