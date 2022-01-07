<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hari;
use App\Models\Presensi;
use App\Models\Jadwal;

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
        $ids = \Crypt::decrypt($id);
        return view('Presensi.show',[
            'title'         => 'Daftar Absensi Mahasiswa',
            'breadcrumb'    => 'presensi/show',
            'url'           => '/presensi/'.$id,
            'jadwal'        => Jadwal::with(['matakuliah','ruangan','kelas','dosens','hari'])->where('kode_jadwal',$ids)->first(),
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
