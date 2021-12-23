<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;
    protected $table = 'ruangan';
    protected $fillable = [
        'kode_ruang',
        'nama_ruang',
        'kapasitas_ruang_kuliah',
        'kapasitas_ruang_ujian',
        'kode_prodi',
        'nama_gedung'
    ];


    /**
     * Get all of the comments for the Prodi
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function prodi()
    {
        return $this->belongsTo('App\Models\Prodi', 'kode_prodi', 'kode_prodi');
    }


    /**
    * 
    *
    * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function jadwal()
    {
        return $this->hasMany('App\Models\Jadwal', 'kode_ruang', 'kode_ruang');
    }

    /**
    * 
    *
    * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function beacon()
    {
        return $this->hasMany('App\Models\Beacon', 'kode_ruang', 'kode_ruang');
    }

}
