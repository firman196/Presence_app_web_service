<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\PostPresensiRequest;
use Carbon\Carbon;
use App\Models\RekapKehadiran;
use App\Helpers\ResponseFormatter;
use App\Http\Resources\Mobile\PresensiResource;

class PresensiController extends Controller
{
    public function postPresensi(PostPresensiRequest $request){
        try{
            $validated          = $request->validated();
            $nim                = auth()->user()->nim;
            $presensi_id        = $validated['presensi_id'];
            $kode_jadwal        = $validated['kode_jadwal'];
            $jam_presensi       = Carbon::now()->format('h:m:s');
            $tanggal_presensi   = Carbon::now()->toDate();
            $status             = 'success';
            
            //mencatat status kehadiran di rekap kehadiran
            RekapKehadiran::where('nim',$nim)->where('presensi_id',$presensi_id)->where('kode_jadwal',$kode_jadwal)->update(['kode_status_presensi'=>'H','jam_presensi'=> $jam_presensi,'tanggal_presensi'=>$tanggal_presensi,'status'=>$status]);
            $presensi = Presensi::where('id',$presensi_id)->first();
            $mahasiswa_alpha = $presensi->total_mahasiswa_alpha - 1;
            $mahasiswa_hadir = $presensi->total_mahasiswa_hadir + 1;
            $presensi->total_mahasiswa_alpha = $mahasiswa_alpha;
            $presensi->total_mahasiswa_hadir = $mahasiswa_hadir;
            $presensi->save();
            
            return ResponseFormatter::success(
                new PresensiResource(RekapKehadiran::where('nim',$nim)->where('presensi_id',$presensi_id)->first()),
                200
            );
          
        }catch(Illuminate\Database\QueryException $ex){
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ],'updated data failed', 500);
        }
    }
}
