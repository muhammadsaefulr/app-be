<?php

namespace Database\Seeders;

use App\Models\AuthPegawai;
use App\Models\Pegawai;
use App\Models\KontakPegawai;
use App\Models\TempatTugasPegawai;
use App\Models\UnitTugas;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pegawai::factory(15)->create()->each(function ($pegawai) {
            AuthPegawai::factory()->create([
                'nip' => $pegawai->nip, 
            ]);

            KontakPegawai::factory()->create([
                'nip' => $pegawai->nip,
            ]);

            UnitTugas::factory()->create([
                'nip' => $pegawai->nip,
            ]);

            TempatTugasPegawai::factory()->create([
                'nip' => $pegawai->nip,
            ]);
        });
    }
}
