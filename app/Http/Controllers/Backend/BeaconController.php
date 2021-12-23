<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Beacon;
use App\Models\Ruangan;

use App\Http\Requests\BeaconStoreRequest;
use App\Http\Requests\BeaconUpdateRequest;

use App\Helpers\ResponseFormatter;

class BeaconController extends Controller
{
    
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title          = 'Pengaturan Beacon';
        $breadcrumb     = 'Beacon';
        $url            = "/beacon";
        $ruangs         = Ruangan::all();

        return view('Beacon.index',compact('title','breadcrumb','url','ruangs'));
    }


  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BeaconStoreRequest $request)
    {
        try{
            $validated = $request->validated();
            $datas = Beacon::insert($validated);

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

        $title          = 'Daftar Beacon';
        $breadcrumb     = 'Beacon';
        $url            = "/beacon";
        $ruang          = Ruangan::where('kode_ruang',\Crypt::decrypt($id))->first();

        return view('Beacon.show',compact('title','breadcrumb','url','ruang'));
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
    public function update(BeaconUpdateRequest $request, $id)
    {       
        try{
            $ids = \Crypt::decrypt($id);
            $validated = $request->validated();
            Beacon::where('kode_beacon',$ids)->update($validated);
           
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
            $ids = \Crypt::decrypt($id);
            Beacon::where('kode_beacon',$ids)->delete();
          
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
