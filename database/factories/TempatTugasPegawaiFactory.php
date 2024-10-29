<?php

namespace Database\Factories;

use App\Models\TempatTugasPegawai;
use Illuminate\Database\Eloquent\Factories\Factory;

class TempatTugasPegawaiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TempatTugasPegawai::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $kota = [
            'Jakarta', 'Surabaya', 'Bandung', 'Medan', 'Bekasi',
            'Tangerang', 'Semarang', 'Makassar', 'Depok', 'Palembang'
        ];

        return [
            'nip' => \App\Models\Pegawai::factory(), 
            'tempat_tugas' => $this->faker->randomElement($kota), 
        ];
    }
}
