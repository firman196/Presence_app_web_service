<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\BeaconsController;
use App\Http\Controllers\API\V1\JadwalController;
use App\Http\Controllers\API\V1\HariController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login', [AuthController::class, 'login']);
Route::group(['middleware' => 'auth:sanctum'], function(){
   Route::get('jadwal',[JadwalController::class, 'getJadwalByHari']);
   Route::get('jadwal/sekarang',[JadwalController::class, 'getJadwalSekarang']);
   Route::get('jadwal/history',[JadwalController::class, 'getHistoryJadwal']);
   Route::get('jadwal/{jadwal}',[JadwalController::class, 'getJadwalById']);
   

   //hari
   Route::get('hari',[HariController::class,'getHari']);

   //beacons
   Route::get('beacons/{id}',[BeaconsController::class,'getBeaconsByKodeRuang']);
});
