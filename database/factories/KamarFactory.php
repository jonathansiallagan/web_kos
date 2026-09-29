<?php

namespace Database\Factories;

use App\Models\Kamar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kamar>
 */
class KamarFactory extends Factory
{
    protected $model = Kamar::class;

    public function definition(): array
    {
        return [
            'no_kamar' => $this->faker->unique()->numerify('K-###'),
            'tipe_kamar' => $this->faker->randomElement(['single', 'double', 'suite']),
            'harga_perbulan' => $this->faker->numberBetween(500000, 3000000),
            'ukuran' => $this->faker->randomElement(['3x3', '4x4', '5x5']),
            'fasilitas' => json_encode(['AC', 'WiFi', 'Kamar Mandi']),
            'status' => $this->faker->randomElement(['available', 'occupied', 'maintenance']),
            'foto' => null,
            'user_id' => null,
        ];
    }
}
