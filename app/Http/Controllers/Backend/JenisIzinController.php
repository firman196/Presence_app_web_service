<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\JenisIzinStoreRequest;
use App\Http\Requests\JenisIzinUpdateRequest;
use App\Models\JenisIzin;
use App\Helpers\ResponseFormatter;

class JenisIzinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title      = 'Data Master Jenis Izin';
        $breadcrumb = 'jenis izin';
        $url        = "/jenis-izin";
             
        return view('JenisIzin.index',compact('title','breadcrumb','url'));
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
    public function store(JenisIzinStoreRequest $request)
    {
        try{
            $validated  = $request->validated();
            $datas      = JenisIzin::insert($validated);
                    
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
    public function update(JenisIzinUpdateRequest $request, $id)
    {
        try{
          
            $ids         = \Crypt::decrypt($id);
            $validated   = $request->validated();
            JenisIzin::where('kode',$ids)->update($validated);
            
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
        //mulai transaksi
        try{
            $ids = \Crypt::decrypt($id);
            JenisIzin::where('kode',$ids)->delete();
        
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
