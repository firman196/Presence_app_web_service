<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';
    protected $fillable = [
        'nik',
        'nip',
        'nama',
        'alamat',
        'kode_pos',
        'kode_prodi',
        'jenjang_pendidikan_id',
        'gelar_depan',
        'gelar_belakang',
        'agama',
        'telp',
        'email',
        'foto',
        'status'
    ];
}
