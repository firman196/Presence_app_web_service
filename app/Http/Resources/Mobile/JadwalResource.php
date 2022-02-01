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
          
            'krs_id'            => $this->id,
            'kode_jadwal'       => $this->whenLoaded('jadwal',function(){
                return $this->jadwal->kode_jadwal;
            }),
            'jam_mulai'         => $this->whenLoaded('jadwal',function(){
                return $this->jadwal->jam_mulai;
            }),
            'jam_selesai'       => $this->whenLoaded('jadwal',function(){
                return $this->jadwal->jam_selesai;
            }),
            'hari_id'           => $this->whenLoaded('jadwal',function(){
                return $this->jadwal->hari->id;
            }),
            'hari'              => $this->whenLoaded('jadwal',function(){
                return $this->jadwal->hari->nama_hari;
            }),
            'kode_matakuliah'   => $this->whenLoaded('jadwal',function(){
                return $this->jadwal->matakuliah->kode_matakuliah;
            }),
            'nama_matakuliah'   => $this->whenLoaded('jadwal',function(){
                return $this->jadwal->matakuliah->nama_matakuliah;
            }),
            'sifat_matakuliah'  =>  $this->whenLoaded('jadwal',function(){
                return $this->jadwal->matakuliah->sifat_matakuliah == 'P'?'Pilihan':'Wajib';
            }),
            'jenis_matakuliah'  => $this->whenLoaded('jadwal',function(){
                return $this->jadwal->matakuliah->jenis_matakuliah == 'T'?'Teori':'Praktikum';
            }),
            'sks'               =>  $this->whenLoaded('jadwal',function(){
                return $this->jadwal->matakuliah->sks;
            }),
            'semester'          => $this->whenLoaded('jadwal',function(){
                return $this->jadwal->matakuliah->semester;
            }),
            'kode_ruang'        => $this->whenLoaded('jadwal',function(){
                return $this->jadwal->ruangan->kode_ruang;
            }),
            'nama_ruang'        => $this->whenLoaded('jadwal',function(){
                return $this->jadwal->ruangan->nama_ruang;
            }),
            'nama_gedung'       => $this->whenLoaded('jadwal',function(){
                return  $this->jadwal->ruangan->nama_gedung;
            }),
            'kelas'             => $this->whenLoaded('jadwal',function(){
                return  $this->jadwal->kelas->nama_kelas;
            }),
            'nama_dosen'        => $this->whenLoaded('jadwal',function(){
                return $this->when(
                    $this->jadwal->relationLoaded('dosens'), 
                    fn () => $this->jadwal->dosens->gelar_depan.$this->jadwal->dosens->nama.$this->jadwal->dosens->gelar_belakang
                );
            }),
            'foto_dosen'        =>  $this->whenLoaded('jadwal',function(){
                return $this->when(
                    $this->jadwal->relationLoaded('dosens'), 
                    fn () => config('services.image.baseUrl').config('services.image.path').'/'.$this->jadwal->dosens->foto
                );
            }),
            'presensi_id' => $this->whenLoaded('presensi',function(){
                return $this->presensi->id;
            }),
            'hari_presensi' => $this->whenLoaded('presensi',function(){
                return $this->presensi->hari->nama_hari;
            }),
            'pertemuan_ke'=> $this->whenLoaded('jadwal',function(){
                return $this->jadwal->pertemuan_ke;
            }),
            'status_kelas' => $this->whenLoaded('presensi',function(){
                return (\App\Helpers\GeneralHelper::check_jam_presensi($this->presensi->jam_presensi_dibuka,$this->presensi->jam_presensi_ditutup,$this->presensi->toleransi_keterlambatan))?'Opened':'Closed';
            }),
            'status_presensi'=>($this->status)?$this->status:null
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
