<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapKehadiran extends Model
{
    use HasFactory;
    protected $fillable = [
        'presensi_id',
        'kode_status_presensi',
        'jam_presensi',
        'tanggal_presensi',
        'nim'
    ];

    /**
    * 
    *
    * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function presensi()
    {
        return $this->belongsTo('App\Models\Presensi', 'presensi_id', 'id');
    }

    /**
    * 
    *
    * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function mahasiswa()
    {
        return $this->belongsTo('App\Models\Mahasiswa', 'nim', 'nim');
    }


}
