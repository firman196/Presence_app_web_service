<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    use HasFactory;
    protected $table = 'krs';
    protected $fillable = [
        'kode_jadwal',
        'nim',
        'tanggal_krs'
    ];

    /**
     * Scope filter data mahasiswa
     * 
     * @param string
     * @param array
     * 
     * @return query
     */
    public function scopeFilter($query, array $filter){
        //filter berdasarkan nim
        $query->when($filter['nim'] ?? false, function($query, $nim){
            return $query->where('nim',$nim);
        });
    }

    /**
    * 
    *
    * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function jadwal()
    {
        return $this->belongsTo('App\Models\Jadwal', 'kode_jadwal', 'kode_jadwal');
    }

    /**
    * 
    *
    * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function mahasiswa()
    {
        return $this->belongsTo('App\Models\Mahasiswa', 'nim', 'nim');
    }
}
