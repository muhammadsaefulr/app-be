<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitTugas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'gol',
        'eselon',
        'jabatan',
        'unit_kerja',
    ];

    protected $hidden = [
        'created_at',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip', 'nip');
    }
}
