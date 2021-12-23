<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DataTables;
use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\Hash;
use App\Models\Mahasiswa;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\MahasiswaStoreRequest;
use App\Http\Requests\MahasiswaUpdateRequest;
use App\Models\Prodi;
use App\Models\Kelas;
use App\Models\Dosen;
use File;

class MahasiswaController extends Controller
{

   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title      = 'Data Master Mahasiswa';
        $breadcrumb = 'Mahasiswa';
        $url        = "/mahasiswa";
        $prodis     = Prodi::all();
        $kelass     = Kelas::all();
        $dosens     = Dosen::all();

        return view('Mahasiswa.index',compact('prodis','kelass','dosens','title','breadcrumb','url'));
    }

 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MahasiswaStoreRequest $request)
    {
        try{
            $validated = $request->validated();
            $destinationPath = public_path('/uploads/');
            $defaultFile     = 'default.png';
            
            if(isset($validated['foto'])) {
                $file            = $validated['foto'];
                if(!empty($validated['oldfoto'])) {
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
            Mahasiswa::insert([
                'nim'           => $validated['nim'],
                'nama'          => $validated['nama'],
                'kode_prodi'    => $validated['kode_prodi'],
                'kelas_id'      => $validated['kelas_id'],
                'semester'      => $validated['semester'],
                'telp'          => $validated['telp'],
                'email'         => $validated['email'],
                'foto'          => $filename,
                'password'      => Hash::make($validated['password']),
                'dosen'         => $validated['dosen'],
                'status'        => $validated['status']
            ]);
    
           // $this->mahasiswa->store($validated);
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
    public function update(MahasiswaUpdateRequest $request, $id)
    {
        try{
            $validated = $request->validated();
            $ids       = \Crypt::decrypt($id);

            $destinationPath = public_path('/uploads/');
            $defaultFile     = 'default.png';
                     
            if(isset($validated['foto'])) {
                $file            = $validated['foto'];
                if(!empty($validated['oldfoto'])) {
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
            
            Mahasiswa::where('nim',$ids)->update(
                [
                    'nim'           => $validated['nim'],
                    'nama'          => $validated['nama'],
                    'kode_prodi'    => $validated['kode_prodi'],
                    'kelas_id'      => $validated['kelas_id'],
                    'semester'      => $validated['semester'],
                    'telp'          => $validated['telp'],
                    'email'         => $validated['email'],
                    'foto'          => $filename,
                  //  'password'      => Hash::make($validated['password']),
                    'dosen'         => $validated['dosen'],
                    'status'        => $validated['status']
                ]
            );
    
           // $this->mahasiswa->update($validated,$id);
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
        try{ 
            $ids = \Crypt::decrypt($id);
            $data = Mahasiswa::where('nim',$ids)->first();
            if($data) {
                if($data->foto != 'default.png') {
                    $pathFile = public_path('/uploads/').$data->foto;
                    if(File::exists($pathFile)){
                        File::delete($pathFile);
                    }
                }
                $data->delete();
            }
            
         //   $this->mahasiswa->delete($id);
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
