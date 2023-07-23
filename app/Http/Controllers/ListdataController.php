<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\KpMap;
use App\Models\PbMap;
use App\Models\PoiMap;
use App\Models\SpdMap;
use App\Models\Podes18Map;
use App\Models\Podes20Map;
use App\Models\User;
use App\Models\Layermap;
use App\Models\CentrePoint;
use GuzzleHttp\Client;

class ListdataController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('IsAdmin')->only(
            'showkp',
            'showpb',
            'showspd',
            'editkp',
            'editpb',
            'editspd',
            'updatekp',
            'updatepb',
            'updatespd',
            'createpb',
            'storepb',
            'destroykp',
            'destroypb',
            'destroyspd'
        );
    }


    public function PBtokenTB()
    {
        $client = new Client();
        $request = $client->request('POST', 'https://emp-pitalebar.kominfo.go.id/api/ListFBBConnected/login', [
        'form_params' => [
            'identity' =>  'sidilan-fbb@kominfo.go.id',
            'password' => 'K0ntr4k2022',
        ]
    ]);
    $statusCode = $request->getStatusCode();
    $body = $request->getBody()->getContents();
    $data = json_decode($body, true);
    $result = $data['data']['token'];
        return $result;
    }
}
