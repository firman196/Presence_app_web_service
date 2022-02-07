<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\Api\LoginRequest;
use App\Models\Mahasiswa;
use App\Http\Resources\Mobile\MahasiswaResource;

class AuthController extends Controller
{
    public function login(LoginRequest $request){
        try {
            $user = Mahasiswa::with(['prodi','dosens','kelas'])->where('nim',$request['nim'])->first();
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
               //generate sanctum token
                $tokenResult = $user->createToken('authToken')->plainTextToken;
                return ResponseFormatter::success([
                    'access_token' => $tokenResult,
                    'token_type' => 'Bearer',
                    'user' => new MahasiswaResource($user)
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


    public function logout(Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete();

        return ResponseFormatter::success($token,'Token Revoked',200);
    }

    


    
}
