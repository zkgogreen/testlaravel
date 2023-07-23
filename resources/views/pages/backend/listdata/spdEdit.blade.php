@extends('layouts.admin')

@section('content')
    <div class="card col-md-12">
        <!-- <div class="card-block" style="padding: 1%; padding-top: 1.5%;"> -->
        <div class="card-body" style="padding:2%;">
            <div class="d-flex col-md-12">
                <div class="col-md-2 text-left" style="padding-left: 4%;">
                    <a class="btn btn-sm btn-primary" href="{{ route('SpdTable') }}" style="border-radius: 8px;">
                        <span class="text-white" style="font-size: 13px;">Kembali</span></a>
                </div>
                <div class="col-md-8 text-center">
                    <h4 class="mt-2">EDIT SURVEY POTENSI DESA</h4>
                </div>
                <div class="col-md-2 text-center"></div>
                {{-- <a href="#"><small>Show All</small></a> --}}

            </div>
            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est quod cupiditate esse fuga</p> --}}
            <div class="table-responsive p-3">
                <form action="{{ route('SpdUpdate', $item->id) }}" method="post" style="padding:5%;">
                    @method('PUT')
                    @csrf
                    <table class="table align-items-center mb-0">
                        <tr>
                            <td>
                            <th class="text-uppercase align-middle">Kode BPS</th>
                            <td>: <input type="text" class="form-control" placeholder="Kode BPS"
                                    value="{{ $item->kode_bps }}" disabled></td>
                            </td>
                            <td>
                            <th class="text-uppercase align-middle">Desa / Kelurahan</th>
                            <td>: <input type="text" class="form-control" placeholder="Desa / Kelurahan"
                                    value="{{ $item->r104n }}" disabled></td>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <th class="text-uppercase align-middle">Kecamatan</th>
                            <td>: <input type="email" class="form-control" placeholder="Kecamatan"
                                    value="{{ $item->r103n }}" disabled></td>
                            </td>
                            <td>
                            <th class="text-uppercase align-middle">Kabupaten / Kota</th>
                            <td>: <input type="text" class="form-control" placeholder="Kabupaten / Kota"
                                    value="{{ $item->r102n }}" disabled></td>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <th class="text-uppercase align-middle">Provinsi</th>
                            <td>: <input type="text" class="form-control" placeholder="Provinsi"
                                    value="{{ $item->r101n }}" disabled></td>
                            </td>
                            <td>
                            <th class="text-uppercase align-middle">Nama Khusus</th>
                            <td>: <input type="text" name="spd_nama" class="form-control" placeholder="Nama"
                                    value="{{ $item->spd_nama }}"></td>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="8" class="text-center">Informasi Detail</th>
                        </tr>
                        <tr>
                            <td>
                            <th class="text-uppercase align-middle">Tahun Survey</th>
                            <td>: <input type="text" name="spd_thn_survey" class="form-control" placeholder="Tahun Survey"
                                    value="{{ $item->spd_thn_survey }}"></td>
                            </td>
                            <td>
                            <th class="text-uppercase align-middle">Seluler</th>
                            <td>: <input type="text" name="spd_seluler" class="form-control" placeholder="Seluler"
                                    value="{{ $item->spd_seluler }}"></td>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <th class="text-uppercase align-middle">Elektrifikasi</th>
                            <td>: <input type="text" name="spd_elektrifikasi" class="form-control"
                                    placeholder="Elektrifikasi" value="{{ $item->spd_elektrifikasi }}"></td>
                            </td>
                            <td>
                            <th class="text-uppercase align-middle">Akses Jalan</th>
                            <td>: <input type="text" name="spd_akses_jalan" class="form-control"
                                    placeholder="Akses Jalanl" value="{{ $item->spd_akses_jalan }}"></td>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <th class="text-uppercase align-middle">Jumlah Penduduk</th>
                            <td>: <input type="text" name="spd_jumlah_penduduk" class="form-control"
                                    placeholder="Jumlah Penduduk" value="{{ $item->spd_jumlah_penduduk }}"></td>
                            </td>
                            <td>
                            <th class="text-uppercase align-middle">Jumlah KK</th>
                            <td>: <input type="text" name="spd_jumlah_kk" class="form-control" placeholder="Jumlah KK"
                                    value="{{ $item->spd_jumlah_kk }}"></td>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <th class="text-uppercase align-middle">Pencaharian</th>
                            <td>: <input type="text" name="spd_pencaharian" class="form-control" placeholder="Pencaharian"
                                    value="{{ $item->spd_pencaharian }}"></td>
                            </td>
                            <td>
                            <th class="text-uppercase align-middle">Pendapatan</th>
                            <td>: <input type="text" name="spd_pendapatan" class="form-control"
                                    placeholder="Desa / Kelurahan" value="{{ $item->spd_pendapatan }}"></td>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <th class="text-uppercase align-middle">Jumlah UMKM</th>
                            <td>: <input type="text" name="spd_jumlah_umkm" class="form-control" placeholder="Jumlah UMKM"
                                    value="{{ $item->spd_jumlah_umkm }}"></td>
                            </td>
                            <td>
                            <th class="text-uppercase align-middle">Jenis UMKM</th>
                            <td>: <input type="text" name="spd_jenis_umkm" class="form-control" placeholder="Jenis UMKM"
                                    value="{{ $item->spd_jenis_umkm }}"></td>
                            </td>

                        </tr>
                        <tr>
                            <td>
                            <th class="text-uppercase align-middle">Pemerintah Desa</th>
                            <td>: <input type="text" name="spd_pemerintah_desa" class="form-control"
                                    placeholder="Pemerintah Desa" value="{{ $item->spd_pemerintah_desa }}"></td>
                            </td>
                            <td>
                            <th class="text-uppercase align-middle">Bumdes</th>
                            <td>: <input type="text" name="spd_bumdes" class="form-control" placeholder="Bumdes"
                                    value="{{ $item->spd_bumdes }}"></td>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <th class="text-uppercase align-middle">Komunitas</th>
                            <td>: <input type="text" name="spd_komunitas" class="form-control" placeholder="Komunitas"
                                    value="{{ $item->spd_komunitas }}"></td>
                            </td>
                            <td>
                            <th class="text-uppercase align-middle">Dana Desa</th>
                            <td>: <input type="text" name="spd_dana_desa" class="form-control" placeholder="Provinsi"
                                    value="{{ $item->spd_dana_desa }}"></td>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="8" class="text-center">Potensi</th>
                        </tr>
                        <tr>
                            <td colspan="8"><textarea name="spd_potensi" class="form-control"
                                    id="">{{ $item->spd_potensi }}</textarea>
                            </td>
                        </tr>


                    </table>
                    <div class="text-center">
                        <button type="submit" class="btn btn-sm bg-primary text-white mb-0 text-center"
                            style=" border-radius: 4px; width: 30%; text-transform: none;">Simpan</span></button>
                        <button type="reset" class="btn btn-sm btn-secondary  mb-0 text-center"
                            style="border-radius: 4px;width: 30%;text-transform: none; border:1px solid #dfe0e1">Batal</span></button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
