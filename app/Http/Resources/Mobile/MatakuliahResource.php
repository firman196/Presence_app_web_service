<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;

class MatakuliahResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'kode_matakuliah'   => $this->matakuliah->kode_matakuliah,
            'nama_matakuliah'   => $jadwal->matakuliah->nama_matakuliah,
            'sifat_matakuliah'  => $jadwal->matakuliah->sifat_matakuliah == 'P'?'Pilihan':'Wajib',
            'jenis_matakuliah'  => $jadwal->matakuliah->jenis_matakuliah == 'T'?'Teori':'Praktikum',
            'sks'               => $jadwal->matakuliah->sks,
            'semester'          => $jadwal->matakuliah->semester,
        ];
    }
}
