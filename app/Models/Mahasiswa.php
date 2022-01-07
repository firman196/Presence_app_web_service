<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; 
class Mahasiswa  extends Authenticatable
{
    use HasFactory,Notifiable,HasApiTokens;
   // protected $guard = 'mahasiswa';
    protected $table = 'mahasiswas';
    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'nim',
        'nama',
        'kode_prodi',
        'kelas_id',
        'semester',
        'telp',
        'email',
        'dosen',
        'foto',
        'status',
        'password'
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
    * Get the prodi that owns the Mahasiswa
    *
    * @return \Illuminate\Database\Eloquent\Relations\hasOne
    */
    public function prodi()
    {
        return $this->hasOne('App\Models\Prodi', 'kode_prodi', 'kode_prodi');
    }


    /**
    * Get the dosen that owns the Mahasiswa
    *
    * @return \Illuminate\Database\Eloquent\Relations\hasOne
    */
    public function dosens()
    {
        return $this->belongsTo('App\Models\Dosen', 'dosen', 'nik');
    }


     /**
    * Get the kelas that owns the Mahasiswa
    *
    * @return \Illuminate\Database\Eloquent\Relations\hasOne
    */
    public function kelas()
    {
        return $this->belongsTo('App\Models\Kelas', 'kelas_id', 'id');
    }

    /**
    * 
    *
    * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function suratIzin()
    {
        return $this->hasMany('App\Models\SuratIzin', 'nim', 'nim');
    }


}
