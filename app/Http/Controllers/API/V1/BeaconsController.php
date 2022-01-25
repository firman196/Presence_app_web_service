<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beacon;
use App\Http\Resources\Mobile\BeaconsResource;

class BeaconsController extends Controller
{
    public function getBeaconsByKodeRuang($id){
        $data = Beacon::where('kode_ruang',$id)->get();
       
        return BeaconsResource::collection($data)->additional(['meta' => [
            'code'      =>200,
            'status'    =>'success',
            'message'   => 'get data beacons successfully'   
        ]]);
    }
}
