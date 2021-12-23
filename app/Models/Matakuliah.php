<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;

    protected $table = 'matakuliah';
    //protected $primaryKey = 'kode_matakuliah';
    protected $fillable = [
        'kode_matakuliah',
        'nama_matakuliah',
        'sifat_matakuliah',
        'jenis_matakuliah',
        'sks',
        'kode_prodi',
        'semester'
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
    * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function jadwal()
    {
        return $this->hasMany('App\Models\Jadwal', 'kode_matakuliah', 'kode_matakuliah');
    }

}
