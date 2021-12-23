<?php

namespace App\Services;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use InvalidArgumentException;
use DB;

class JadwalService {

    public function __construct(){
        $this->jadwal    = new \App\Repositories\JadwalRepository;
       
    }


    public function getAll(){
        $datas = $this->jadwal->all();
        return $datas;
    }


    public function getWithAll(){
        
    }

 

    public function store($request){
        $validator = \Validator::make($request,[
            'kode_matakuliah'           => 'required|max:15',
            'nik'                       => 'required|max:25',
            'jam_mulai'                 => 'required',
            'jam_selesai'               => 'required',
            'kelas_id'                  => 'required',
            'kode_ruang'                => 'required',
            'hari'                      => 'required|max:25'
        ]);

       
        if ($validator->fails())
        {
           throw new InvalidArgumentException($validator->errors());
        }

        DB::beginTransaction();  
        try{

            $this->jadwal->store([
                'kode_matakuliah'           => $request['kode_matakuliah'],
                'nik'                       => $request['nik'],
                'jam_mulai'                 => $request['jam_mulai'],
                'jam_selesai'               => $request['jam_selesai'],
                'kelas_id'                  => $request['kelas_id'],
                'kode_ruang'                => $request['kode_ruang'],
                'hari'                      => $request['hari']
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
            'kode_matakuliah'           => 'required|max:15',
            'nik'                       => 'required|max:25',
            'jam_mulai'                 => 'required',
            'jam_selesai'               => 'required',
            'kelas_id'                  => 'required',
            'kode_ruang'                => 'required',
            'hari'                      => 'required|max:25'
        ]);

        if ($validator->fails())
        {
           throw new InvalidArgumentException($validator->errors());
        }

        DB::beginTransaction();  
        try{
            $this->jadwal->update(['id'=>$id],[
                'kode_matakuliah'           => $request['kode_matakuliah'],
                'nik'                       => $request['nik'],
                'jam_mulai'                 => $request['jam_mulai'],
                'jam_selesai'               => $request['jam_selesai'],
                'kelas_id'                  => $request['kelas_id'],
                'kode_ruang'                => $request['kode_ruang'],
                'hari'                      => $request['hari']
            ]);
            DB::commit();

        }catch(\Exception $e){
            DB::rollback();
            
            throw new InvalidArgumentException(500);
        }
    }


    public function delete($id)
    {
        $this->jadwal->delete(['id'=>$id]);
    }




    
}