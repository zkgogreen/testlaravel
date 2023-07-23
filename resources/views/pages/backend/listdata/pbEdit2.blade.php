@extends('layouts.admin')

@section('content')
    <div class="card col-md-12">
        <!-- <div class="card-block" style="padding: 1%; padding-top: 1.5%;"> -->
        <div class="card-body" style="padding:2%;">
            <div class="d-flex col-md-12">
                <div class="col-md-2 text-left" style="padding-left: 4%;">
                    <a class="btn btn-sm btn-primary" href="{{ route('PbTable') }}" style="border-radius: 8px;">
                        <span class="text-white" style="font-size: 13px;">Kembali</span></a>
                </div>
                <div class="col-md-8 text-center">
                    <h4 class="mt-2">EDIT PENERIMA BANTUAN</h4>
                </div>
                <div class="col-md-2 text-center"></div>
                {{-- <a href="#"><small>Show All</small></a> --}}

            </div>
            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est quod cupiditate esse fuga</p> --}}
            <div class="table-responsive p-3">
                <form action="{{ route('PbUpdate', $item->id) }}" method="post" style="padding:5%;">
                    @method('PUT')
                    @csrf
                    <table class="table align-items-center mb-0">
                        <tr>
                            <td>
                            <th class="text-uppercase align-middle">Nama</th>
                            <td>: <input type="text" name="nama" class="form-control" placeholder="Name"
                                    value="{{ $item->nama }}"></td>
                            </td>
                            <td>
                            <th class="text-uppercase align-middle">Telepon</th>
                            <td>: <input type="text" name="telepon" class="form-control" placeholder="Telepon"
                                    value="{{ $item->telepon }}"></td>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <th class="text-uppercase align-middle">Email</th>
                            <td>: <input type="email" name="email" class="form-control" placeholder="Email"
                                    value="{{ $item->email }}"></td>
                            </td>
                            <td>
                            <th class="text-uppercase align-middle">Jenis Usaha</th>
                            <td>: <input type="text" name="jenis_usaha" class="form-control" placeholder="Jenis Usaha"
                                    value="{{ $item->jenis_usaha }}"></td>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <th class="text-uppercase align-middle">Produk</th>
                            <td>: <input type="text" name="produk" class="form-control" placeholder="Produk"
                                    value="{{ $item->produk }}"></td>
                            </td>
                            <td>
                            <th class="text-uppercase align-middle">Nama PIC</th>
                            <td>: <input type="text" name="nama_pic" class="form-control" placeholder="Nama PIC"
                                    value="{{ $item->nama_pic }}"></td>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <th class="text-uppercase align-middle">Kontak PIC</th>
                            <td>: <input type="text" name="kontak_pic" class="form-control" placeholder="Kontak PIC"
                                    value="{{ $item->kontak_pic }}"></td>
                            </td>
                            <td>
                            <th class="text-uppercase align-middle">Pengusul</th>
                            <td>: <input type="text" name="pengusul" class="form-control" placeholder="Pengusul"
                                    value="{{ $item->pengusul }}"></td>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <th class="text-uppercase align-middle">Keterangan</th>
                            <td>: <input type="text" name="keterangan" class="form-control" placeholder="Keterangan"
                                    value="{{ $item->keterangan }}"></td>
                            </td>
                            <td>
                            <th class="text-uppercase align-middle">Tahun Bantuan</th>
                            <td>: <input type="text" name="thn_bantuan" class="form-control" placeholder="Tahun Bantuan"
                                    value="{{ $item->thn_bantuan }}"></td>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="8" class="text-center">Informasi Lokasi</th>
                        </tr>
                        <tr>
                            <td>
                            <th class="text-uppercase align-middle">Desa / Kelurahan</th>
                            <td>: <input type="text" name="desa" class="form-control" placeholder="Desa / Kelurahan"
                                    value="{{ $item->desa }}"></td>
                            </td>
                            <td>
                            <th class="text-uppercase align-middle">Kecamatan</th>
                            <td>: <input type="text" name="kecamatan" class="form-control" placeholder="Kecamatan"
                                    value="{{ $item->kecamatan }}"></td>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <th class="text-uppercase align-middle">Kabupaten / Kota</th>
                            <td>: <input type="text" name="kab_kota" class="form-control" placeholder="Kabupaten / Kota"
                                    value="{{ $item->kab_kota }}"></td>
                            </td>
                            <td>
                            <th class="text-uppercase align-middle">Provinsi</th>
                            <td>: <input type="text" name="provinsi" class="form-control" placeholder="Provinsi"
                                    value="{{ $item->provinsi }}"></td>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <th class="text-uppercase align-middle">Longitude</th>
                            <td>: <input type="text" name="longitude" class="form-control" placeholder="Longitude"
                                    value="{{ $item->longitude }}"></td>
                            </td>
                            <td>
                            <th class="text-uppercase align-middle">Latitude</th>
                            <td>: <input type="text" name="latitude" class="form-control" placeholder="Latitude"
                                    value="{{ $item->latitude }}"></td>
                            </td>
                        </tr>
                    </table>
                    <div class="text-center">
                        <button type="submit" class="btn btn-sm bg-primary text-white mb-0 text-center"
                            style=" border-radius: 4px; width: 30%; text-transform: none;">Simpan</span></button>
                        <button type="reset" class="btn btn-sm btn-secondary  mb-0 text-center"
                            style="border-radius: 4px;width: 30%;text-transform: none; border:1px solid #dfe0e1"
                            data-bs-dismiss="modal">Batal</span></button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
