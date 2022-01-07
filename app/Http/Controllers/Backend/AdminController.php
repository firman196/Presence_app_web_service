<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdminStoreRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Helpers\ResponseFormatter;
use DB;
use File;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.index',[
            'title'         => 'Daftar Admin',
            'breadcrumb'    => 'admin',
            'url'           => '/admin',
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
    public function store(AdminStoreRequest $request)
    {
        try{
            $validated = $request->validated();
            $destinationPath = public_path('/uploads/');
            $defaultFile     = 'default.png';

            if(isset($validated['foto'])) {
                $file = $validated['foto'];
                if(!empty($validated->oldfoto)) {
                    $pathFile = $destinationPath.$validated['oldfoto'];
                    if(File::exists($pathFile)){
                        File::delete($pathFile);
                    }
                }

                $setFile = str_replace(' ', '', strtolower($validated['nama']));
                $filename = date("dmY").'_'.$setFile.'.'.$file->getClientOriginalExtension();
                if(!File::exists($destinationPath.$filename)){
                    $file->move($destinationPath, $filename);
                }
            }else{
                if($defaultFile != $validated['oldfoto']) {
                    $filename = $validated['oldfoto'];
                } else {
                    $filename = $defaultFile;
                }
            }
            Admin::insert([
                'nik'       => $validated['nik'],
                'nip'       => $validated['nip'],
                'nama'      => $validated['nama'],
                'email'     => $validated['email'],
                'foto'      => $filename,
                'password'  => Hash::make($validated['password']),
                'status'    => $validated['status']
            ]);
                    
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
    public function update(AdminUpdateRequest $request, $id)
    {
        DB::beginTransaction();      
        try{          
            $ids                = \Crypt::decrypt($id);
            $validated          = $request->validated();
            $destinationPath    = public_path('/uploads/');
            $defaultFile        = 'default.png';

            
            if(isset($validated['foto'])) {
                $file = $validated['foto'];
                if(isset($validated['oldfoto'])) {
                    $pathFile = $destinationPath.$validated['oldfoto'];
                    if(File::exists($pathFile)){
                        File::delete($pathFile);
                    }
                }

                $setFile = str_replace(' ', '', strtolower($validated['nama']));
                $filename = date("dmY").'_'.$setFile.'.'.$file->getClientOriginalExtension();
                if(!File::exists($destinationPath.$filename)){
                    $file->move($destinationPath, $filename);
                }
            }else{
                if($defaultFile != $validated['oldfoto']) {
                    $filename = $validated['oldfoto'];
                } else {
                    $filename = $defaultFile;
                }
            }
            Admin::where('nik',$ids)->update([
                'nik'                       => $validated['nik'],
                'nip'                       => $validated['nip'],
                'nama'                      => $validated['nama'],
                'foto'                      => $filename,
                'email'                     => $validated['email'],
                'status'                    => $validated['status']
            ]);
            DB::commit();
            return ResponseFormatter::success(
                'store data successfully',
                200
            );
        }catch(\Exception $e){
            DB::rollback();
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
            $ids  = \Crypt::decrypt($id);
            $data = Admin::where('nik',$ids)->first();
            if($data) {
                if($data->foto != 'default.png') {
                    $pathFile = public_path('/uploads/').$data->foto;
                    if(File::exists($pathFile)){
                        File::delete($pathFile);
                    }
                }
                $data->delete();
               // $data->delete(['nik'=>$id]);
            }
         
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
