<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hari extends Model
{
    use HasFactory;
    protected $table = 'haris';
    protected $fillable = [
        'nama_hari'
    ];



    /**
    * 
    *
    * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function jadwal()
    {
        return $this->hasMany('App\Models\Jadwal', 'hari_id', 'id');
    }

    /**
    *
    *
    * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function presensi()
    {
        return $this->hasMany('App\Models\Presensi', 'hari_id', 'id');
    }
}
