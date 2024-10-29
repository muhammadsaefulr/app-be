<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{

    use HasFactory;

    protected $table = 'pegawai';

    protected $fillable = [
        'nip',
        'nama',
        'tempat_lahir',
        'tgl_lahir',
        'alamat',
        'gender',
        'agama',
        'foto_pegawai'
    ];

    public function unitTugas()
    {
        return $this->hasOne(UnitTugas::class, 'nip', 'nip')->withDefault(function ($unitTugas) {
            $unitTugas->gol = '';
            $unitTugas->eselon = '';
            $unitTugas->jabatan = '';
            $unitTugas->unit_kerja = '';
        });
    }

    public function kontakPegawai()
    {
        return $this->hasOne(KontakPegawai::class, 'nip', 'nip')->withDefault(function($kontakPegawai){
            $kontakPegawai->no_hp = '';
            $kontakPegawai->email = '';
            $kontakPegawai->npwp = '';
        });
    }

    public function tempatTugasPegawai()
    {
        return $this->hasOne(TempatTugasPegawai::class, 'nip', 'nip')->withDefault(function ($tempatTugasPegawai) {
            $tempatTugasPegawai->tempat_tugas = '';
        });
    }
}
