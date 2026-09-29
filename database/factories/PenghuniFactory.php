<?php

namespace Database\Factories;

use App\Models\Penghuni;
use App\Models\Kamar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penghuni>
 */
class PenghuniFactory extends Factory
{
    protected $model = Penghuni::class;

    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'no_telepon' => '0812' . $this->faker->numerify('#######'),
            'kamar_id' => Kamar::factory(),
            'tanggal_masuk' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'tanggal_keluar' => null,
            'status' => 'active',
            'foto' => null,
        ];
    }
}
