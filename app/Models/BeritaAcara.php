<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaAcara extends Model
{
    use HasFactory;

    protected $table    = 'berita_acaras';
    protected $fillable = [
        'kode_jadwal',
        'materi_perkuliahan',
        'penugasan',
        'tanggal_pertemuan',
        'total_mahasiswa_hadir',
        'total_mahasiswa_alpha',
        'total_mahasiswa_izin',
        'jam_presensi_dibuka',
        'jam_presensi_ditutup',
        'media_perkuliahan',
        'catatan_perkuliahan'
    ];


    /**
    * 
    *
    * @return \Illuminate\Database\Eloquent\Relations\hasOne
    */
    public function jadwal()
    {
        return $this->hasOne('App\Models\Jadwal', 'kode_jadwal', 'kode_jadwal');
    }

}
