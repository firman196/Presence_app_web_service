<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;

class MahasiswaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'nim'       => $this->nim,
            'nama'      => $this->nama,
            'prodi'     => $this->whenLoaded('prodi',function(){
                return $this->prodi->nama_prodi;
            }),   
            'kelas'     => $this->whenLoaded('kelas',function(){
                return $this->kelas->nama_kelas;
            }),  
            'dosen'     => $this->whenLoaded('dosens',function(){
                return $this->dosens->nama;
            }),  
            'foto'      => config('services.image.baseUrl').config('services.image.path').'/'.$this->foto,
            'email'     => $this->email,
            'semester'  => $this->semester,
            'telp'      => $this->telp 
        ];
    }
}
