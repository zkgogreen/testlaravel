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
    
    $content1 = DB::table('content')
        ->select('layer', 'kolom', 'type')
        ->where('section', '=', 'Home Counter 1')
        ->first();

    $content2 = DB::table('content')
        ->select('layer', 'kolom', 'type')
        ->where('section', '=', 'Home Counter 2')
        ->first();

    $content3 = DB::table('content')
        ->select('layer', 'kolom', 'type')
        ->where('section', '=', 'Home Counter 3')
        ->first();

    $content_count1 = $this->getContentCount($content1);
    $content_count2 = $this->getContentCount($content2);
    $content_count3 = $this->getContentCount($content3);

    return view('pages.frontend.home', [
        'content' => $content,
        'content_count1' => $content_count1,
        'content_count2' => $content_count2,
        'content_count3' => $content_count3,
    ]);
}


public function index2()
{
    $content = DB::table('content')->get();
    
    $content1 = DB::table('content')
        ->select('layer', 'kolom', 'type')
        ->where('section', '=', 'Home Counter 1')
        ->first();

    $content2 = DB::table('content')
        ->select('layer', 'kolom', 'type')
        ->where('section', '=', 'Home Counter 2')
        ->first();

    $content3 = DB::table('content')
        ->select('layer', 'kolom', 'type')
        ->where('section', '=', 'Home Counter 3')
        ->first();

    $content_count1 = $this->getContentCount($content1);
    $content_count2 = $this->getContentCount($content2);
    $content_count3 = $this->getContentCount($content3);

    return view('pages.frontend.home', [
        'content' => $content,
        'content_count1' => $content_count1,
        'content_count2' => $content_count2,
        'content_count3' => $content_count3,
    ]);
}

private function getContentCount($contentData)
{
    if ($contentData->type == 'distinct') {
        return DB::table($contentData->layer)->distinct()->count($contentData->kolom);
    } else {
        return DB::table($contentData->layer)->count($contentData->kolom);
    }
}


    public function about()
    {

    $content = DB::table('content')->get();

    $content1 = DB::table('content')
        ->select('layer', 'kolom', 'type')
        ->where('section', '=', 'About Counter 1')
        ->first();

    $content2 = DB::table('content')
        ->select('layer', 'kolom', 'type')
        ->where('section', '=', 'About Counter 2')
        ->first();

    $content3 = DB::table('content')
        ->select('layer', 'kolom', 'type')
        ->where('section', '=', 'About Counter 3')
        ->first();

    $content4 = DB::table('content')
        ->select('layer', 'kolom', 'type')
        ->where('section', '=', 'About Counter 4')
        ->first();

    $content_count1 = $this->getContentCount($content1);
    $content_count2 = $this->getContentCount($content2);
    $content_count3 = $this->getContentCount($content3);
    $content_count4 = $this->getContentCount($content4);

        return view('pages.frontend.about', [
            'content' => $content,
            'content_count1' => $content_count1,
            'content_count2' => $content_count2,
            'content_count3' => $content_count3,
            'content_count4' => $content_count4,
        ]);
    }

    public function about2()
    {
        return view('layouts.app2');
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
        $kabkotData = DB::table('kabkot')
        ->join("$layer", 'kabkot.kabkot', '=', "$layer.kabkot")
        ->select('kabkot.id','kabkot.kabkot', 'kabkot.provinsi', DB::raw("ST_AsGeoJSON(ST_Transform((kabkot.geom),4326),6) AS geom"), DB::raw("count($layer.kabkot) as count"))
        ->groupBy('kabkot.id')
        ->orderBy('kabkot.kabkot')
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
