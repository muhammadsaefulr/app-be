<?php

namespace Database\Factories;

use App\Models\UnitTugas;
use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UnitTugas>
 */
class UnitTugasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = UnitTugas::class;

    public function definition(): array
    {
        return [
            'nip' => \App\Models\Pegawai::factory(), 
            'gol' => $this->faker->randomElement(['I', 'II', 'III', 'IV']),
            'eselon' => $this->faker->randomElement(['Eselon I', 'Eselon II', 'Eselon III']),
            'jabatan' => $this->faker->jobTitle,
            'unit_kerja' => $this->faker->company,
        ];
    }
}
