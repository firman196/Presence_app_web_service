<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Jadwal;
use App\Models\Krs;
use App\Models\Hari;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\Api\GetJadwalRequest;
use App\Http\Resources\Mobile\JadwalResource;

class JadwalController extends Controller
{

    public function getJadwalSekarang(){
        $nim        = auth()->user()->nim;
        $hari_ini   = Carbon::now()->isoFormat('dddd');
        $hari       = Hari::where('nama_hari',$hari_ini)->first();

        $jadwals = Krs::with(['jadwal','jadwal.matakuliah','jadwal.ruangan','jadwal.kelas','jadwal.dosens','jadwal.hari'])->where('nim',$nim)->whereHas('jadwal',function($q) use ($hari){
            $q->where('hari_id',$hari->id??'');
        });

        return JadwalResource::collection($jadwals->paginate(10))->additional(['meta' => [
            'code'      =>200,
            'status'    =>'success',
            'message'   => 'get data jadwal successfully'   
        ]]);

    }

    public function getJadwal(Request $request){
        $nim     = auth()->user()->nim;
        $jadwals = Krs::with(['jadwal','jadwal.matakuliah','jadwal.ruangan','jadwal.kelas','jadwal.dosens','jadwal.hari'])->where('nim',$nim);
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
            $jadwal  = Krs::with(['jadwal','jadwal.matakuliah','jadwal.ruangan','jadwal.kelas','jadwal.dosens','jadwal.hari'])->where('nim',$nim)->firstOrFail();
            
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
