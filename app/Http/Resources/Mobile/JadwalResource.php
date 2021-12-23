<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\HariResource;

class JadwalResource extends JsonResource
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
          
            'kode_jadwal'       => $this->kode_jadwal,
            'jam_mulai'         => $this->jam_mulai,
            'jam_selesai'       => $this->jam_selesai,
            'hari'              => $this->whenLoaded('hari',function(){
                return $this->hari->nama_hari;
            }),
            'kode_matakuliah'   => $this->whenLoaded('matakuliah',function(){
                return $this->matakuliah->kode_matakuliah;
            }),
            'nama_matakuliah'   => $this->whenLoaded('matakuliah',function(){
                return $this->matakuliah->nama_matakuliah;
            }),
            'sifat_matakuliah'  =>  $this->whenLoaded('matakuliah',function(){
                return $this->matakuliah->sifat_matakuliah == 'P'?'Pilihan':'Wajib';
            }),
            'jenis_matakuliah'  => $this->whenLoaded('matakuliah',function(){
                return $this->matakuliah->jenis_matakuliah == 'T'?'Teori':'Praktikum';
            }),
            'sks'               =>  $this->whenLoaded('matakuliah',function(){
                return $this->matakuliah->sks;
            }),
            'semester'          => $this->whenLoaded('matakuliah',function(){
                return $this->matakuliah->semester;
            }),
            'kode_ruang'        => $this->whenLoaded('ruangan',function(){
                return $this->ruangan->kode_ruang;
            }),
            'nama_ruang'        => $this->whenLoaded('ruangan',function(){
                return $this->ruangan->nama_ruang;
            }),
            'nama_gedung'       => $this->whenLoaded('ruangan',function(){
                return  $this->ruangan->nama_gedung;
            }),
            'kelas'             => $this->whenLoaded('kelas',function(){
                return  $this->kelas->nama_kelas;
            }),
            'nama_dosen'        => $this->whenLoaded('dosens',function(){
                return $this->dosens->gelar_depan.$this->dosens->nama.$this->dosens->gelar_belakang;
            }),
           

           
        ];
/*
        'kode_matakuliah'   => $this->whenLoaded('matakuliah',function(){
            return $this->matakuliah->kode_matakuliah;
        }),
        'nama_matakuliah'   => $this->whenLoaded('matakuliah',function(){
            return $this->matakuliah->nama_matakuliah;
        }),
        'sifat_matakuliah'  =>  $this->whenLoaded('matakuliah',function(){
            return $this->matakuliah->sifat_matakuliah == 'P'?'Pilihan':'Wajib';
        }),
        'jenis_matakuliah'  => $this->whenLoaded('matakuliah',function(){
            return $this->matakuliah->jenis_matakuliah == 'T'?'Teori':'Praktikum';
        }),
        'sks'               =>  $this->whenLoaded('matakuliah',function(){
            return $this->matakuliah->sks;
        }),
        'semester'          => $this->whenLoaded('matakuliah',function(){
            return $this->matakuliah->semester;
        }),
        'nama_hari'         => $jadwal->hari->nama_hari,
        'jam_mulai'         => $jadwal->jam_mulai,
        'jam_selesai'       => $jadwal->jam_selesai,
        'kode_ruang'        => $jadwal->ruangan->kode_ruang,
        'nama_ruang'        => $jadwal->ruangan->nama_ruang,
        'nama_gedung'       => $jadwal->ruangan->nama_gedung,
        'kelas'             => $jadwal->kelas->nama_kelas,
        'nama_dosen'        => $jadwal->dosen->gelar_depan.$jadwal->dosen->nama.$jadwal->dosen->gelar_belakang,*/
    }


   


     
}
