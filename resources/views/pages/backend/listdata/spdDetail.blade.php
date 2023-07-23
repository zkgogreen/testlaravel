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
                    <h4 class="mt-2">DETAIL SURVEY POTENSI DESA</h4>
                </div>
                <div class="col-md-2 text-center"></div>
                {{-- <a href="#"><small>Show All</small></a> --}}

            </div>
            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est quod cupiditate esse fuga</p> --}}
            <div class="table-responsive p-3">
                <table class="table align-items-center mb-0">
                    <tr>
                        <td>
                        <th class="text-uppercase align-middle">Kode BPS</th>
                        <td>: {{ $item->kode_bps }}</td>
                        </td>
                        <td>
                        <th class="text-uppercase align-middle">Desa / KELURAHAN</th>
                        <td>: {{ $item->r104n }}</td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <th class="text-uppercase align-middle">Kecamatan</th>
                        <td>: {{ $item->r103n }}</td>
                        </td>
                        <td>
                        <th class="text-uppercase align-middle">Kabupaten / Kota</th>
                        <td>: {{ $item->r102n }}</td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <th class="text-uppercase align-middle">Provinsi</th>
                        <td>: {{ $item->r101n }}</td>
                        </td>
                        <td>
                        <th class="text-uppercase align-middle">Nama</th>
                        <td>: {{ $item->spd_nama }}</td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <th class="text-uppercase align-middle">Seluler</th>
                        <td>: {{ $item->spd_seluler }}</td>
                        </td>
                        <td>
                        <th class="text-uppercase align-middle">Elektrifikasi</th>
                        <td>: {{ $item->spd_elektrifikasi }}</td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <th class="text-uppercase align-middle">Akses Jalan</th>
                        <td>: {{ $item->spd_akses_jalan }}</td>
                        </td>
                        <td>
                        <th class="text-uppercase align-middle">Jumlah Penduduk</th>
                        <td>: {{ $item->spd_jumlah_penduduk }}</td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <th class="text-uppercase align-middle">Jumlah KK</th>
                        <td>: {{ $item->spd_jumlah_kk }}</td>
                        </td>
                        <td>
                        <th class="text-uppercase align-middle">Pendapatan</th>
                        <td>: {{ $item->spd_pendapatan }}</td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <th class="text-uppercase align-middle">Jumlah UMKM</th>
                        <td>: {{ $item->spd_jumlah_umkm }}</td>
                        </td>
                        <td>
                        <th class="text-uppercase align-middle">Komunitas</th>
                        <td>: {{ $item->spd_komunitas }}</td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <th class="text-uppercase align-middle">Dana Desa</th>
                        <td>: {{ $item->spd_dana_desa }}</td>
                        </td>
                        <td>
                        <th class="text-uppercase align-middle">Pemerintah Desa</th>
                        <td>: {{ $item->spd_pemerintah_desa }}</td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <th class="text-uppercase align-middle">Bumdes</th>
                        <td>: {{ $item->spd_bumdes }}</td>
                        </td>
                        <td>
                        <th class="text-uppercase align-middle">Pencaharian</th>
                        <td>: {{ $item->spd_pencaharian }}</td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <th class="text-uppercase align-middle">Jenis UMKM</th>
                        <td>: {{ $item->spd_jenis_umkm }}</td>
                        </td>
                        <td>
                        <th class="text-uppercase align-middle">PIC</th>
                        <td>: {{ $item->spd_pic }}</td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <th class="text-uppercase align-middle">Keterangan</th>
                        <td>: {{ $item->spd_keterangan }}</td>
                        </td>
                        <td>
                        <th class="text-uppercase align-middle">Tahun Survey</th>
                        <td>: {{ $item->spd_thn_survey }}</td>
                        </td>
                    </tr>
                    {{-- <tr>
                        <td>
                        <th class="text-uppercase align-middle">Potensi</th>
                        <td colspan="6">: <p>{{ $item->spd_potensi }}</p>
                        </td>
                        </td>
                        <td></td>
                    </tr> --}}

                </table>

            </div>

        </div>
    </div>
@endsection
