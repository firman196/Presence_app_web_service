<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $fillable = [
        'nama_kelas',
    ];


    /**
    * 
    *
    * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function jadwal()
    {
        return $this->hasMany('App\Models\Jadwal', 'kelas_id', 'id');
    }

    /**
    * 
    *
    * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function mahasiswa()
    {
        return $this->hasMany('App\Models\Mahasiswa', 'kelas_id', 'id');
    }
    
}
