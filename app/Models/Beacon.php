<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beacon extends Model
{
    use HasFactory;

    protected $table = 'beacons';
    protected $fillable = [
        'kode_beacon',
        'kode_ruang',
        'uuid',
        'major',
        'minor',
        'jarak_maksimal'
    ];

      /**
    * 
    *
    * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function ruangan()
    {
        return $this->belongsTo('App\Models\Ruangan', 'kode_ruang', 'kode_ruang');
    }

}
