<?php

namespace App\Services;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use InvalidArgumentException;
use DB;

class JenisIzinService {

    public function __construct(){
        $this->jenisIzin        = new \App\Repositories\JenisIzinRepository;
       
    }


    public function getAll(){
        try{
            $datas     = $this->jenisIzin->all();
            return $datas;
        }catch(\Exception $e){
            throw new InvalidArgumentException('Maaf terjadi kesalahan pada sistem');
        }
        
    }


  
    public function store($request){
        $validator = \Validator::make($request,[
            'kode'                    => 'required|unique:jenis_izins,kode|max:10',
            'keterangan'              => 'required|string|max:100'
        ]);

        if ($validator->fails())
        {
           throw new InvalidArgumentException($validator->errors());
        }
       
        DB::beginTransaction();  
        try{
            $this->jenisIzin->store($request);
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            throw new InvalidArgumentException('Maaf terjadi kegagaalan saat menyimpan data');
        }
    }


    public function update($request, $id)
    {
        $validator = \Validator::make($request,[
            'kode'                    => 'required|max:10|unique:jenis_izins,kode,'.$id.',kode',
            'keterangan'              => 'required|string|max:100'
        ]);

        if ($validator->fails())
        {
           throw new InvalidArgumentException($validator->errors());
        }

        DB::beginTransaction();  
        try{
            $this->jenisIzin->update(['kode'=>$id],$request);
            DB::commit();

        }catch(\Exception $e){
            DB::rollback();
            throw new InvalidArgumentException(500);
        }
    }


    public function delete($id)
    {
        try{
            $this->jenisIzin->delete(['kode'=>$id]);  
        }catch(\Exception $e){
            throw new InvalidArgumentException('Maaf terjadi kesalahan pada sistem');
        }
        
    }

    
}