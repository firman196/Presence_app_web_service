<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Ruangan;
use App\Http\Requests\RuanganStoreRequest;
use App\Http\Requests\RuanganUpdateRequest;
use App\Helpers\ResponseFormatter;
use App\Models\Prodi;

class RuanganController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title      = 'Data Master Ruangan';
        $breadcrumb = 'Ruangan';
        $url        = "/ruangan";
        $prodis     = Prodi::all();

        return view('Ruangan.index',compact('title','breadcrumb','url','prodis'));
    }


    
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Json
     */
    public function store(RuanganStoreRequest $request)
    {
        try{
            $validated = $request->validated();
            Ruangan::insert($validated);
            //$datas = $this->ruangan->store($datas);
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
     * @return \Illuminate\Http\Json
     */
    public function update(RuanganUpdateRequest $request, $id)
    {       
        try{
            $ids        = \Crypt::decrypt($id);
            $validated  = $request->validated();
            Ruangan::where('kode_ruang',$ids)->update($validated);
           // $this->ruangan->update($datas,$id);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Json
     */
    public function destroy($id)
    {
        try{
            $ids  = \Crypt::decrypt($id);
            Ruangan::where('kode_ruang',$ids)->delete();
            return ResponseFormatter::success(
                'store data successfully',
                200
            );
        } catch (\Throwable $e) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ],'store data failed', 500);
        }     
    }
}
