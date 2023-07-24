<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Content;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $content = DB::table('content')->get();
        return view('pages.frontend.home',[
            'content' => $content,
        ]);
    }

    public function about()
    {
        $content = DB::table('content')->get();
        return view('pages.frontend.about',[
            'content' => $content,
        ]);
    }

    public function maps()
    {
        $density_layer = DB::table('user_tables')
        ->where([
            ['status', '=' , 'Active'],
            ['roles', '=', 'Public'],
            ])
        ->get();



        return view('pages.frontend.maps',[
            'density_layer' => $density_layer,
        ]);
    }



    public function getGeoJSONData2($layer)
    {
        $kabkotData = DB::table('tb_kabkot')
        ->join("$layer", 'tb_kabkot.wadmkk', '=', "$layer.kabkot")
        ->select('tb_kabkot.id','tb_kabkot.wadmkk', 'tb_kabkot.wadmpr', DB::raw("ST_AsGeoJSON(ST_Transform((tb_kabkot.geom),4326),6) AS geom"), DB::raw("count($layer.kabkot) as count"))
        ->groupBy('tb_kabkot.id')
        ->orderBy('tb_kabkot.wadmkk')
        ->get();
        // Bentuk struktur GeoJSON
        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        // Iterasi setiap data kabkot dan buat fitur GeoJSON untuk setiap kabkot
        foreach ($kabkotData as $kabkot) {
            $feature = [
                'type' => 'Feature',
                'properties' => [
                    'kabkot' => $kabkot->wadmkk,
                    'provinsi' => $kabkot->wadmpr,
                    // Masukkan informasi atribut jumlah penerima bantuan dari relasi
                    'jumlah' => $kabkot->count,
                ],
                'geometry' => json_decode($kabkot->geom, true),
                // 'geometry' => $kabkot->geom,// Isi dengan data spasial wilayah kabupaten/kota dari tabel kabkot
            ];

            // Tambahkan fitur ke dalam struktur GeoJSON
            $geojson['features'][] = $feature;
        }

        // Kembalikan data dalam format JSON
        return response()->json($geojson);
    }
}
