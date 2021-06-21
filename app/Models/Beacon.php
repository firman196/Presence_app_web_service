<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beacon extends Model
{
    use HasFactory;

    protected $table = 'beacons';
    protected $fillable = [
        'kode_ruang',
        'uuid',
        'jarak_max'
    ];
}
