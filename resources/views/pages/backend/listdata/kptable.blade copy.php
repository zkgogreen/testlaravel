@extends('layouts.admin')

@section('content')
    <div class="card col-md-12">
        <!-- <div class="card-block" style="padding: 1%; padding-top: 1.5%;"> -->
        <div class="card-body" style="padding:2%;">
            <!-- <h4 class="card-title">Simple Basic Map</h4> -->
            <div class="d-flex justify-content-between">
                <h4 class="mb-0">Kawasan Prioritas</h4>
                <p>Jumlah <b>{{ number_format($kp_total) }}</b></p>
                {{-- <a href="#"><small>Show All</small></a> --}}
            </div>
            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est quod cupiditate esse fuga</p> --}}
            <div class="table-responsive p-3">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-center text-xxs font-weight-bolder">No</th>
                            <th class="text-uppercase text-center text-xxs font-weight-bolder">ID Desa</th>
                            <th class="text-uppercase text-center text-xxs font-weight-bolder">Desa / Kelurahan</th>
                            <th class="text-uppercase text-center text-xxs font-weight-bolder">Kecamatan</th>
                            <th class="text-uppercase text-center text-xxs font-weight-bolder">Kab / Kota</th>
                            <th class="text-uppercase text-center text-xxs font-weight-bolder">Provinsi</th>
                            <th class="text-uppercase text-center text-xxs font-weight-bolder">Jenis Kawasan</th>
                            @if (Auth::user()->roles == 'ADMIN')
                                <th class="text-secondary opacity-7"></th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <th class="align-middle text-center" scope="row">
                                    <h6 class="mb-0 text-sm">{{ ++$i }}</h6>
                                </th>
                                <td class="align-middle text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $item->kode_bps }}</p>
                                </td>
                                <td class="align-middle text-center"><span>{{ $item->r104n }}</span></td>
                                <td class="align-middle text-center"><span>{{ $item->r103n }}</span></td>
                                <td class="align-middle text-center"><span>{{ $item->r102n }}</span></td>
                                <td class="align-middle text-center"><span>{{ $item->r101n }}</span></td>
                                <td class="align-middle text-center"><span>{{ $item->kp_jenis_kawasan }}</span></td>

                                @if (Auth::user()->roles == 'ADMIN')
                                    <td class="align-middle text-center">
                                        {{-- <a href="{{ route('KpShow', $item->id) }}"
                                            class="btn btn-link text-info px-3 mb-0" data-toggle="tooltip"
                                            data-original-title="Show item">
                                            <span class="iconify" data-icon="ant-design:eye-filled" data-width="19"
                                                data-height="19"></span> Detail
                                        </a> --}}
                                        <a href="{{ route('KpEdit', $item->id) }}"
                                            class="btn btn-link text-dark px-3 mb-0" data-toggle="tooltip"
                                            data-original-title="Edit item">
                                            <span class="iconify" data-icon="ci:edit" data-width="19"
                                                data-height="19"></span> Edit
                                        </a>
                                        <form action="{{ route('KpDestroy', $item->id) }}" method="post"
                                            class="d-inline" onsubmit="return confirm('Yakin hapus data?')">
                                            @method('PATCH')
                                            @csrf
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
@endsection
