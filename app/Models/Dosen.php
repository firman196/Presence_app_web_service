<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Dosen  extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'dosen';
    protected $table = 'dosens';
    protected $primaryKey = 'nik';
    protected $fillable = [
        //'nik',        
        'nip',       
        'nama',    
        'kode_prodi',
        'jenjang_pendidikan',
        'gelar_depan',
        'gelar_belakang',
        'foto',
        'telp',        
        'email',
        'status',  
        'password', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
    * Get the prodi that owns the Dosen
    *
    * @return \Illuminate\Database\Eloquent\Relations\hasOne
    */
    public function prodi()
    {
        return $this->hasOne('App\Models\Prodi', 'kode_prodi', 'kode_prodi');
    }


    /**
    * 
    *
    * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function jadwal()
    {
        return $this->hasMany('App\Models\Jadwal', 'dosen', 'nik');
    }

}
