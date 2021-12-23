<?php

namespace App\Services;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use InvalidArgumentException;
use DB;
use File;

class DosenService {

    public function __construct(){
        $this->dosen        = new \App\Repositories\DosenRepository;
    }


    public function getAll(){
        try{
            $datas     = $this->dosen->all();
            return $datas;
        }catch(\Exception $e){
            throw new InvalidArgumentException('Maaf terjadi kesalahan pada sistem');
        }
    }

    public function store($request){
       
       
        DB::beginTransaction();  
        try{
            $destinationPath = public_path('/uploads/');
            $defaultFile     = 'default.png';

            $file = $request['foto'];
           
            if(isset($file)) {
                if(!empty($request->oldfoto)) {
                    $pathFile = $destinationPath.$request['oldfoto'];
                    if(File::exists($pathFile)){
                        File::delete($pathFile);
                    }
                }

                $setFile = str_replace(' ', '', strtolower($request['nama']));
                $filename = date("dmY").'_'.$setFile.'.'.$file->getClientOriginalExtension();
                if(!File::exists($destinationPath.$filename)){
                    $file->move($destinationPath, $filename);
                }
            }else{
                if($defaultFile != $request['oldfoto']) {
                    $filename = $request['oldfoto'];
                } else {
                    $filename = $defaultFile;
                }
            }
            $this->dosen->store([
                'nik'                       => $request['nik'],
                'nip'                       => $request['nip'],
                'nama'                      => $request['nama'],
                'kode_prodi'                => $request['kode_prodi'],
                'jenjang_pendidikan'        => $request['jenjang_pendidikan'],
                'gelar_depan'               => $request['gelar_depan'],
                'gelar_belakang'            => $request['gelar_belakang'],
                'foto'                      => $filename,
                'alamat'                    => $request['alamat'],
                'agama'                     => $request['agama'],
                'kode_pos'                  => $request['kode_pos'],
                'kode_pos'                  => $request['kode_pos'],
                'telp'                      => $request['telp'],
                'email'                     => $request['email'],
                'password'                  => Hash::make($request['password']),
                'status'                    => $request['status']
            ]);
            DB::commit();
      }catch(\Exception $e){
            DB::rollback();
            $error = ['server'=>['Maaf terjadi kegagalan saat menyimpan data']];
            throw new InvalidArgumentException(json_encode($error));
        }
    }


    public function update($request, $id)
    {
       
        $validator = \Validator::make($request,[
            'nik'                => 'required|numeric|min:16|max:16',
            'nik'                => 'required|min:3|max:25',
            'nama'               => 'required|max:50',
            'kode_prodi'         => 'required',
            'jenjang_pendidikan' => 'required|max:50',
            'gelar_depan'        => 'required|max:20',
            'gelar_belakang'     => 'required|max:20',
            'foto'               => 'nullable|image|mimes:jpg,png,jpeg,svg',
            'alamat'             => 'required',
            'agama'              => 'required',
            'kode_pos'           => 'required|max:10',
            'telp'               => 'required|max:15',          
            'email'              => 'required|email|unique:dosen,email,'.$id.',nik',
            'password'           => 'required|min:6', 
            'status'             => 'required'  
        ]);

        if ($validator->fails())
        {
           throw new InvalidArgumentException($validator->errors());
        }

        DB::beginTransaction();  
        try{
            $destinationPath = public_path('/uploads/');
            $defaultFile     = 'default.png';

            
            if(isset($request['foto'])) {
                $file = $request['foto'];
                if(isset($request['oldfoto'])) {
                    $pathFile = $destinationPath.$request['oldfoto'];
                    if(File::exists($pathFile)){
                        File::delete($pathFile);
                    }
                }

                $setFile = str_replace(' ', '', strtolower($request['nama']));
                $filename = date("dmY").'_'.$setFile.'.'.$file->getClientOriginalExtension();
                if(!File::exists($destinationPath.$filename)){
                    $file->move($destinationPath, $filename);
                }
            }else{
                if($defaultFile != $request['oldfoto']) {
                    $filename = $request['oldfoto'];
                } else {
                    $filename = $defaultFile;
                }
            }
            $this->dosen->update(['nik'=>$id],[
                'nik'                       => $request['nik'],
                'nip'                       => $request['nip'],
                'nama'                      => $request['nama'],
                'kode_prodi'                => $request['kode_prodi'],
                'jenjang_pendidikan'        => $request['jenjang_pendidikan'],
                'gelar_depan'               => $request['gelar_depan'],
                'gelar_belakang'            => $request['gelar_belakang'],
                'foto'                      => $filename,
                'alamat'                    => $request['alamat'],
                'agama'                     => $request['agama'],
                'kode_pos'                  => $request['kode_pos'],
                'kode_pos'                  => $request['kode_pos'],
                'telp'                      => $request['telp'],
                'email'                     => $request['email'],
                'password'                  => Hash::make($request['password']),
                'status'                    => $request['status']
            ]);
            DB::commit();

        }catch(\Exception $e){
            DB::rollback();
            throw new InvalidArgumentException(500);
        }
    }


    public function delete($id)
    {
        $query = $this->dosen->findBy(['nik' => $id]);
    	if($query) {
			if($query->foto != 'default.png') {
				$pathFile = public_path('/uploads/').$query->foto;
				if(File::exists($pathFile)){
					File::delete($pathFile);
				}
			}
			$this->dosen->delete(['nik'=>$id]);
    	}
            
    }


    
}