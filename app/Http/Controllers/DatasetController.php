<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use DB;
use Storage;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\Controller;
use Session;
use App\Models\InformationSchemaColumn;
use App\Models\UserTable;
use App\Models\ColorPalette;
use App\Models\ColorList;
use App\Models\SelectList;
// use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Maatwebsite\Excel\Facades\Excel;

class DatasetController extends Controller
{
    public function index(){

$color_palette = ColorPalette::with(['color'])
->whereIn('title', ['Green', 'Gray', 'Blue', 'Red', 'Orange' ,'Area Red', 'Area Green', 'Area Brown'])
->orderBy('id', 'asc')
->get();  

$data = DB::table('user_tables')
->join('information_schema.tables', 'user_tables.title', '=', 'information_schema.tables.table_name')
->get();
$spatial_layer = DB::table('user_tables')
->where('status', '=' , 'Active')
->get();
        // return $data;
        return view('pages.backend.dataset', [
            'data' => $data,
            'spatial_layer' => $spatial_layer,
            'color_palette' => $color_palette,
        ]);
    }

    public function TabelField($tabel){

        $layer_field = InformationSchemaColumn::select('column_name', 'table_name', 'is_nullable', 'data_type', 'c.form_type')
    ->leftJoin('select_list as c', function ($join) {
        $join->on('information_schema.columns.table_name', '=', 'c.table')
            ->on('information_schema.columns.column_name', '=', 'c.column');
    })
    ->where('information_schema.columns.table_name', $tabel)
    ->get();

    return $layer_field;
    }


    public function valueKolomList($tabel){
        $list_kolom = DB::table('select_list')
        ->select('column')
        ->where([
            ['table', '=', $tabel],
            ['form_type', '=', 'select']
            ])
        ->get();
            return $list_kolom;
        }

    public function valueList($tabel, $kolom){
    $list_select = DB::table('select_list')
    ->select('value_list')
    ->where([
    ['table', '=', $tabel],
    ['column', '=', $kolom],
    ])
    ->get();
        return $list_select;
    }


    public function TabelSpasial($tabel){
    $showmap= DB::table('user_tables')
    ->where([
    ['status', '=' , 'Active'],
    ['title', '=', $tabel],
    ['type', '=', 'Spatial'],
    ])
    ->get();
    return $showmap;
    }

    // public function addNewRow(Request $request)
    // {

     
    //     $kolom_file = DB::table('select_list')
    //     ->select('column')
    //     ->where([
    //     ['table', '=', $request->tabel],
    //     ['form_type', '=', 'file'],
    //     ])
    //     ->get();

        
    //     foreach ( $kolom_file as $file ) {
    //         $lampiran = $file->column;
    //     }

    //     $data = $request->except(['tabel', '_token']);
    //     unset($data["__KEY__"]);
    //     $tabel = $request->tabel;
    //     // $hasil = DB::table($tabel)->insert($data);
    //     if($request->file($lampiran) == "") {  
    //         $hasil = DB::table($tabel)->insert($data);
    //       }else{
    //         $file = $request->file($lampiran);
    //       $nama_file = time()."_".$file->getClientOriginalName();
    //       $tujuan_upload = storage_path('app/file/');
    //     //   $tujuan_upload = 'images/file';
    //       $file->move($tujuan_upload,$nama_file);
    //       $hasil = DB::table($tabel)->insert(
    //         $lampiran => $nama_file,
    //         $data);
    //       }

    //     // return $hasil;

    //     if ($hasil) {
    //         return back()->withSuccess('New row added successfully.');
    //     } else {
    //         return back()->withErrors('Failed to add new row !');
    //     }
         
    // }



    public function addNewRow(Request $request)
{
    $kolom_file = DB::table('select_list')
        ->select('column')
        ->where([
            ['table', '=', $request->tabel],
            ['form_type', '=', 'file'],
        ])
        ->get();

    foreach ($kolom_file as $file) {
        $lampiran = $file->column;
    }

    $data = $request->except(['tabel', '_token']);
    unset($data["__KEY__"]);
    $tabel = $request->tabel;
    
    if ($request->file($lampiran) == "") {
        $hasil = DB::table($tabel)->insert($data);
    } else {
        $file = $request->file($lampiran);
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $tujuan_upload = storage_path('app/public/lampiran/');
        $file->move($tujuan_upload, $nama_file);
        $data[$lampiran] = $nama_file; // Corrected the data array for file insertion.
        $hasil = DB::table($tabel)->insert($data);
    }

    if ($hasil) {
        return back()->withSuccess('New row added successfully.');
    } else {
        return back()->withErrors('Failed to add a new row!');
    }
}


    


