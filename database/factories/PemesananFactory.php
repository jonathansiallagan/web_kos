<?php

namespace Database\Factories;

use App\Models\Pemesanan;
use App\Models\User;
use App\Models\Kamar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pemesanan>
 */
class PemesananFactory extends Factory
{
    protected $model = Pemesanan::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'kamar_id' => Kamar::factory(),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
