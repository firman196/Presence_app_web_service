<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Kelas;
use App\Models\Dosen;

class KrsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title      = 'Data KRS Mahasiswa';
        $breadcrumb = 'Krs';
        $url        = "/krs";
        $prodis     = Prodi::all();
        $kelass     = Kelas::all();
        $dosens     = Dosen::all();

        return view('Krs.index',compact('prodis','kelass','dosens','title','breadcrumb','url'));
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
        $title      = 'Jadwal Matakuliah Diambil';
        $breadcrumb = 'Krs';
        $url        = "/krs";
        $mahasiswa  = Mahasiswa::with(['prodi','dosen','kelas'])->where('nim',$ids)->first();
     //   $krs        = Krs::with(['jadwal.matakuliah','jadwal.ruangan','jadwal.kelas','jadwal.dosens','jadwal.hari'])->where('nim',$ids)->first();

        return view('Krs.index-krs',compact('mahasiswa','title','breadcrumb','url'));
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
