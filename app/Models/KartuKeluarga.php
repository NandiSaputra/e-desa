<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KartuKeluarga extends Model
{
    protected $table = 'kartu_keluargas';
 
    protected $fillable = [
        'no_kk',
        'kepala_keluarga',
        'alamat',
        'rt',
        'rw',
        'desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'status'
    ];

    public function anggotaKeluarga()
    {
        return $this->hasMany(Warga::class, 'kartu_keluarga_id');
    }
}
