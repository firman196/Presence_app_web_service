<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hari;
use App\Helpers\ResponseFormatter;
use App\Http\Resources\Mobile\HariResource;

class HariController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getHari()
    {
        $hari = Hari::all();

        return HariResource::collection($hari)->additional(['meta' => [
            'code'      =>200,
            'status'    =>'success',
            'message'   => 'get data hari successfully'   
        ]]);
    }

   
}
