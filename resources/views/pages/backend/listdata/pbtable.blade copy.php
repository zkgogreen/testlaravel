@extends('layouts.admin')

@section('content')
    @auth
        <div class="card col-md-12">
            <div class="card-block" style="padding: 1%; padding-top: 1.5%;">
                <div class="tabs">
                    <div class="tab-2">
                        <label for="tab2-1">Penerima Bantuan</label>
                        <input id="tab2-1" name="tabs-two" type="radio" checked="checked">
                        <div>
                            <div class="d-flex col-md-12">
                                <div class="col-md-2 text-left" style="padding-left: 4%;">
                                    @if (Auth::user()->roles == 'ADMIN')
                                        <a class="btn btn-sm btn-primary" href="{{ route('pbCreate') }}"
                                            style="border-radius: 8px;">
                                            <span class="text-white" style="font-size: 13px;">Tambah Data</span></a>
                                    @endif
                                </div>
                                <div class="col-md-8 text-center">
                                    <h4 class="mt-2">PENERIMA BANTUAN</h4>
                                </div>
                                <div class="col-md-2 text-center">
                                    <p>Jumlah <b>{{ number_format($pb_total) }}</b></p>
                                </div>
                            </div>
                            <div class="table-responsive p-3">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-center text-xxs font-weight-bolder">No</th>
                                            <th class="text-uppercase text-center text-xxs font-weight-bolder">Nama</th>
                                            <th class="text-uppercase text-center text-xxs font-weight-bolder">Jenis Usaha</th>
                                            @if (Auth::user()->roles == 'ADMIN')
                                                <th class="text-uppercase text-xxs font-weight-bolder">Alamat</th>
                                            @endif
                                            <th class="text-uppercase  text-center text-xxs font-weight-bolder">Desa / Kelurahan
                                            </th>
                                            <th class="text-uppercase  text-center text-xxs font-weight-bolder">Kecamatan</th>
                                            <th class="text-uppercase  text-center text-xxs font-weight-bolder">Kab / Kota</th>
                                            <th class="text-uppercase  text-center text-xxs font-weight-bolder">Provinsi</th>
                                            <th class="text-uppercase  text-center text-xxs font-weight-bolder">Thn Bantuan</th>
                                            @if (Auth::user()->roles == 'ADMIN')
                                                <th class="text-secondary opacity-7"></th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody id="datadicari">
                                        @forelse ($items as $item)
                                            <tr>
                                                <th class="align-middle text-center" scope="row">
                                                    {{-- <h6 class="mb-0 text-sm">{{ ++$i }}</h6> --}}
                                                    <h6 class="mb-0 text-sm">
                                                        {{ $items->count() * ($items->currentPage() - 1) + $loop->iteration }}
                                                    </h6>
                                                </th>
                                                <td class="align-middle text-center">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $item->nama }}</p>
                                                </td>
                                                <td class="align-middle text-center"><span>{{ $item->jenis_usaha }}</span>
                                                </td>
                                                @if (Auth::user()->roles == 'ADMIN')
                                                    <td class="align-middle"><span>{{ $item['alamat'] }}</span></td>
                                                @endif
                                                <td class="align-middle text-center"><span>{{ $item->desa }}</span></td>
                                                <td class="align-middle text-center"><span>{{ $item->kecamatan }}</span></td>
                                                <td class="align-middle text-center"><span>{{ $item->kab_kota }}</span></td>
                                                <td class="align-middle text-center"><span>{{ $item->provinsi }}</span></td>
                                                <td class="align-middle text-center"><span>{{ $item->thn_bantuan }}</span>
                                                </td>

                                                @if (Auth::user()->roles == 'ADMIN')
                                                    <td class="align-middle text-center">
                                                        {{-- <a href="{{ route('PbShow', $item->id) }}"
                                                class="btn btn-link text-info px-3 mb-0" data-toggle="tooltip"
                                                data-original-title="Show item">
                                                <span class="iconify" data-icon="ant-design:eye-filled" data-width="19"
                                                    data-height="19"></span> Detail
                                            </a> --}}
                                                        <a href="{{ route('PbEdit', $item->id) }}"
                                                            class="btn btn-link text-dark px-3 mb-0" data-toggle="tooltip"
                                                            data-original-title="Edit item">
                                                            <span class="iconify" data-icon="ci:edit" data-width="19"
                                                                data-height="19"></span> Edit
                                                        </a>
                                                        <form action="{{ route('PbDestroy', $item->id) }}" method="post"
                                                            class="d-inline" onsubmit="return confirm('Yakin hapus data?')">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-link text-danger text-gradient px-3 mb-0"
                                                                data-toggle="tooltip" data-original-title="Delete item">
                                                                <span class="iconify" data-icon="fluent:delete-48-filled"
                                                                    data-width="19" data-height="19"></span> Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                @endif
                                            </tr>
                                        @empty
                                            <tr colspan="5" class="text-center">
                                                <td>Data Tidak Ada</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                {{-- Pagination --}}
                                <div class="d-flex justify-content-center mt-4">
                                    <br>
                                    {!! $items->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-2">
                        <label for="tab2-2">Penerima Bantuan</label>
                        <input id="tab2-2" name="tabs-two" type="radio">
                        <div>
                            <div class="d-flex col-md-12">
                                <div class="col-md-10 text-left">
                                    <h4 class="mt-2">PENERIMA BANTUAN</h4>
                                </div>
                                <div class="col-md-2 text-right">
                                    <p>Jumlah <b>{{ number_format($data['count']) }}</b></p>
                                </div>
                            </div>
                            <div class="table-responsive p-3" style="height:600px;">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-center text-xxs font-weight-bolder">No</th>
                                            <th class="text-uppercase text-center text-xxs font-weight-bolder">Nama</th>
                                            @if (Auth::user()->roles == 'ADMIN')
                                                <th class="text-uppercase text-center text-xxs font-weight-bolder">Telpon</th>
                                            @endif
                                            <th class="text-uppercase text-center text-xxs font-weight-bolder">Jenis Usaha</th>
                                            @if (Auth::user()->roles == 'ADMIN')
                                                <th class="text-uppercase text-xxs font-weight-bolder">Alamat</th>
                                            @endif
                                            <th class="text-uppercase  text-center text-xxs font-weight-bolder">Desa / Kelurahan
                                            </th>
                                            <th class="text-uppercase  text-center text-xxs font-weight-bolder">Kecamatan</th>
                                            <th class="text-uppercase  text-center text-xxs font-weight-bolder">Kab / Kota</th>
                                            <th class="text-uppercase  text-center text-xxs font-weight-bolder">Provinsi</th>
                                            <th class="text-uppercase  text-center text-xxs font-weight-bolder">Bandwith</th>
                                            <th class="text-uppercase  text-center text-xxs font-weight-bolder">Thn Bantuan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="datadicari">
                                        <?php $no = 0; ?>
                                        @forelse ($data['detail'] as $item)
                                            <?php $no++; ?>
                                            <tr>
                                                <th class="align-middle text-center" scope="row">
                                                    {{-- <h6 class="mb-0 text-sm">{{ ++$i }}</h6> --}}
                                                    <h6 class="mb-0 text-sm">
                                                        {{ $no }}
                                                </th>
                                                <td class="align-middle text-center">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $item['nama_lengkap'] }}</p>
                                                </td>
                                                @if (Auth::user()->roles == 'ADMIN')
                                                    <td class="align-middle text-center"><span>{{ $item['telp'] }}</span>
                                                    </td>
                                                @endif
                                                <td class="align-middle text-center"><span>{{ $item['keterangan'] }}</span>
                                                </td>
                                                @if (Auth::user()->roles == 'ADMIN')
                                                    <td class="align-middle"><span>{{ $item['alamat'] }}</span></td>
                                                @endif
                                                <td class="align-middle text-center"><span>{{ $item['iddesa'] }}</span></td>
                                                <td class="align-middle text-center"><span>{{ $item['idkec'] }}</span></td>
                                                <td class="align-middle text-center"><span>{{ $item['idkabupaten'] }}</span>
                                                </td>
                                                <td class="align-middle text-center"><span>{{ $item['idprovinsi'] }}</span>
                                                </td>
                                                <td class="align-middle text-center"><span>{{ $item['bandwith'] }}</span>
                                                </td>
                                                <td class="align-middle text-center"><span>{{ $item['tahun'] }}</span></td>
                                            </tr>
                                        @empty
                                            <tr colspan="5" class="text-center">
                                                <td>Data Tidak Ada</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection
