<?php

namespace App\Services;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use InvalidArgumentException;
use DB;

class MatakuliahService {

    public function __construct(){
        $this->matakuliah        = new \App\Repositories\MatakuliahRepository;

    }


    public function getAll(){
        try{
            $datas     = $this->matakuliah->all();
            return $datas;
        }catch(\Exception $e){
            throw new InvalidArgumentException('Maaf terjadi kesalahan pada sistem');
        }
        
    }

    public function getWithProdi(){
        try{
            $datas     = $this->matakuliah->withProdi();
            return $datas;
        }catch(\Exception $e){
            throw new InvalidArgumentException('Maaf terjadi kesalahan pada sistem');
        }
        
    }



    public function getWithDosen(){
        try{
            $datas     = $this->matakuliah->withDosen();
            return $datas;
        }catch(\Exception $e){
            throw new InvalidArgumentException('Maaf terjadi kesalahan pada sistem');
        }
        
    }


    public function store($request){
        $validator = \Validator::make($request,[
            'kode_matakuliah'                => 'required|unique:matakuliah,kode_matakuliah|max:15',
            'nama_matakuliah'                => 'required|max:25',
            'sifat_matakuliah'               => 'required',
            'jenis_matakuliah'               => 'required',
            'sks'                            => 'required|numeric',
            'kode_prodi'                     => 'required|max:10',
            'semester'                       => 'required|numeric'
        ]);

        if ($validator->fails())
        {
           throw new InvalidArgumentException($validator->errors());
        }
       
        DB::beginTransaction();  
        try{
            $this->matakuliah->store([
                'kode_matakuliah'           => $request['kode_matakuliah'],
                'nama_matakuliah'           => $request['nama_matakuliah'],
                'sifat_matakuliah'          => $request['sifat_matakuliah'],
                'jenis_matakuliah'          => $request['jenis_matakuliah'],
                'sks'                       => $request['sks'],
                'kode_prodi'                => $request['kode_prodi'],
                'semester'                  => $request['semester']
            ]);
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            throw new InvalidArgumentException('Maaf terjadi kegagaalan saat menyimpan data');
        }
    }


    public function update($request, $id)
    {
        $validator = \Validator::make($request,[
            'kode_matakuliah'                => 'required|max:15|unique:matakuliah,kode_matakuliah,'.$id.',kode_matakuliah',
            'nama_matakuliah'                => 'required|max:25',
            'sifat_matakuliah'               => 'required',
            'jenis_matakuliah'               => 'required',
            'sks'                            => 'required|numeric',
            'kode_prodi'                     => 'required|max:10',
            'semester'                       => 'required|numeric'
        ]);

        if ($validator->fails())
        {
           throw new InvalidArgumentException($validator->errors());
        }

        DB::beginTransaction();  
        try{
            $this->matakuliah->update(['kode_matakuliah'=>$id],[
                'kode_matakuliah'           => $request['kode_matakuliah'],
                'nama_matakuliah'           => $request['nama_matakuliah'],
                'sifat_matakuliah'          => $request['sifat_matakuliah'],
                'jenis_matakuliah'          => $request['jenis_matakuliah'],
                'sks'                       => $request['sks'],
                'kode_prodi'                => $request['kode_prodi'],
                'semester'                  => $request['semester']
            ]);
            DB::commit();

        }catch(\Exception $e){
            DB::rollback();
            throw new InvalidArgumentException(500);
        }
    }


    public function delete($id)
    {
        try{
            $this->matakuliah->delete(['kode_matakuliah'=>$id]);  
        }catch(\Exception $e){
            throw new InvalidArgumentException('Maaf terjadi kesalahan pada sistem');
        }
        
    }


    
}