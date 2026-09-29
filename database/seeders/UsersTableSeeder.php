<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        // Create an admin user and several regular users
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
            // plaintext password for this seeded admin: "adminpass"
            'password' => Hash::make('adminpass'),
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'user',
            // plaintext password for this seeded user: "password123"
            'password' => Hash::make('password123'),
        ]);

        // additional random users
        // For the random users, the factory already sets a default hashed password
        // (Hash::make('password')). If you want known passwords, you can override
        // here. We'll create a couple of extra known users for convenience.
        User::factory()->count(6)->create();

        User::factory()->create([
            'name' => 'Alice Example',
            'email' => 'alice@example.com',
            'role' => 'user',
            // plaintext password: "alicepass"
            'password' => Hash::make('alicepass'),
        ]);

        User::factory()->create([
            'name' => 'Bob Example',
            'email' => 'bob@example.com',
            'role' => 'user',
            // plaintext password: "bobpass"
            'password' => Hash::make('bobpass'),
        ]);
    }
}
