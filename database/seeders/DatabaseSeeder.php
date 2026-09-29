<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\KamarsTableSeeder;
use Database\Seeders\PemesanansTableSeeder;
use Database\Seeders\PenghunisTableSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run seeders in order so relations can resolve
        $this->call([
            UsersTableSeeder::class,
            KamarsTableSeeder::class,
            PemesanansTableSeeder::class,
            PenghunisTableSeeder::class,
        ]);
    }
}
