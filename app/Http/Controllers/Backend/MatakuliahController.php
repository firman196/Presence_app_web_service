<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\MatakuliahStoreRequest;
use App\Http\Requests\MatakuliahUpdateRequest;
use App\Models\Prodi;
use App\Models\Matakuliah;

class MatakuliahController extends Controller
{

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title      = 'Data Master Matakuliah';
        $breadcrumb = 'Matakuliah';
        $url        = "/matakuliah";
        $prodis     = Prodi::all();

        return view('Matakuliah.index',compact('title','breadcrumb','url','prodis'));
    }


  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MatakuliahStoreRequest $request)
    {
        try{
            $validated  = $request->validated();
            $datas      = Matakuliah::insert($validated);
                    
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
    public function update(MatakuliahUpdateRequest $request, $id)
    {      
        try{
            $ids       = \Crypt::decrypt($id);
            $validated = $request->validated();
            Matakuliah::where('kode_matakuliah',$ids)->update($validated);
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $ids = \Crypt::decrypt($id);
            Matakuliah::where('kode_matakuliah',$ids)->delete();
                  
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
