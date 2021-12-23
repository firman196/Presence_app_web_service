<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisIzin extends Model
{
    use HasFactory;

    protected $table = 'jenis_izins';
    protected $primaryKey = 'kode';
    public $incrementing = false;

    protected $fillable = [
        'kode',
        'keterangan'
    ];

    /**
    * 
    *
    * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function suratIzin()
    {
        return $this->hasMany('App\Models\SuratIzin','kode_jenis_izin','kode');
    }
}
