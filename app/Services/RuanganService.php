<?php

namespace App\Services;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use InvalidArgumentException;
use DB;

class RuanganService {

    public function __construct(){
        $this->ruangan        = new \App\Repositories\RuanganRepository;

    }


    public function getAll(){
        try{
            $datas     = $this->ruangan->all();
            return $datas;
        }catch(\Exception $e){
            throw new InvalidArgumentException('Maaf terjadi kesalahan pada sistem');
        }
        
    }

    public function getWithProdi(){
        try{
            $datas     = $this->ruangan->withProdi();
            return $datas;
        }catch(\Exception $e){
            throw new InvalidArgumentException('Maaf terjadi kesalahan pada sistem');
        }
        
    }

    public function getBy(array $id){
        try{
            $datas     = $this->ruangan->findBy($id);
            return $datas;
        }catch(\Exception $e){
            throw new InvalidArgumentException('Maaf terjadi kesalahan pada sistem');
        }
        
    }

    public function getWithDosen(){
        try{
            $datas     = $this->ruangan->withDosen();
            return $datas;
        }catch(\Exception $e){
            throw new InvalidArgumentException('Maaf terjadi kesalahan pada sistem');
        }
        
    }

    public function getWithBeacon(){
        try{
            $datas     = $this->ruangan->withBeacon();
            return $datas;
        }catch(\Exception $e){
            throw new InvalidArgumentException('Maaf terjadi kesalahan pada sistem');
        }
        
    }


    public function store($request){
        $validator = \Validator::make($request,[
            'kode_ruang'                => 'required|unique:ruangan,kode_ruang|max:10',
            'nama_ruang'                => 'required|max:25',
            'kapasitas_ruang_kuliah'    => 'required|numeric',
            'kapasitas_ruang_ujian'     => 'required|numeric',
            'kode_prodi'                => 'required|max:10',
            'nama_gedung'               => 'required|max:25'
        ]);

        if ($validator->fails())
        {
           throw new InvalidArgumentException($validator->errors());
        }
       
        DB::beginTransaction();  
        try{
            $this->ruangan->store([
                'kode_ruang'                => $request['kode_ruang'],
                'nama_ruang'                => $request['nama_ruang'],
                'kapasitas_ruang_kuliah'    => $request['kapasitas_ruang_kuliah'],
                'kapasitas_ruang_ujian'     => $request['kapasitas_ruang_ujian'],
                'kode_prodi'                => $request['kode_prodi'],
                'nama_gedung'               => $request['nama_gedung']
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
            'kode_ruang'                => 'required|max:10|unique:ruangan,kode_ruang,'.$id.',kode_ruang',
            'nama_ruang'                => 'required|max:25',
            'kapasitas_ruang_kuliah'    => 'required|numeric',
            'kapasitas_ruang_ujian'     => 'required|numeric',
            'kode_prodi'                => 'required|max:10',
            'nama_gedung'               => 'required|max:25'
        ]);

        if ($validator->fails())
        {
           throw new InvalidArgumentException($validator->errors());
        }

        DB::beginTransaction();  
        try{
            $this->ruangan->update(['kode_ruang'=>$id],[
                'kode_ruang'                => $request['kode_ruang'],
                'nama_ruang'                => $request['nama_ruang'],
                'kapasitas_ruang_kuliah'    => $request['kapasitas_ruang_kuliah'],
                'kapasitas_ruang_ujian'     => $request['kapasitas_ruang_ujian'],
                'kode_prodi'                => $request['kode_prodi'],
                'nama_gedung'               => $request['nama_gedung']
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
            $this->ruangan->delete(['kode_ruang'=>$id]);  
        }catch(\Exception $e){
            throw new InvalidArgumentException('Maaf terjadi kesalahan pada sistem');
        }
        
    }


    
}