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
                    <h4 class="mt-2">EDIT KAWASAN PRIORITAS</h4>
                </div>
                <div class="col-md-2 text-center"></div>
                {{-- <a href="#"><small>Show All</small></a> --}}

            </div>
            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est quod cupiditate esse fuga</p> --}}
            <div class="table-responsive p-3">
                <form action="{{ route('KpUpdate', $item->id) }}" method="post" style="padding:5%;">
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
                            <td>: <input type="text" class="form-control" placeholder="Kecamatan"
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
                            <th class="text-uppercase align-middle">Jenis Kawasan</th>
                            <td>: <input type="text" name="kp_jenis_kawasan " class="form-control"
                                    placeholder="Jenis Kawasan" value="{{ $item->kp_jenis_kawasan }}"></td>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <th class="text-uppercase align-middle">3T</th>
                            <td>: <input type="text" name="kp_3t" class="form-control" placeholder="3T"
                                    value="{{ $item->kp_3t }}"></td>
                            </td>
                            <td>
                            <th class="text-uppercase align-middle">Lokasi Prioritas</th>
                            <td>: <input type="text" name="kp_lokpri" class="form-control" placeholder="Lokasi Prioritas"
                                    value="{{ $item->kp_lokpri }}"></td>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <th class="text-uppercase align-middle">Keterangan</th>
                            <td>: <input type="text" name="kp_prioritas_filter" class="form-control"
                                    placeholder="Keterangan" value="{{ $item->kp_prioritas_filter }}"></td>
                            </td>
                            <td>
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
