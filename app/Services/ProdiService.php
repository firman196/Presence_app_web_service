<?php

namespace App\Services;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use InvalidArgumentException;
use DB;

class ProdiService {

    public function __construct(){
        $this->prodi        = new \App\Repositories\ProdiRepository;

    }


    public function getAll(){
        try{
            $datas     = $this->prodi->all();
            return $datas;
        }catch(\Exception $e){
            throw new InvalidArgumentException('Maaf terjadi kesalahan pada sistem');
        }
        
    }


    public function getWithDosen(){
        try{
            $datas     = $this->prodi->withDosen();
            return $datas;
        }catch(\Exception $e){
            throw new InvalidArgumentException('Maaf terjadi kesalahan pada sistem');
        }
        
    }


    public function store($request){
        $validator = \Validator::make($request,[
            'kode_prodi'         => 'required|unique:prodi,kode_prodi|max:10',
            'nama_prodi'         => 'required|max:50',
            'jenjang'            => 'required|max:10',
            'kaprodi'            => 'nullable|string|max:25',
        ]);

        if ($validator->fails())
        {
           throw new InvalidArgumentException($validator->errors());
        }
       
        DB::beginTransaction();  
        try{
            $this->prodi->store($request);
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
            'kode_prodi'         => 'required|max:10|unique:prodi,kode_prodi,'.$id.',kode_prodi',
            'nama_prodi'         => 'required|string|max:50',
            'jenjang'            => 'required|string|max:10',
            'kaprodi'            => 'nullable|string|max:25',
        ]);

        if ($validator->fails())
        {
           throw new InvalidArgumentException($validator->errors());
        }

        DB::beginTransaction();  
        try{
            $this->prodi->update(['kode_prodi'=>$id],$request);
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $error = ['server'=>['Maaf terjadi kegagalan saat menyimpan data']];
            throw new InvalidArgumentException(json_encode($error));
        }
    }


    public function delete($id)
    {
        try{
            $this->prodi->delete(['kode_prodi'=>$id]);  
        }catch(\Exception $e){
            throw new InvalidArgumentException('Maaf terjadi kesalahan pada sistem');
        }
        
    }


    
}