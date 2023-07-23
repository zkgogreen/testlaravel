@extends('layouts.admin')

@section('content')
    <div class="card col-md-12">
        <!-- <div class="card-block" style="padding: 1%; padding-top: 1.5%;"> -->
        <div class="card-body" style="padding:2%;">
            <div class="d-flex col-md-12">
                <div class="col-md-2 text-left" style="padding-left: 4%;">
                    <a class="btn btn-sm btn-primary" href="{{ route('KpTable') }}" style="border-radius: 8px;">
                        <span class="text-white" style="font-size: 13px;">Kembali</span></a>
                </div>
                <div class="col-md-8 text-center">
                    <h4 class="mt-2">DETAIL KAWASAN PRIORIAS</h4>
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
                        <th class="text-uppercase align-middle">Jenis Kawasan</th>
                        <td>: {{ $item->kp_jenis_kawasan }}</td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <th class="text-uppercase align-middle">3T</th>
                        <td>: {{ $item->kp_3t }}</td>
                        </td>
                        <td>
                        <th class="text-uppercase align-middle">Lokasi Prioritas</th>
                        <td>: {{ $item->kp_lokpri }}</td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <th class="text-uppercase align-middle">Keterangan</th>
                        <td>: {{ $item->kp_prioritas_filter }}</td>
                        </td>
                    </tr>

                </table>

            </div>

        </div>
    </div>
@endsection
