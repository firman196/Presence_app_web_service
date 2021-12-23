<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\Api\LoginRequest;
use App\Models\Mahasiswa;


class AuthController extends Controller
{
    public function login(LoginRequest $request){
        try {
            
            //get data user by username
            $user = Mahasiswa::where('nim',$request['nim'])->first();
            //jika login gagal
            if (!isset($user)) {
                return ResponseFormatter::error([
                    'message' => 'Something went wrong',
                    'error'   => 'Unauthorized'
                ],'Authentication Failed', 401);
            }
            
            $login = [
                'nim'=> $request['nim'],
                'password'=> $request['password']
            ];
          
            if (auth()->attempt($login)) {
                //jika login sukses
                $tokenResult = $user->createToken('authToken')->plainTextToken;
                return ResponseFormatter::success([
                    'access_token' => $tokenResult,
                    'token_type' => 'Bearer',
                    'user' => $user
                ],'Authenticated');
             
            }

         
            //jika login gagal
            return ResponseFormatter::error([ 
                'message' => 'Unauthorized'
            ],'Authentication Failed', 401);
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error,
            ],'Authentication Failed', 500);
        }
    }

    


    
}
