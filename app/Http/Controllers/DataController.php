<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CentrePoint;
use App\Models\Space;
use GuzzleHttp\Client;
use App\Models\TbKp;
use App\Models\TbPb;
use App\Models\PoiMap;
use App\Models\TbSpd;
use App\Models\Podes18Map;
use App\Models\Podes20Map;
use App\Models\Layermap;
use App\Models\User;
use App\Models\UserTable;
use App\Models\SelectList;
use DB;
use Auth;
use Storage;
use File;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Response;
use Session;
Use Exception;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;

class DataController extends Controller
{
    public function getMarkerData($layer)
{
    $columnMarker = DB::table('information_schema.columns')
        ->select('column_name')
        ->where([
            ['table_name', '=', $layer],
            ['column_name', '!=', 'id'],
            ['column_name', '!=', 'geom'],
            ['column_name', '!=', 'created_at'],
            ['column_name', '!=', 'deleted_at'],
            ['column_name', '!=', 'updated_at'],
        ])
        ->orderBy('ordinal_position', 'asc')
        ->get();

    $markerData = DB::table($layer)->get();

    $nmField = [];
    foreach ($columnMarker as $record) {
        array_push($nmField, $record->column_name);
    }

    // Bentuk struktur GeoJSON
    $geojson = [
        'type' => 'FeatureCollection',
        'features' => [],
    ];

    // Iterasi setiap data kabkot dan buat fitur GeoJSON untuk setiap kabkot
    foreach ($markerData as $marker) {
        $properties = [];
        foreach ($nmField as $columnName) {
            $properties[$columnName] = $marker->$columnName;
        }

        $feature = [
            'type' => 'Feature',
            'geometry' => [
                'type' => 'Point',
                'coordinates' => [
                    $marker->longitude,
                    $marker->latitude
                ]
            ],
            'properties' => $properties,
        ];

        // Tambahkan fitur ke dalam struktur GeoJSON
        $geojson['features'][] = $feature;
    }

    // Kembalikan data dalam format JSON
    return response()->json($geojson);
}


    public function getGeoJSONData($layer)
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
                    'kabkot' => $kabkot->kabkot,
                    'provinsi' => $kabkot->provinsi,
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


                 public function ShowTabelUser()
                 {  
                    $data = User::select(
                        'id',
                        'email',
                        'name',
                        'roles',
                        'created_at',
                        'updated_at'
                        )
                    ->orderBy('id', 'desc')
                    ->get();
                    $hasil = [
                        'data' => $data,
                 ];
                 return $hasil;
                        //  return json_encode($hasil, JSON_INVALID_UTF8_IGNORE);
                     }


                public function addData(Request $request)
            {
                $tabel = $request->get('tabel');
                $newData = $request->get('newData');
                $hasil = DB::table($tabel)
                    ->create($newData);
                return $hasil;
            }


             public function updateTabel(Request $request)
             {
                 $id = $request->get('id');
                 $tabel = $request->get('tabel');
                 $newData = $request->get('newData');
                 $hasil = DB::table($tabel)
                     ->where('id', $id)
                     ->update($newData);
                    //  ->update([
                    //     $newData,
                    //     'updated_at' => date('YmdHis'),
                    //     ]);
                 return $hasil;
             }
        
             public function deleteData(Request $request)
             {
                 $id = $request->get('id');
                 $tabel = $request->get('tabel');
                 $tt = DB::table($tabel)
                     ->where('id', '=', $id)
                     ->delete();
             }

             public function deleteDataDataset(Request $request)
             {
                 $id = $request->get('id');
                 $tabel = $request->get('tabel');
                 $tt = DB::table($tabel)
                     ->where('id', '=', $id)
                     ->delete();
                $title = $request->get('title');
                $tl = DB::table('select_list')
                ->where('table' ,'=', $title)
                ->delete();
                $delete_tc = Schema::dropIfExists($title);
             }

             

