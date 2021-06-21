<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';
    protected $fillable = [
        'hari',
        'jam_mulai',
        'jam_selesai',
        'kode_matakuliah',
        'kode_ruang',
        'kelas_id',
        'nik'
    ];
}
