<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $table = 'presensis';
    protected $fillable = [
        'kode_jadwal',
        'pertemuan_ke',
        'hari_id',
        'jam_presensi_dibuka',
        'jam_presensi_ditutup',
        'toleransi_keterlambatan',
        'status',
        'tanggal_pertemuan',
        'total_mahasiswa_hadir',
        'total_mahasiswa_alpha',
        'total_mahasiswa_izin',
        'materi_perkuliahan',
        'penugasan',
        'media_perkuliahan',
        'catatan_perkuliahan'
      /*  'kode_status_presensi',
        'pertemuan_ke',
        'tanggal_presensi',
        'kode_beacon'*/
    ];


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
    * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function krs()
    {
        return $this->belongsTo('App\Models\Krs', 'krs_id', 'id');
    }


    /**
     * 
     * 
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function statusPresensi()
    {
        return $this->belongsTo('App\Models\StatusPresensi','kode_status_presensi','kode');
    }   
    
    
    /**
    * 
    *
    * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function jadwal()
    {
        return $this->belongsTo('App\Models\Jadwal', 'kode_jadwal', 'kode_jadwal');
    }


    /**
    * 
    *
    * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function rekapKehadiran()
    {
        return $this->hasMany('App\Models\RekapKehadiran', 'presensi_id', 'id');
    }
}