     public function createTB(Request $request) {

        //  $request->validate([
        //     'addMoreInputFields.*.subject' => 'required'
        // ]);

        $data = $request->all();
         $column = $request->addMoreInputFields;
         $table_name = 'tc_' . $request->name_table;

           $createTB = Schema::connection('pgsql2')->create($table_name, function (Blueprint $table)  use ($column){
            $table->id();
            foreach ($column as $key => $value) {
                if($value['type'] == 'string'){
                    if($value['more'] == 'nullable') {
                        $table->string($value['kolom'])->nullable();
                    } else if ($value['more'] == 'unique'){
                         $table->string($value['kolom'])->unique();
                    } else if ($value['more'] == 'mandatory'){
                         $table->string($value['kolom']); 
                    } else {}
                } else if ($value['type'] == 'integer') {
                    if($value['more'] == 'nullable') {
                        $table->integer($value['kolom'])->nullable();
                    } else if ($value['more'] == 'unique'){
                         $table->integer($value['kolom'])->unique();
                     } else if ($value['more'] == 'mandatory'){
                         $table->integer($value['kolom']); 
                    } else {}
                } else if ($value['type'] == 'text') {
                    if($value['more'] == 'nullable') {
                        $table->text($value['kolom'])->nullable();
                    } else if ($value['more'] == 'unique'){
                         $table->text($value['kolom'])->unique();
                    } else if ($value['more'] == 'mandatory'){
                         $table->text($value['kolom']); 
                    } else {}
                } else if ($value['type'] == 'date') {
                    if($value['more'] == 'nullable') {
                        $table->date($value['kolom'])->nullable();
                    } else if ($value['more'] == 'unique'){
                         $table->date($value['kolom'])->unique();
                    } else if ($value['more'] == 'mandatory'){
                         $table->date($value['kolom']); 
                    } else {}
                }  else if ($value['type'] == 'dateTime') {
                    if($value['more'] == 'nullable') {
                        $table->dateTime($value['kolom'])->nullable();
                    } else if ($value['more'] == 'unique'){
                         $table->dateTime($value['kolom'])->unique();
                    } else if ($value['more'] == 'mandatory'){
                         $table->dateTime($value['kolom']); 
                    } else {}
                } else if ($value['type'] == 'decimal') {
                    if($value['more'] == 'nullable') {
                        $table->decimal($value['kolom'])->nullable();
                    } else if ($value['more'] == 'unique'){
                         $table->decimal($value['kolom'])->unique();
                    } else if ($value['more'] == 'mandatory'){
                         $table->decimal($value['kolom']); 
                    } else {}
                }  else if ($value['type'] == 'time') {
                    if($value['more'] == 'nullable') {
                        $table->time($value['kolom'])->nullable();
                    } else if ($value['more'] == 'unique'){
                         $table->time($value['kolom'])->unique();
                    } else if ($value['more'] == 'mandatory'){
                         $table->time($value['kolom']); 
                    } else {}
                }  else if ($value['type'] == 'timestamp') {
                    if($value['more'] == 'nullable') {
                        $table->timestamp($value['kolom'])->nullable();
                    } else if ($value['more'] == 'unique'){
                         $table->timestamp($value['kolom'])->unique();
                    } else if ($value['more'] == 'mandatory'){
                         $table->timestamp($value['kolom']); 
                    } else {}
                }  else if ($value['type'] == 'enum') {
                    if($value['more'] == 'nullable') {
                        $table->enum($value['kolom'], [$value['value']])->nullable();
                    } else if ($value['more'] == 'unique'){
                         $table->enum($value['kolom'],[$value['value']])->unique();
                    } else if ($value['more'] == 'mandatory'){
                         $table->enum($value['kolom'], [$value['value']]); 
                    } else {}
                } else {
                }
            }
            $table->timestamps();
        });

        // $table->enum('status', ['Pending', 'Wait', 'Active']);


 
        foreach ($column as $key => $value) {
if($value['kolom'] == 'provinsi' || $value['kolom'] == 'kabkot' || $value['kolom'] == 'kecamatan' || $value['kolom'] == 'keldes'){
} else{
                $data       = new SelectList;
                $data->table  = $table_name;
                $data->column  = $value['kolom'];
                $data->form_type  = $value['typeform'];
                $data->value_list  = $value['valuelist']; 
                $data->save();
            } 
        }

        $data       = new UserTable;
        $data->title  = $table_name;
        $data->name  = $request->name_table;
        $data->status  = $request->status_table;
        // $data->color_palette = $request->color_palette;
        // $data->owners_id   = Auth::user()->owners_id;
        $data->type = $request->type_table;
        $data->roles = $request->roles_table;
        // 
        $data->save();
        

    if ($data) {
            return redirect()
                ->route('dataset')
                ->with([
                    'success' => 'Create table success.',
                ]);
        } else {
            return redirect()
                ->route('dataset')
                ->with([
                    'error' => 'Periksa kembali data anda !',
                ]);
        }

    }


    public function ShowTabelDataset()
         {  
            $data = UserTable::all();
            $hasil = [
                'data' => $data,
         ];
         return $hasil;
                //  return json_encode($hasil, JSON_INVALID_UTF8_SUBSTITUTE);
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

        $nmField = [];
        foreach ($data1 as $record) {
            array_push($nmField, $record->column_name);
        }
        // dd($nmField);
        return $nmField;
    }

