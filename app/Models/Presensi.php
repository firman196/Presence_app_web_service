<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $table = 'presensis';
    protected $fillable = [
        'krs_id',
        'hadir',
        'sakit',
        'ijin',
        'tanggal'
    ];


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
}
