<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;

    protected $table = 'matakuliah';
    protected $fillable = [
        'kode_matakuliah',
        'nama_matakuliah',
        'sifat_matakuliah',
        'jenis_matakuliah',
        'sks',
        'kode_prodi',
        'semester'
    ];
}
