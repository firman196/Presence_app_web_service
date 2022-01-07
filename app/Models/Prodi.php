<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $table = 'prodis';
    
    protected $fillable = [
        'kode_prodi',
        'nama_prodi',
        'jenjang',
        'kaprodi'
    ];


    /**
     * Get all of the comments for the Prodi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function dosen()
    {
        return $this->hasOne('App\Models\Dosen', 'kode_prodi', 'kode_prodi');
    }

    /**
     * Get all of the comments for the Prodi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ruangan()
    {
        return $this->hasMany('App\Models\Ruangan', 'kode_prodi', 'kode_prodi');
    }

     /**
     * Get all of the comments for the Matakuliah
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function matakuliah()
    {
        return $this->hasMany('App\Models\Matakuliah', 'kode_prodi', 'kode_prodi');
    }

    /**
     * Get all of the comments for the Prodi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mahasiswa()
    {
        return $this->hasMany('App\Models\Mahasiswa', 'kode_prodi', 'kode_prodi');
    }

}
