<?php

namespace Database\Seeders;

use App\Models\Kamar;
use App\Models\User;
use Illuminate\Database\Seeder;

class KamarsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Create some kamar entries. Link some to existing users if possible.
        $users = User::all();

        Kamar::factory()->count(6)->create()->each(function ($kamar) use ($users) {
            // randomly assign a user to some rooms
            if (rand(0, 1) === 1 && $users->isNotEmpty()) {
                $kamar->user()->associate($users->random());
                $kamar->save();
            }
        });
    }
}
