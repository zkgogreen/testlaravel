<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Basemap;
use App\Models\Layermap;

class KonfigurasiController extends Controller
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
        $layers = Layermap::all();
        $basemaps = Basemap::all();
        $lmaps = Layermap::select('filename', 'layername', 'table_link')
            ->where('status', '=', 'Active')
            ->get();
        return view('pages.konfigurasi.index', [
            'layers' => $layers,
            'basemaps' => $basemaps,
            'lmaps' => $lmaps,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editLayer($id)
    {
        $layer = Layermap::Find($id);
        $lmaps = Layermap::select('filename', 'layername', 'table_link')
            ->where('status', '=', 'Active')
            ->get();
        return view('pages.konfigurasi.layerEdit', [
            'layer' => $layer,
            'lmaps' => $lmaps,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editBase($id)
    {
        $basemap = Basemap::Find($id);
        $lmaps = Layermap::select('filename', 'layername', 'table_link')
            ->where('status', '=', 'Active')
            ->get();
        return view('pages.konfigurasi.baseEdit', [
            'basemap' => $basemap,
            'lmaps' => $lmaps,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateLayer(Request $request, $id)
    {
        $data = $request->all();
        $data = Layermap::find($id);
        $data->status = $request->status;
        $data->layername = $request->layername;
        if ($request->status == 'Active') {
            $data->visibility = '';
        } else {
            $data->visibility = 'hidden';
        }
        $data->save();
        if ($data) {
            //redirect
            return redirect()
                ->route('konfigurasi')
                ->with([
                    'success' => 'BERHASIL! Data Berhasil di Update !',
                ]);

            //redirect
            return redirect()
                ->route('konfigurasi')
                ->with([
                    'error' => 'GAGAL! Periksa kembali data anda !',
                ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateBase(Request $request, $id)
    {
        $data = $request->all();
        $item = Basemap::find($id);
        $item->update($data);
        if ($item) {
            //redirect
            return redirect()
                ->route('konfigurasi')
                ->with([
                    'success' => 'BERHASIL! Data Berhasil di Update !',
                ]);
        } else {
            //redirect
            return redirect()
                ->route('konfigurasi')
                ->with([
                    'error' => 'GAGAL! Periksa kembali data anda !',
                ]);
        }
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */

    public function statusLayer(Request $request)
    {
        $layer = Layermap::find($request->id);
        $layer->status = $request->status;
        $layer->save();

        return response()->json(['success' => 'Status change successfully.']);
    }
}
