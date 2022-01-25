<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;

class RuanganResource extends JsonResource
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
            'kode_ruang'                => $this->kode_ruang,
            'nama_ruang'                => $this->nama_ruang,
            'kapasitas_ruang_kuliah'    => $this->kapasitas_ruang_kuliah,
            'kapasitas_ruang_ujian'     => $this->kapasitas_ruang_ujian,
        ];
    }
}
