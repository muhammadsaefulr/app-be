<?php

namespace Database\Factories;

use App\Models\AuthPegawai;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AuthPegawai>
 */
class AuthPegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = AuthPegawai::class;
    public function definition(): array
    {
        return [
            'nip' => \App\Models\Pegawai::factory(),
            'password' => bcrypt('password123'), 
        ];
    }
}
