<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Presensi;
use Carbon\Carbon;

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
    public function update(Request $request, $id)
    {
        //
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
