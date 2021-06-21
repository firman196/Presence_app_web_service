<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa';
    protected $fillable = [
        'nim',
        'nik',
        'nama',
        'angkatan',
        'kode_prodi',
        'kelas_id',
        'alamat',
        'kode_pos',
        'agama',
        'jenis_kelamin',
        'semester',
        'telp',
        'email',
        'dosen',
        'foto',
        'status'
    ];
}
