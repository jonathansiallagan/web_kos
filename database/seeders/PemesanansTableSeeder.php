<?php

namespace Database\Seeders;

use App\Models\Kamar;
use App\Models\Pemesanan;
use App\Models\User;
use Illuminate\Database\Seeder;

class PemesanansTableSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $kamars = Kamar::all();

        if ($users->isEmpty() || $kamars->isEmpty()) {
            return;
        }

        // Create a few pemesanan records linking users to rooms
        foreach ($users->take(6) as $user) {
            Pemesanan::create([
                'user_id' => $user->id,
                'kamar_id' => $kamars->random()->id,
                'status' => 'pending',
            ]);
        }
    }
}
