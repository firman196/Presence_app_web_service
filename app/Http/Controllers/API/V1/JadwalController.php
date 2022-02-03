<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Jadwal;
use App\Models\Krs;
use App\Models\Hari;
use App\Models\Presensi;
use App\Models\RekapKehadiran;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\Api\GetJadwalRequest;
use App\Http\Resources\Mobile\JadwalResource;

class JadwalController extends Controller
{
    public function getJadwalSekarang(){
        $nim        = auth()->user()->nim;
        $hari_ini   = Carbon::now()->isoFormat('dddd');
        $hari       = Hari::where('nama_hari',$hari_ini)->first();

       // $presensi   = 
        $jadwals    = RekapKehadiran::with(['jadwal','jadwal.matakuliah','jadwal.ruangan','jadwal.kelas','jadwal.dosens','jadwal.hari','presensi'])->where('nim',$nim)->whereHas('presensi',function($q) use ($hari){
            $q->where('status','aktif')->where('hari_id',$hari->id??'');
        })->where('status','default');

        return JadwalResource::collection($jadwals->paginate(10))->additional(['meta' => [
            'code'      =>200,
            'status'    =>'success',
            'message'   => 'get data jadwal successfully'   
        ]]);
    }

    public function getJadwal(Request $request){
        $nim     = auth()->user()->nim;
        $hari_id = $request->hari_id;
        $jadwals = Krs::with(['jadwal','jadwal.matakuliah','jadwal.ruangan','jadwal.kelas','jadwal.dosens','jadwal.hari',])->where('nim',$nim)->whereHas('jadwal',function($q) use ($hari_id){
            $q->orderBy('jam_mulai','asc');
        });
       /* $jadwals = Presensi::with(['rekapKehadiran'=>function($q) use($nim){
            $q->where('nim',$nim);
        },'jadwal','jadwal.matakuliah','jadwal.ruangan','jadwal.kelas','jadwal.dosens','jadwal.hari'])->where('status','aktif')->orderBy('pertemuan_ke','asc');*/
        return JadwalResource::collection($jadwals->paginate(10))->additional(['meta' => [
            'code'      =>200,
            'status'    =>'success',
            'message'   => 'get data jadwal successfully'   
        ]]);
      
    }


    public function getHistoryJadwal(Request $request){
        $nim        = auth()->user()->nim;
        $jadwals    = RekapKehadiran::with(['jadwal','jadwal.matakuliah','jadwal.ruangan','jadwal.kelas','jadwal.dosens','jadwal.hari','presensi'])->where('nim',$nim)->where('status','!=','default')->whereHas('presensi',function($q){
            $q/*->where('status','nonaktif')*/->orderBy('pertemuan_ke','desc');
        })->whereHas('jadwal',function($q){
            $q->where('status','aktif');
        });

        return JadwalResource::collection($jadwals->paginate(10))->additional(['meta' => [
            'code'      =>200,
            'status'    =>'success',
            'message'   => 'get data jadwal successfully'   
        ]]);
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
