<?php

namespace App\Services;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use InvalidArgumentException;
use DB;

class HariService {

    public function __construct(){
        $this->hari        = new \App\Repositories\HariRepository;
       
    }


    public function getAll(){
        try{
            $datas     = $this->hari->all();
            return $datas;
        }catch(\Exception $e){
            throw new InvalidArgumentException('Maaf terjadi kesalahan pada sistem');
        }
        
    }


  
    public function store($request){
        $validator = \Validator::make($request,[
            'nama_hari'         => 'required|string|unique:haris,nama_hari|max:10',
        ]);

        if ($validator->fails())
        {
           throw new InvalidArgumentException($validator->errors());
        }
       
        DB::beginTransaction();  
        try{
            $this->hari->store($request);
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
            'nama_hari'         => 'required|max:10|unique:haris,id,'.$id,
        ]);

        if ($validator->fails())
        {
           throw new InvalidArgumentException($validator->errors());
        }

        DB::beginTransaction();  
        try{
            $this->hari->update(['id'=>$id],$request);
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
            $this->hari->delete(['id'=>$id]);  
        }catch(\Exception $e){
            throw new InvalidArgumentException('Maaf terjadi kesalahan pada sistem');
        }
        
    }

    
}