<?php

namespace App\Http\Resources\Mobile;

use Illuminate\Http\Resources\Json\JsonResource;

class BeaconsResource extends JsonResource
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
            'kode_beacon'   => $this->kode_beacon,
            'kode_ruang'    => $this->kode_ruang,
            'uuid'          => $this->uuid,
            'major'         => $this->major,
            'minor'         => $this->minor,
            'jarak_maksimal'=> $this->jarak_maksimal
        ];
    }
}
