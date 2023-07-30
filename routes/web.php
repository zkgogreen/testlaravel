<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListdataController;
use App\Http\Controllers\BasisdataController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\KonfigurasiController;
use App\Http\Controllers\CentreController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\DatasetController;
use App\Http\Controllers\ContentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('pages.frontend.home');
// });
Route::get('/', [HomeController::class, 'index2']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/about2', [HomeController::class, 'about2'])->name('about2');
Route::get('/maps', [HomeController::class, 'maps'])->name('maps');
Route::get('/content', [ContentController::class, 'content'])->name('content');
Route::get('/getGeoJSONData2/{layer}',[HomeController::class,'getGeoJSONData2']);

// Auth::routes();

// Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Route::get('Filterdropdown', Filterdropdown::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name(
        'dashboard'
    );
    Route::get('dropdownlist',[DashboardController::class, 'getProv']);
    Route::get('dropdownlist/getkabkot/{id}',[DashboardController::class, 'getKabkot']);
    Route::get('dropdownlist/getkecamatan/{id}',[DashboardController::class, 'getKecamatan']);
    Route::get('dropdownlist/getkelurahan/{id}',[DashboardController::class, 'getKelurahan']);
    // Route::get('/dashboard', [DashboardController::class, 'PbChart'])->name('PbChart');
    Route::get('basisdata', [BasisdataController::class, 'index'])->name(
        'basisdata'
    );
    Route::get('user-management', [PenggunaController::class, 'index'])->name(
        'user-management'
    );
    Route::post('/add-user', [PenggunaController::class, 'create'])->name('add-user');
    Route::get('pengguna/{id}', [PenggunaController::class, 'edit'])->name(
        'edit-pengguna'
    );
    Route::put('pengguna/{id}', [PenggunaController::class, 'update'])->name(
        'update-pengguna'
    );
    Route::delete('/add-pengguna/{id}', [
        PenggunaController::class,
        'destroy',
    ])->name('destroy-pengguna');
    Route::get('konfigurasi', [KonfigurasiController::class, 'index'])->name(
        'konfigurasi'
    );
    Route::get('konfigurasi/layer/{id}', [
        KonfigurasiController::class,
        'editLayer',
    ])->name('editLayer');
    Route::put('konfigurasi/layer/{id}', [
        KonfigurasiController::class,
        'updateLayer',
    ])->name('updateLayer');
    Route::get('konfigurasi/base/{id}', [
        KonfigurasiController::class,
        'editBase',
    ])->name('editBase');
    Route::put('konfigurasi/base/{id}', [
        KonfigurasiController::class,
        'updateBase',
    ])->name('updateBase');

    Route::get('privacy',[AdminController::class,'privacy'])->name('privacy');
    Route::get('toc',[AdminController::class,'toc'])->name('toc');
    Route::get('content',[ContentController::class,'index'])->name('content');
    Route::get('/ShowTabelContent',[ContentController::class,'ShowTabelContent']);
    Route::get('ContentField/{tabel}',[ContentController::class, 'NamaField']);
    Route::post('AddData',[DataController::class,'AddData']);
    // Route::get('NamaFieldTabel',[DataController::class, 'NamaFieldType']);

    Route::get('ShowTabel/{nmtabel}',[DatasetController::class,'ShowTabel']);
    Route::get('NamaField/{tabel}',[DatasetController::class, 'NamaField']);
    Route::get('NamaFieldTabel/{tabel}',[DatasetController::class, 'NamaFieldType']);
    Route::get('NamaFieldImport/{tabel}',[DatasetController::class, 'NamaFieldImport']);
    Route::get('NamaFieldTabelImport/{tabel}',[DatasetController::class, 'NamaFieldTypeImport']);
    Route::get('TabelField/{tabel}',[DatasetController::class, 'TabelField']);
    Route::post('addNewRow',[DatasetController::class,'addNewRow'])->name('addNewRow');

    Route::get('/getProvinsi', [DataController::class, 'provinsi'])->name('provinsi');
    Route::get('/getKabkot/{id}', [DataController::class, 'kabkot'])->name('kabkot');
    Route::get('/getKecamatan/{id}', [DataController::class, 'kecamatan'])->name('kecamatan');
    Route::get('/getKeldes/{id}', [DataController::class, 'keldes'])->name('keldes');

    Route::get('TabelSpasial/{tabel}',[DatasetController::class, 'TabelSpasial']);
    Route::get('valueKolomList/{tabel}',[DatasetController::class, 'valueKolomList']);
    Route::get('valueList/{tabel}/{kolom}',[DatasetController::class, 'valueList']);
    Route::post('ImportData',[DatasetController::class,'ImportData'])->name('ImportData');
    Route::get('/DensityMap',[DataController::class,'DensityGeojson']);
    // Route::get('/getGeoJSONData',[DataController::class,'getGeoJSONData']);
    Route::get('/getGeoJSONData/{layer}',[DataController::class,'getGeoJSONData']);
    Route::get('/getMarkerData/{layer}',[DataController::class,'getMarkerData']);
    Route::post('updateTabel',[DataController::class,'updateTabel']);
    Route::get('/ShowTabelUser',[DataController::class,'ShowTabelUser']);
    Route::post('deleteData',[DataController::class,'deleteData']);
    Route::post('deleteDataKP',[DataController::class,'deleteDataKP']);
    Route::post('deleteDataSPD',[DataController::class,'deleteDataSPD']);
    Route::get('/ShowTabelDataset',[DatasetController::class,'ShowTabelDataset']);
    Route::post('deleteDataDataset',[DataController::class,'deleteDataDataset']);
    Route::get('dataset', [DatasetController::class, 'index'])->name('dataset');
    Route::post('createTB', [DatasetController::class, 'createTB'])->name('createTB');
    Route::put('user-update/{id}', [DataController::class, 'userupdate'])->name('user-update');

    // Route::get('/listdata/pbtable2', [
    //     DashboardController::class,
    //     'PBgetTable',
    // ])->name('PBgetTable');

    Route::get('/PBgetMap', [
        DashboardController::class,
        'PBgetMap',
    ])->name('PBgetMap');

    Route::get('/PBgetData', [
        DashboardController::class,
        'PBgetData',
    ])->name('PBgetData');
});

// Auth::routes();
Auth::routes(['verify' => true]);
