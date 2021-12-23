<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use File;
use Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function __construct(){
        $this->mahasiswa    = new \App\Services\MahasiswaService;
        $this->beacon       = new \App\Services\BeaconService;
        $this->user         = new \App\Services\UserService;
        $this->prodi        = new \App\Services\ProdiService;
        $this->kelas        = new \App\Services\KelasService;
        $this->dosen        = new \App\Services\DosenService;
        $this->ruangan      = new \App\Services\RuanganService;
        $this->matakuliah   = new \App\Services\MatakuliahService;
        $this->jadwal       = new \App\Services\JadwalService;
        $this->hari         = new \App\Services\HariService;
        $this->jenisIzin    = new \App\Services\JenisIzinService;


    }


    public function uploadFoto($file, $oldFile){
        if($oldFile != null) {
            $pathFile = $destinationPath.$oldFile;
            if(File::exists($pathFile)){
                File::delete($pathFile);
            }
        }

        $setFile = str_replace(' ', '', strtolower($request['nama']));
        $filename = date("dmY").'_'.$setFile.'.'.$file->getClientOriginalExtension();
        if(!File::exists($destinationPath.$filename)){
            $file->move($destinationPath, $filename);
        }
    }


   
}
