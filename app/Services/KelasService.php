<?php

namespace App\Services;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use InvalidArgumentException;
use DB;

class KelasService {

    public function __construct(){
        $this->kelas        = new \App\Repositories\KelasRepository;
       
    }


    public function getAll(){
        try{
            $datas     = $this->kelas->all();
            return $datas;
        }catch(\Exception $e){
            throw new InvalidArgumentException('Maaf terjadi kesalahan pada sistem');
        }
        
    }


  
    public function store($request){
        $validator = \Validator::make($request,[
            'nama_kelas'         => 'required|unique:kelas,nama_kelas|max:10',
        ]);

        if ($validator->fails())
        {
           throw new InvalidArgumentException($validator->errors());
        }
       
        DB::beginTransaction();  
        try{
            $this->kelas->store([
                'nama_kelas'                => $request['nama_kelas']
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
            'nama_kelas'         => 'required|max:10|unique:kelas,id,'.$id,
        ]);

        if ($validator->fails())
        {
           throw new InvalidArgumentException($validator->errors());
        }

        DB::beginTransaction();  
        try{
            $this->kelas->update(['id'=>$id],[
                'nama_kelas'                => $request['nama_kelas']
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
            $this->kelas->delete(['id'=>$id]);  
        }catch(\Exception $e){
            throw new InvalidArgumentException('Maaf terjadi kesalahan pada sistem');
        }
        
    }

    
}