             public function DensityGeojson()
             {
          
                $data = DB::table('tb_kabkot')
                // ->join('modules', 'subscribes.modules_id', '=', 'modules.id')
                ->join('tc_pendampingan2', 'tb_kabkot.kabkot', '=', 'tc_pendampingan2.kabkot')
                // ->join('modules', 'modules.id', '=', 'module_freemiums.freemiums_id')
                ->select('tb_kabkot.id','tb_kabkot.kabkot', 'tb_kabkot.provinsi', DB::raw("count(tc_pendampingan2.kabkot) as count"))
                // ->where([
                // ['tc_adminowners_id', '=', Auth::user()->owners_id],
                // ['status', '=', 'Paid'],
                // ['title', '=', 'Module'],
                // ])
                ->groupBy('tb_kabkot.id')
                ->orderBy('tb_kabkot.wadmkk')
                // ->distinct('module_freemiums.freemiums_id')
                ->get();
                 // dd($data);

                //  $data = DB::select(DB::raw("SELECT k.id, k.id_kab, k.wadmkk, k.wadmpr, k.geom, count(a.id_kab) from tb_kabkot k left join tc_administrasi a on k.id_kab = a.id_kab group by k.id order by k.id_kab;"));  
                // $data = DB::raw("(ST_AsGeoJSON(geometry)) AS geometry tb_kabkot");
                 return $data;
                //  return Response::json($data);

                }

                public function provinsi(){
                    $provinsi = DB::table('tb_desa')
                    ->distinct()
                    ->whereNotNull('provinsi')
                    ->get(['provinsi']);
                    return response()->json($provinsi);
                }
                
                public function kabkot($id){
                    $kabkot = DB::table('tb_desa')
                    ->where('provinsi',$id)
                    ->distinct()->get(['kabkot']);
                    return response()->json($kabkot);
                }
            
                public function kecamatan($id){
                    $kecamatan = DB::table('tb_desa')
                    ->where('kabkot',$id)
                    ->distinct()->get(['kecamatan']);
                    return response()->json($kecamatan);
                }
            
                public function keldes($id){
                    $keldes = DB::table('tb_desa')
                    ->where('kecamatan',$id)
                    ->distinct()->get(['keldes']);
                    return response()->json($keldes);
                }



                public function userupdate(Request $request, $id)
                {
            
                    $data = $request->all();
                    if (!$data['password']) {
                        $validator = $this->validate($request, [
                            'name' => ['required', 'string', 'max:255'],
                            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                            ]);
                    $items = User::FindOrFail($id);
                         $items->update([
                        'name' => $data['name'],
                        // 'email' => $data['email'],
                    ]);
                    return redirect()
                    ->route('dashboard')
                    ->with([
                        'success' => 'BERHASIL! Profil anda berhasil di update !',
                    ]);
                    } else {
                        $validator = $this->validate($request, [
                        'name' => ['required', 'string', 'max:255'],
                        // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                        // 'password' => ['required', 'string', 'min:8', 'confirmed'],
                        'current_password' => ['required', 'string', 'min:8'],
                        'password' => ['required', 'string', 'min:8', 'confirmed'],
                        ]);
            
                        $hashedPassword = Auth::user()->password;
                        if (\Hash::check($request->current_password , $hashedPassword)) {
            
                    $items = User::FindOrFail($id);
                    $items->update([
                        'name' => $data['name'],
                        // 'email' => $data['email'],
                        'password' => Hash::make($data['password']),
                    ]);
                    return redirect()
                    ->route('dashboard')
                    ->with([
                        'success' => 'BERHASIL! Profil anda berhasil di update !',
                    ]);
                    // }
                    //  else{
                    //     session()->flash('error','Password baru tidak boleh sama dengan password lama !');
                    //     return redirect()->back();
                    // } 
                } else {
                    session()->flash('error','Password lama tidak sesuai !');
                    return redirect()->back();
                }
                } 
                //  else {
                //         return redirect()
                //             ->route('dashboard')
                //             ->with([
                //                 'error' => 'GAGAL! Periksa kembali data anda !',
                //             ]);
                //     }
                }
             
}