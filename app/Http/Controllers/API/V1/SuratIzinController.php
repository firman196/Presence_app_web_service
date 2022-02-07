<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\PostSuratIzinRequest;
use App\Models\SuratIzin;

class SuratIzinController extends Controller
{
    
    public function postSuratIzin(PostSuratIzinRequest $request){
        try{
            $validated          = $request->validated();
            $nim                = auth()->user()->nim;
            $validated['nim']   = $nim;
            SuratIzin::insert($validated);

            return ResponseFormatter::success(
                'Izin berhasil di upload',
                200
            );
        }catch(Illuminate\Database\QueryException $ex){
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ],'updated izin failed', 500);
        }
    }

}
