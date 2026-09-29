<?php

namespace Database\Seeders;

use App\Models\Kamar;
use App\Models\Penghuni;
use Illuminate\Database\Seeder;

class PenghunisTableSeeder extends Seeder
{
    public function run(): void
    {
        $kamars = Kamar::all();

        if ($kamars->isEmpty()) {
            return;
        }

        // Create penghuni entries for some kamars
        foreach ($kamars->take(4) as $kamar) {
            Penghuni::create([
                'nama' => 'Penghuni ' . $kamar->no_kamar,
                'email' => 'penghuni+' . $kamar->no_kamar . '@example.com',
                'no_telepon' => '0812' . rand(1000000, 9999999),
                'kamar_id' => $kamar->id,
                'tanggal_masuk' => now()->subMonths(rand(0, 12)),
                'tanggal_keluar' => null,
                'status' => 'active',
            ]);
        }
    }
}
