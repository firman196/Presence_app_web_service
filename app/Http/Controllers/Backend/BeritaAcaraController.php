<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
//models
use App\Models\Krs;
use App\Models\Jadwal;
use App\Models\Presensi;
use App\Models\RekapKehadiran;

use App\Helpers\ResponseFormatter;
use App\Http\Requests\BeritaAcaraUpdateRequest;


class BeritaAcaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('BeritaAcara.index',[
            'title'         => 'Jadwal Matakuliah Anda',
            'breadcrumb'    => 'beritaacara',
            'url'           => '/beritaacara'
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
        return view('BeritaAcara.show',[
            'title'         => 'Daftar Berita Acara',
            'breadcrumb'    => 'presensi/show',
            'url'           => '/presensi/'.$id,
            'jadwal'        => Jadwal::with(['matakuliah','ruangan','kelas','dosens','hari','presensi'])->where('kode_jadwal',$ids)->first(),
            'beritaAcaras'  => Presensi::with(['hari'])->where('kode_jadwal',$ids)->get(),
            'time'          => Carbon::now(),

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BeritaAcaraUpdateRequest $request, $id)
    {
        try{
            $ids                    = \Crypt::decrypt($id);
            $validated              = $request->validated();
            $validated['status']    = 'nonaktif';

            //update status presensi
            Presensi::where('id',$ids)->update($validated);
            //rubah status rekap kehadiran
            RekapKehadiran::where('presensi_id',$ids)->where('kode_status_presensi','A')->where('status','default')->update(['status'=>'expired']);
            
            $presensi               = Presensi::where('id',$ids)->first();

            //mengaktifkan presensi pertemuan selanjutnya
            $pertemuanSekarang      = $presensi->pertemuan_ke + 1;
            $presensiSekarang       = Presensi::where('pertemuan_ke',$pertemuanSekarang)->where('kode_jadwal',$presensi->kode_jadwal)->first();

            //generate data krs
            $data_krs = Krs::where('kode_jadwal',$presensiSekarang->kode_jadwal)->get();
            $data = array();
            foreach($data_krs as $krs){
                $datas    = [
                    'presensi_id'           => $presensiSekarang->id,
                    'kode_jadwal'           => $presensiSekarang->kode_jadwal,
                    'nim'                   => $krs->nim,
                    'kode_status_presensi'  => 'A'
                ];
                $data[] = $datas;
            }
            ///mengaktifkan presensi selanjutnya
            $presensiSekarang->status= 'aktif';
            //semua mahasiswa dianggap alpha secara default
            $presensiSekarang->total_mahasiswa_alpha = $data_krs->count();
            $presensiSekarang->save();
            
            //membuat rekap kehadiran untuk presensi selanjutnya
            RekapKehadiran::insert($data);

            //mengupdate presensi di jadwal
            Jadwal::where('kode_jadwal',$presensiSekarang->kode_jadwal)->update(['pertemuan_ke'=>$pertemuanSekarang]);

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
