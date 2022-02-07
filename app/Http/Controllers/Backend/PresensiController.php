<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hari;
use App\Models\Presensi;
use App\Models\Jadwal;
use App\Models\Krs;
use App\Models\RekapKehadiran;
use App\Models\StatusPresensi;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\PresensiUpdateRequest;
use DB;
use PDF;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Presensi.index',[
            'title'         => 'Jadwal Matakuliah Anda',
            'breadcrumb'    => 'presensi',
            'url'           => '/presensi',
            'haris'         => Hari::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ids        = \Crypt::decrypt($id);
        return view('Presensi.show',[
            'title'         => 'Daftar Absensi Mahasiswa',
            'breadcrumb'    => 'presensi/show',
            'url'           => '/presensi/'.$id,
            'jadwal'        => Jadwal::with(['matakuliah','ruangan','kelas','dosens','hari','presensi'])->where('kode_jadwal',$ids)->first(),
            'haris'         => Hari::all(),
            'status'        => StatusPresensi::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
    }

    /**
     * Activated presence
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PresensiUpdateRequest $request, $id)
    {
        try{
            $ids                    = \Crypt::decrypt($id);
            $validated              = $request->validated();
         
            Presensi::where('id',$ids)->update($validated);
            return ResponseFormatter::success(
                'updated data successfully',
                200
            );
        }catch(\Exception $e){
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ],'updated data failed', 500);
        }
    }


   

    /**
     * Non activated presence.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $ids                    = \Crypt::decrypt($id);
            //update status presensi
            Presensi::where('id',$ids)->update(['status'=>'nonaktif']);
            //delete mahasiswa from rekap kehadiran
            RekapKehadiran::where('presensi_id',$ids)->delete();
            return ResponseFormatter::success(
                'updated data successfully',
                200
            );
        }catch(\Exception $e){
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ],'updated data failed', 500);
        }
    }


     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function generate(Request $request, $id)
    {
        DB::beginTransaction();  
        try{
            $ids            = \Crypt::decrypt($id);
            $kode_jadwal    = $request->kode_jadwal;
            $hari_id        = $request->hari_id;
            $jam_mulai      = $request->jam_mulai;
            $jam_ditutup    = date('H:i:s', strtotime('+15 minutes', strtotime($jam_mulai)));

            //generate 14 pertemuan
            for ($i = 1 ;$i<=16;$i++){
                $data[] = [
                    'kode_jadwal'               => $kode_jadwal,
                    'pertemuan_ke'              => $i,
                    'hari_id'                   => $hari_id,
                    'jam_presensi_dibuka'       => $jam_mulai,
                    'jam_presensi_ditutup'      => $jam_ditutup,
                    'toleransi_keterlambatan'   => 0
                ];
               
            }
            //insert pertemuan
            Presensi::insert($data);
            //merubah flag status di jadwal
            Jadwal::where('kode_jadwal',$kode_jadwal)->update(['status'=>'aktif']);
            
            //mengaktifkan presensi pertemuan 1
            $presensiSekarang       = Presensi::where('pertemuan_ke',1)->where('kode_jadwal',$kode_jadwal)->first();
            //generate data krs
            $data_krs               = Krs::where('kode_jadwal',$presensiSekarang->kode_jadwal)->get();
            $data                   = array();
            foreach($data_krs as $krs){
                $datas    = [
                    'presensi_id'           => $presensiSekarang->id,
                    'kode_jadwal'           => $presensiSekarang->kode_jadwal,
                    'nim'                   => $krs->nim,
                    'kode_status_presensi'  => 'A'
                ];
                $data[] = $datas;
            }
            ///mengaktifkan presensi pertemuan 1
            $presensiSekarang->status                = 'aktif';
            //semua mahasiswa dianggap alpha secara default
            $presensiSekarang->total_mahasiswa_alpha = $data_krs->count();
            $presensiSekarang->save();
            //membuat rekap kehadiran untuk presensi untuk pertemuan 1
            RekapKehadiran::insert($data);
            DB::commit();
            return ResponseFormatter::success(
                'updated data successfully',
                200
            );
        }catch(\Exception $e){
            DB::rollback();
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ],'updated data failed', 500);
        }
    }

    public function updateStatus(Request $request,$id){
        try{
            $ids    = \Crypt::decrypt($id);
          
            RekapKehadiran::where('id',$ids)->update(['kode_status_presensi'=>$request->status]);

            return ResponseFormatter::success(
                'updated data successfully',
                200
            );
        }catch(\Exception $e){
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ],'updated data failed', 500);
        }
    }


    public function cetakPresensi($id){
        $ids        = \Crypt::decrypt($id);
        $presensi   = Presensi::with(['jadwal','jadwal.dosens','jadwal.kelas','jadwal.matakuliah','hari'])->where('id',$ids)->first();
        $kehadirans = RekapKehadiran::with(['mahasiswa'])->where('presensi_id',$ids)->get();

        $pdf= PDF::loadview('Presensi/cetak-presensi',['kehadirans'=>(isset($kehadirans))? $kehadirans:null, 'presensi'=>(isset($presensi))?$presensi:null]);
        $pdf->setPaper('A4','potrait');
        return $pdf->stream('Cetak_Presensi.pdf');
    }

   
}
