<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hari;
use App\Models\Presensi;
use App\Models\Jadwal;
use App\Models\Krs;
use App\Models\RekapKehadiran;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\PresensiUpdateRequest;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //$kelass         = Kelas::all();
       // $ruangs         = Ruangan::all();

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
            'haris'         => Hari::all()
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
            $validated['status']    = 'aktif';
            //update status presensi
            Presensi::where('id',$ids)->update($validated);
          
            //generate data krs mahasiswa ke tabel rekap kehadiran
            $data_krs = Krs::where('kode_jadwal',$request->kode_jadwal)->get();
            $data = array();
            foreach($data_krs as $krs){
                $datas    = [
                    'presensi_id'           => $ids,
                    'nim'                   => $krs->nim
                ];
                $data[] = $datas;
            }
 
            RekapKehadiran::insert($data);
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
        try{
            
            $ids            = \Crypt::decrypt($id);
            $kode_jadwal    = $request->kode_jadwal;
            $hari_id        = $request->hari_id;
            $jam_mulai      = $request->jam_mulai;
            $jam_ditutup    = date('H:i:s', strtotime('+15 minutes', strtotime($jam_mulai)));

            //generate 14 pertemuan
            
            for ($i = 1 ;$i<=14;$i++){
           
                $data[] = [
                    'kode_jadwal'               => $kode_jadwal,
                    'pertemuan_ke'              => $i,
                    'hari_id'                   => $hari_id,
                    'jam_presensi_dibuka'       => $jam_mulai,
                    'jam_presensi_ditutup'      => $jam_ditutup,
                    'toleransi_keterlambatan'   => 0
                ];
               
            }
           
            Presensi::insert($data);
            Jadwal::where('kode_jadwal',$kode_jadwal)->update(['status'=>'aktif']);
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

   
}