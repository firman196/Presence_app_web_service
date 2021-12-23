<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratIzin extends Model
{
    use HasFactory;

    protected $table = 'surat_izins';
    protected $fillable = [
        'kode_jenis_izin',
        'nim',
        'presensi_id',
        'judul_surat_izin',
        'keterangan_mahasiswa',
        'keterangan_dosen',
        'foto_surat_izin',
        'status'
    ];

    /**
    * 
    *
    * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function jenisIzin()
    {
        return $this->belongsTo('App\Models\JenisIzin','kode_jenis_izin','kode');
    }

    /**
    * 
    *
    * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function mahasiswa()
    {
        return $this->belongsTo('App\Models\Mahasiswa','nim','nim');
    }


    /**
    * 
    *
    * @return \Illuminate\Database\Eloquent\Relations\hasOne
    */
    public function presensi()
    {
        return $this->hasOne('App\Models\Presensi','presensi_id','id');
    }


   
}