    // Mengambil type Field
    public function NamaFieldType($tabel)
    {
        $data = [];

        $data1 = DB::table('information_schema.columns')
            ->select('column_name', 'data_type')
            ->where('table_name', $tabel)
            ->get();

        // dd($data1);

        $columnTabel = [];
        foreach ($data1 as $record) {
            $column_name = $record->column_name;
            if ($column_name != 'geom') {
                $data_type = $record->data_type;
                switch ($data_type) {
                    case 'integer':
                    case 'bigint':
                    case 'smallint':
                        $fieldTabel = [
                            'dataField' => "$column_name",
                            'dataType' => 'number',
                            'format' => ['precision' => 0],
                        ];
                        break;
                    case 'double precision':
                    case 'real':
                    case 'numeric':
                        $fieldTabel = [
                            'dataField' => "$column_name",
                            'dataType' => 'number',
                            'format' => ['precision' => 3],
                        ];
                        break;
                    case 'character':
                    case 'character varying':
                        $fieldTabel = [
                            'dataField' => "$column_name",
                            'dataType' => 'string',
                        ];
                        break;
                    case 'timestamp without time zone':
                    case 'date':
                        $data_type = 'date';
                        $fieldTabel = [
                            'dataField' => "$column_name",
                            'dataType' => 'date',
                            'format' => 'yyyy/MM/dd HH:mm:ss',
                        ];
                        break;
                    default:
                        $data_type = $data_type;
                        $fieldTabel = [
                            'dataField' => "$column_name",
                            'dataType' => "$data_type",
                        ];
                        break;
                }
                if ($column_name === 'gid') {
                    $fieldTabel = [
                        'dataField' => "$column_name",
                        'dataType' => 'number',
                        'allowEditing' => 0,
                    ];
                }
                if ($column_name === 'TypeData') {
                    $fieldTabel = [
                        'dataField' => "$column_name",
                        'dataType' => "$data_type",
                        'allowEditing' => 0,
                    ];
                }
                if (
                    $column_name === 'x_awal' ||
                    $column_name === 'y_awal' ||
                    $column_name === 'x_akhir' ||
                    $column_name === 'y_akhir'
                ) {
                    $fieldTabel = [
                        'dataField' => "$column_name",
                        'dataType' => 'number',
                        'format' => ['precision' => 8],
                        'validationRules' => [['type' => 'required']],
                    ];
                }

                array_push($columnTabel, $fieldTabel);
            }
        }
        // dd($columnTabel);
        return $columnTabel;
    }

             //Mengambil data tabel
             public function ShowTabel($nmTabel)
             {
                 $nmField = $this->NamaFieldType($nmTabel);
                 $nmF = $this->NamaField($nmTabel);
                 // $nmF = array_diff($nmF, ['geom']);
                 $data = DB::table($nmTabel)
                 ->select($nmF)
                 ->orderBy('id', 'desc')
                 ->get();
         
                 $hasil = ['nmfield' => $nmField, 'data' => $data];
                 //dd($hasil);
                 return $hasil;
             }


function ImportData(Request $request)
{
    $tabel = $request->table;

    // Assuming you have a function to get field types for the given table
    $nmField = $this->NamaFieldType($tabel);

    // Assuming you have a function to get field names for the given table
    $nmF = $this->NamaField($tabel);

    $this->validate($request, [
        'file' => 'required|file|mimes:xls,xlsx'
    ]);

    $the_file = $request->file('file');
    try {
        $spreadsheet = IOFactory::load($the_file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();

        // Get the last row and column index in the sheet
        $row_limit = $sheet->getHighestDataRow();
        $column_limit = $sheet->getHighestDataColumn();
        
        // Convert the column index (e.g., 'AM') to numeric value (e.g., 41)
        $column_limit_index = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($column_limit);

        $data = array();
        for ($row = 3; $row <= $row_limit; $row++) { // Start from row 3

            // Initialize an empty row data array for each iteration
            $row_data = array();
            for ($col = 1; $col <= $column_limit_index; $col++) {
                $colname = $nmF[$col - 1]; // Adjusting the index to match the $nmF array
                $cell_value = $sheet->getCellByColumnAndRow($col, $row)->getValue();
                
                // Check if the field type is "date" and convert the value if needed
                if ($nmField[$col - 1] == 'date') {
                    $cell_value = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($cell_value)->format('Y-m-d');
                }

                $row_data[$colname] = $cell_value;
            }

            // Add the row data to the $data array
            $data[] = $row_data;
        }

        // Insert data into the database
        DB::table($tabel)->insert($data);

    } catch (\Illuminate\Database\QueryException $e) {
        $errorCode = $e->errorInfo[1];
        return back()->with('error', $e->getMessage());
    }

    return back()->withSuccess('Great! Data has been successfully uploaded.');
}

}
