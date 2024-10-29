<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontakPegawai extends Model
{
    use HasFactory;

    protected $table = "kontak_pegawais";

    protected $fillable = [
        'no_hp',
        'nip',
        'email',
        'npwp'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nip');
    }
}
