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
            'jabatan' => $this->faker->randomElement([
                'Kepala Sekretariat Utama', 
                'Penyusun laporan keuangan', 
                'Surveyor Pemetaan Pertama', 
                'Analis Data Survei dan Pemetaan', 
                'Perancang Per-UU-an Utama', 
                'Kepala Biro Perencanaan, Kepegawaian dan Keuangan'
            ]),
            
            'unit_kerja' => $this->faker->randomElement([
                'Sekretariat Utama', 
                'Perencanaan', 
                'Kepegawaian', 
                'Keuangan'
            ]),
        ];
    }
}
