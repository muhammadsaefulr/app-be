<?php

namespace Database\Factories;

use App\Models\KontakPegawai;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KontakPegawai>
 */
class KontakPegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = KontakPegawai::class;

    public function definition(): array
    {
        return [
            'nip' => \App\Models\Pegawai::factory(),
            'no_hp' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'npwp' => $this->faker->unique()->numerify('##########'),
        ];
    }
}
