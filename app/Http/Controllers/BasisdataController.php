<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use App\Imports\PbImport;
use App\Exports\PbExport;
use App\Imports\SpdImport;
use App\Exports\SpdExport;
use App\Imports\KpImport;
use App\Exports\KpExport;
use App\Models\Layermap;

class BasisdataController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('IsAdmin');
    }

    public function index()
    {
        return view('pages.backend.basisdata');
    }

    //  public function startRow(): int
    // {
    //     return 2;
    // }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function ImportPb(Request $request)
    {
        $import = Excel::import(
            new PbImport(),
            $request->file('file')->store('temp')
        );
        // return back();
        if ($import) {
            //redirect
            return redirect()
                ->route('basisdata')
                ->with([
                    'success' =>
                        'BERHASIL! Data telah ditambahkan ke database !',
                ]);
        } else {
            //redirect
            return redirect()
                ->route('basisdata')
                ->with([
                    'error' => 'GAGAL! Periksa kembali data anda !',
                ]);
        }
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function importSpd(Request $request)
    {
        $import = Excel::import(
            new SpdImport(),
            $request->file('file')->store('temp')
        );
        // return back();
        if ($import) {
            //redirect
            return redirect()
                ->route('basisdata')
                ->with([
                    'success' =>
                        'BERHASIL! Data telah ditambahkan ke database !',
                ]);
        } else {
            //redirect
            return redirect()
                ->route('basisdata')
                ->with([
                    'error' => 'GAGAL! Periksa kembali data anda !',
                ]);
        }
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function importKp(Request $request)
    {
        $import = Excel::import(
            new KpImport(),
            $request->file('file')->store('temp')
        );
        // return back();
        if ($import) {
            //redirect
            return redirect()
                ->route('basisdata')
                ->with([
                    'success' =>
                        'BERHASIL! Data telah ditambahkan ke database !',
                ]);
        } else {
            //redirect
            return redirect()
                ->route('basisdata')
                ->with([
                    'error' => 'GAGAL! Periksa kembali data anda !',
                ]);
        }
    }

        /**
     * @return \Illuminate\Support\Collection
     */
    public function ExportKp()
    {
        return Excel::download(new KpExport(), 'kawasan-prioritas.xlsx');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function ExportPb()
    {
        return Excel::download(new PbExport(), 'peneriman-bantuan.xlsx');
    }

        /**
     * @return \Illuminate\Support\Collection
     */
    public function ExportSpd()
    {
        return Excel::download(new SpdExport(), 'survey-potensi-desa.xlsx');
    }
}
