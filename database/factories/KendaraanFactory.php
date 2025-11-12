<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Driver;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kendaraan>
 */
class KendaraanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'driver_id' => Driver::factory(),
            'plat_nomor' => strtoupper($this->faker->bothify('B #### ??')),
            'jenis' => $this->faker->randomElement(['motor', 'mobil']),
            'merk' => $this->faker->randomElement(['Honda', 'Yamaha', 'Suzuki', 'Toyota', 'Daihatsu']),
            'warna' => $this->faker->safeColorName(),
        ];
    }
}
