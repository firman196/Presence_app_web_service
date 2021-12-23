<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\KelasStoreRequest;
use App\Http\Requests\KelasUpdateRequest;

class KelasController extends Controller
{
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title      = 'Data Master Kelas';
        $breadcrumb = 'Kelas';
        $url        = "/kelas";
             
        return view('Kelas.index',compact('title','breadcrumb','url'));
    }


    

  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Json
     */
    public function store(KelasStoreRequest $request)
    {
        try{
            $validated = $request->validated();
            Kelas::insert($validated);
                    
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
    public function update(KelasUpdateRequest $request, $id)
    {       
        try{
            $validated = $request->validated();
            Kelas::where('id',$id)->update($validated);
          
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
           Kelas::where('id',$id)->delete();
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
