<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwals';
    protected $fillable = [
        'kode_jadwal',
        'hari_id',
        'jam_mulai',
        'jam_selesai',
        'kode_matakuliah',
        'kode_ruang',
        'kelas_id',
        'dosen',
        'pertemuan_ke',
        'status'
    ];


     

    /**
    * 
    *
    * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function matakuliah()
    {
        return $this->belongsTo('App\Models\Matakuliah', 'kode_matakuliah', 'kode_matakuliah');
    }

    /**
    * 
    *
    * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function ruangan()
    {
        return $this->belongsTo('App\Models\Ruangan', 'kode_ruang', 'kode_ruang');
    }

     /**
    * 
    *
    * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas', 'kelas_id', 'id');
    }

     /**
    * 
    *
    * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function dosens()
    {
        return $this->belongsTo('App\Models\Dosen', 'dosen', 'nik');
    }

      /**
    * 
    *
    * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function hari()
    {
        return $this->belongsTo('App\Models\Hari', 'hari_id', 'id');
    }

    /**
    * 
    *
    * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function krs()
    {
        return $this->hasMany('App\Models\Krs', 'kode_jadwal', 'kode_jadwal');
    }


     /**
    * 
    *
    * @return \Illuminate\Database\Eloquent\Relations\hasOne
    */
    public function beritaAcara()
    {
        return $this->hasOne('App\Models\BeritaAcara', 'kode_jadwal', 'kode_jadwal');
    }


    /**
    * 
    *
    * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function presensi()
    {
        return $this->hasMany('App\Models\Presensi', 'kode_jadwal', 'kode_jadwal');
    }

     /**
    * 
    *
    * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function rekapKehadiran()
    {
        return $this->hasMany('App\Models\RekapKehadiran', 'kode_jadwal', 'kode_jadwal');
    }



}
