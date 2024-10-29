<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TempatTugasPegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'tempat_tugas'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nip');
    }
}
