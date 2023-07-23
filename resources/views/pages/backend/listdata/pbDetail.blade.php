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
                    <h4 class="mt-2">DETAIL PENERIMA BANTUAN</h4>
                </div>
                <div class="col-md-2 text-center"></div>
                {{-- <a href="#"><small>Show All</small></a> --}}

            </div>
            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est quod cupiditate esse fuga</p> --}}
            <div class="table-responsive p-3">
                <table class="table align-items-center mb-0">
                    <tr>
                        <td>
                        <th class="text-uppercase align-middle">Nama</th>
                        <td>: {{ $item->nama }}</td>
                        </td>
                        <td>
                        <th class="text-uppercase align-middle">Telepon</th>
                        <td>: {{ $item->telepon }}</td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <th class="text-uppercase align-middle">Email</th>
                        <td>: {{ $item->email }}</td>
                        </td>
                        <td>
                        <th class="text-uppercase align-middle">Jenis Usaha</th>
                        <td>: {{ $item->jenis_usaha }}</td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <th class="text-uppercase align-middle">Produk</th>
                        <td>: {{ $item->produk }}</td>
                        </td>
                        <td>
                        <th class="text-uppercase align-middle">Nama PIC</th>
                        <td>: {{ $item->nama_pic }}</td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <th class="text-uppercase align-middle">Kontak PIC</th>
                        <td>: {{ $item->kontak_pic }}</td>
                        </td>
                        <td>
                        <th class="text-uppercase align-middle">Pengusul</th>
                        <td>: {{ $item->pengusul }}</td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <th class="text-uppercase align-middle">Keterangan</th>
                        <td>: {{ $item->keterangan }}</td>
                        </td>
                        <td>
                        <th class="text-uppercase align-middle">Tahun Bantuan</th>
                        <td>: {{ $item->thn_bantuan }}</td>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="8" class="text-center">Informasi Lokasi</th>
                    </tr>
                    <tr>
                        <td>
                        <th class="text-uppercase align-middle">Desa</th>
                        <td>: {{ $item->desa }}</td>
                        </td>
                        <td>
                        <th class="text-uppercase align-middle">Kecamatan</th>
                        <td>: {{ $item->kecamatan }}</td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <th class="text-uppercase align-middle">Kabupaten / Kota</th>
                        <td>: {{ $item->kab_kota }}</td>
                        </td>
                        <td>
                        <th class="text-uppercase align-middle">Provinsi</th>
                        <td>: {{ $item->provinsi }}</td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <th class="text-uppercase align-middle">Longitude</th>
                        <td>: {{ $item->longitude }}</td>
                        </td>
                        <td>
                        <th class="text-uppercase align-middle">Latitude</th>
                        <td>: {{ $item->latitude }}</td>
                        </td>
                    </tr>
                </table>

            </div>

        </div>
    </div>
@endsection
