<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Dosen;
use App\Models\Hari;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Matakuliah;
use App\Models\Ruangan;
use App\Http\Requests\JadwalStoreRequest;
use App\Http\Requests\JadwalUpdateRequest;
use App\Helpers\ResponseFormatter;

class JadwalController extends Controller
{
    
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title          = 'Data Jadwal Matakuliah';
        $breadcrumb     = 'Jadwal';
        $url            = "/jadwal";
        $dosens         = Dosen::all();
        $matakuliahs    = Matakuliah::all();
        $kelass         = Kelas::all();
        $ruangs         = Ruangan::all();
        $haris          = Hari::all();

        return view('Jadwal.index',compact('title','breadcrumb','url','matakuliahs','kelass','ruangs','dosens','haris'));
    }


   

  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JadwalStoreRequest $request)
    {
        try{
            $validated = $request->validated();
            Jadwal::insert($validated);
                    
            return ResponseFormatter::success(
                'store data successfully',
                200
            );
        }catch(\Exception $e){
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ],'store data failed', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(JadwalUpdateRequest $request, $id)
    {       
        try{
            $ids       = \Crypt::decrypt($id);
            $validated = $request->validated();
            Jadwal::where('kode_jadwal',$ids)->update($validated);
          
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
        //mulai transaksi
        try{
            $ids  = \Crypt::decrypt($id); 
            Jadwal::where('kode_jadwal',$ids)->delete();
           
            return ResponseFormatter::success(
                'deleted data successfully',
                200
            );
        } catch (\Throwable $e) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ],'updated data failed', 500);
        }     
    }
}
