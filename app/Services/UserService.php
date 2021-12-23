<?php

namespace App\Services;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use DB;

class UserService {

    public function __construct(){
        $this->user        = new \App\Repositories\UserRepository;
       
    }


    public function getAll(){
        try{
            $datas     = $this->user->all();
            return $datas;
        }catch(\Exception $e){
            throw new InvalidArgumentException('Maaf terjadi kesalahan pada sistem');
        }
        

    }

    
}