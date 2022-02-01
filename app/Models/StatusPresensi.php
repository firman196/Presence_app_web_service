<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPresensi extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $primaryKey = 'kode';
    protected $fillable = [
        'keterangan'
    ];

    /**
    * 
    *
    * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function presensi()
    {
        return $this->hasMany('App\Models\Presensi','kode_status_presensi','kode');
    }
}
