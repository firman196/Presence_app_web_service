<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Jadwal;
use App\Models\Krs;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\Api\GetJadwalRequest;
use App\Http\Resources\Mobile\JadwalResource;

class JadwalController extends Controller
{
    public function getJadwal(GetJadwalRequest $request){
      
        $nim     = auth()->user()->nim;

        $jadwals = Jadwal::whereHas('krs',function($q) use($nim){
            $q->where('nim',$nim);
        })->with(['krs','matakuliah','ruangan','kelas','dosens','hari']);
        return JadwalResource::collection($jadwals->paginate(10))->additional(['meta' => [
            'code'      =>200,
            'status'    =>'success',
            'message'   => 'get data jadwal successfully'   
        ]]);
        /*return ResponseFormatter::success(
            JadwalResource::collection($jadwals->paginate(10)),
            'get data jadwal successfully',
            200
        );*/
    }



    public function getJadwalById($id){
        try {
            $nim     = auth()->user()->nim;
            $jadwal  = Jadwal::whereHas('krs',function($q) use($nim){
                $q->where('nim',$nim);
            })->with(['krs','matakuliah','ruangan','kelas','dosens','hari'])->firstOrFail();
            
            return ResponseFormatter::success(
                new JadwalResource($jadwal),
                200
            );
        }catch(ModelNotFoundException $e) {
            $data = [];
            return ResponseFormatter::success(
                $data,
                404
            );
        }
       
    }




    
}
