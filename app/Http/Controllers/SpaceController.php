<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CentrePoint;
use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Menampilkan data dari tabel space
        return view('pages.space.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Memanggil model CentrePoint untuk mendapatkan data yang akan dikirimkan ke form create
        // space
        $centrepoint = CentrePoint::get()->first();
        return view('pages.space.create', [
            'centrepoint' => $centrepoint,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Lakukan validasi data
        // $this->validate($request, [
        //     'name' => 'required',
        //     'content' => 'required',
        //     // 'image' => 'image|mimes:png,jpg,jpeg',
        //     'location' => 'required'
        // ]);

        // melakukan pengecekan ketika ada file gambar yang akan di input
        $spaces = new Space;
        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $imageName = time() . '_' . $file->getClientOriginalName();
        //     $file->move('uploads/imgCover/', $imageName);
        // }

        // Memasukkan nilai untuk masing-masing field pada tabel space berdasarkan inputan dari
        // form create 
        // $spaces->image = $imageName;
        $spaces->id_desa = $request->input('id_desa');
        $spaces->desa = $request->input('desa');
        $spaces->kecamatan = $request->input('kecamatan');
        $spaces->kab_kota = $request->input('kab_kota');
        $spaces->provinsi = $request->input('provinsi');
        $spaces->location = $request->input('location');
        $spaces->nama = $request->input('nama');
        $spaces->telepon = $request->input('telepon');
        $spaces->email = $request->input('email');
        $spaces->jenis_usaha = $request->input('jenis_usaha');
        $spaces->produk = $request->input('produk');
        $spaces->nama_pic = $request->input('nama_pic');
        $spaces->kontak_pic = $request->input('kontak_pic');
        $spaces->pengusul = $request->input('pengusul');
        $spaces->keterangan = $request->input('keterangan');
        $spaces->thn_bantuan = $request->input('thn_bantuan');

        //return dd($spaces);

        // proses simpan data
        $spaces->save();

        // redirect ke halaman index space
        if ($spaces) {
            return redirect()->route('space.index')->with('success', 'Data berhasil disimpan');
        } else {
            return redirect()->route('spaceI.index')->with('error', 'Data gagal disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Space $space)
    {
        // mencari data space yang dipilih berdasarkan id
        // kemudian menampilkan data tersebut ke form edit space
        $space = Space::findOrFail($space->id);
        return view('pages.space.edit', [
            'space' => $space
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Space $space)
    {
        // Menjalankan validasi
        $this->validate($request, [
            'name' => 'required',
            'content' => 'required',
            // 'image' => 'image|mimes:png,jpg,jpeg',
            'location' => 'required'
        ]);

        // Jika data yang akan diganti ada pada tabel space
        // cek terlebih dahulu apakah akan mengganti gambar atau tidak
        // jika gambar diganti hapus terlebuh dahulu gambar lama
        $space = Space::findOrFail($space->id);
        // if ($request->hasFile('image')) {
        //     if (File::exists("uploads/imgCover/" . $space->image)) {
        //         File::delete("uploads/imgCover/" . $space->image);
        //     }
        //     $file = $request->file("image");
        //     $space->image = time() . '_' . $file->getClientOriginalName();
        //     $file->move('uploads/imgCover/', $space->image);
        //     $request['image'] = $space->image;
        // }

        // Lakukan Proses update data ke tabel space
        $space->update([
            'name' => $request->name,
            'location' => $request->location,
            'content' => $request->content,
            'slug' => Str::slug($request->name, '-'),
        ]);
       
        // redirect ke halaman index space
        if ($space) {
            return redirect()->route('space.index')->with('success', 'Data berhasil diupdate');
        } else {
            return redirect()->route('space.index')->with('error', 'Data gagal diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // hapus keseluruhan data pada tabel space begitu juga dengan gambar yang disimpan
        $space = Space::findOrFail($id);
        // if (File::exists("uploads/imgCover/" . $space->image)) {
        //     File::delete("uploads/imgCover/" . $space->image);
        // }
        $space->delete();
        return redirect()->route('space.index');
    }
}