<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Content;

class ContentController extends Controller
{
    public function index(){
        $content = DB::table('content')
        ->whereIn('section', ['Home Slide 1', 'Home Slide 2', 'Home Slide 3', 'Home Slide 4', 'About Title', 'About Desc'])
        ->get();

        $counter = DB::table('content')
        ->whereIn('section', ['Home Counter 1', 'Home Counter 2', 'Home Counter 3', 'About Counter 1', 
        'About Counter 2', 'About Counter 3', 'About Counter 4', 'Dashboard Counter 1', 'Dasbhoard Counter 2',
         'Dashboard Counter 3', 'Dashboard Counter 4'])
        ->get();

        $table_layer = DB::table('user_tables')
->where('status', '=' , 'Active')
->get();

        return view('pages.backend.content',[
            'content' => $content,
            'counter' => $counter,
            'table_layer' => $table_layer,
        ]);
    }

    public function ShowTabelContent()
    {  
       $data = DB::table('content')
       ->orderBy('id', 'asc')
       ->get();

       $hasil = [
           'data' => $data,
    ];
    return $hasil;
           //  return json_encode($hasil, JSON_INVALID_UTF8_IGNORE);
        }



              //Mengambil Field dari tabel
    public function NamaField($tabel)
    {
        $data1 = DB::table('information_schema.columns')
            ->select('column_name')
            // ->where('table_name', $tabel)
            ->where([
                ['table_name', '=', $tabel],
                ['column_name', '!=', 'id'],
                ['column_name', '!=', 'geom'],
                ['column_name', '!=', 'created_at'],
                ['column_name', '!=', 'deleted_at'],
                ['column_name', '!=', 'updated_at'],
                ])
            ->orderBy('ordinal_position', 'asc')
            ->get();

        // $nmField = [];
        // foreach ($data1 as $record) {
        //     array_push($nmField, $record->column_name);
        // }
        // dd($nmField);
        return $data1;
    }

}
