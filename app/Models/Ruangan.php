<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;
    protected $table = 'ruangan';
    protected $fillable = [
        'kode_ruang',
        'nama_ruang',
        'kapasitas_ruang_kuliah',
        'kapasitas_ruang_ujian',
        'kode_prodi',
        'nama_gedung'
    ];




}
