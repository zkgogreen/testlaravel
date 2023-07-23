<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use DB;
use App\Models\TbKp;
use App\Models\TbPb;
use App\Models\PoiMap;
use App\Models\TbSpd;
use App\Models\User;
use App\Models\Layermap;
use App\Models\Basemap;
use App\Models\UserTable;
use GuzzleHttp\Client;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

        $kp_total = TbKp::select('id')->count();
        $pb_total = TbPb::select('id')->count();
        $poi_total = PoiMap::select('id')->count();
        $spd_total = TbSpd::select('id')->count();
      
        # Ambil semua isi tabel tujuan dari model
        // $provinsi = DB::table('podes20_spd_kp_dukcapil')
        //     ->select('r101n', 'r102n', 'r103n', 'r104n')
        //     ->get();
        # Inisialisasi variabel daftar dengan array
        $daftar = ['' => ''];
        # lakukan perulangan untuk provinsi
        // foreach ($provinsi as $temp) {
        //     # Isi daftar dengan nama (provinsi) berdasarkan id
        //     $daftar[$temp->r101n] = $temp->r101n;
        // }
        $density_layer = DB::table('user_tables')
        ->where('status', '=' , 'Active')
        ->get();

        $spatial_layer = UserTable::with(['table'])
        ->where('status', '=' , 'Active')
        ->where('type', '=', 'Spatial')
        ->get();
        return view(
            'pages.backend.dashboard',
            [
                // 'provs' => $provs,
                'kp_total' => $kp_total,
                'pb_total' => $pb_total,
                'poi_total' => $poi_total,
                'spd_total' => $spd_total,
                'density_layer' => $density_layer,
                'spatial_layer' => $spatial_layer,
            ],
            compact('daftar')
        );
    }
    
    public function getProv()
    {
        $filprov = DB::table('podes20_spd_kp_dukcapil')
        ->select('r101n')
        ->distinct()
        ->orderBy('r101n')
        ->get();
        return view('pages.dashboard', [
            'filprov' => $filprov,
        ]);
    }

    public function getKabkot($id) 
    {
        $filkabkot = DB::table("podes20_spd_kp_dukcapil")
        ->distinct()
        ->where("r101n",$id)
        ->pluck("r102n","r102n");
        return json_encode($filkabkot);
    }

    public function getKecamatan($id) 
    {
        $filkec = DB::table("podes20_spd_kp_dukcapil")
        ->distinct()
        ->where("r102n",$id)
        ->pluck("r103n","r103n");
        // ->get();
        return json_encode($filkec);
    }

    public function getKelurahan($id) 
    {
        $filkel = DB::table("podes20_spd_kp_dukcapil")
        ->distinct()
        ->where("r103n",$id)
        ->pluck("r104n","r104n");
        // ->get();
        return json_encode($filkel);
    }



    public function PBtoken()
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



public function PBgetMap()
{
    $client = new Client();
    $xtoken = $this->PBtoken();
    $request = $client->request('POST', 'https://emp-pitalebar.kominfo.go.id/api/ListFBBConnected/list', [
        'headers' => [
            'Authorization' => $xtoken,
        ],
        'form_params' => [
        'datestart' =>  '2021-01-01',
        'dateend' => '2021-08-01',
    ]
]);
$statusCode = $request->getStatusCode();
$body = $request->getBody()->getContents();
$data = json_decode($body, true);
    // dd($data);
    $features = array();
foreach($data['detail'] as $key => $value) {
    $features[] = array(
        'type' => 'Feature',
        'geometry' => array('type' => 'Point', 'coordinates' => array($value['longitude'], $value['latitude'])),
        'properties' => array(
        'idlokasi' => $value['idlokasi'],
        'iddesa' => $value['iddesa'],
        'idkec' => $value['idkec'],
        'idkabupaten' => $value['idkabupaten'],
        'idprovinsi' => $value['idprovinsi'],
        'nama_lengkap' => $value['nama_lengkap'],
        'alamat' => $value['alamat'],
        'telp' => $value['telp'],
        'latitude' => $value['latitude'],
        'longitude' => $value['longitude'],
        'start_layanan' => $value['start_layanan'],
        'akhir_layanan' => $value['akhir_layanan'],
        'bandwith' => $value['bandwith'],
        'keterangan' => $value['keterangan'],
        'tahun' => $value['tahun']),
        );
};
$allfeatures = array('type' => 'FeatureCollection', 'features' => $features);
$final_data = json_encode($allfeatures, JSON_PRETTY_PRINT);
print_r($final_data);
}

public function PBgetData()
{
    $client = new Client();
    $xtoken = $this->PBtoken();
    $request = $client->request('POST', 'https://emp-pitalebar.kominfo.go.id/api/ListFBBConnected/list', [
        'headers' => [
            'Authorization' => $xtoken,
        ],
        'form_params' => [
        'datestart' =>  '2021-01-01',
        'dateend' => '2021-08-01',
    ]
]);
$statusCode = $request->getStatusCode();
$body = $request->getBody()->getContents();
// $response = $body->paginate(10);
$data = json_decode($body, true);
$result = $data['count'];
    return $result;
}

}
