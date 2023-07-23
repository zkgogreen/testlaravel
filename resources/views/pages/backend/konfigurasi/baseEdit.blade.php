@extends('layouts.admin')

@section('content')
    <div class="card col-md-12">
        <!-- <div class="card-block" style="padding: 1%; padding-top: 1.5%;"> -->
        <div class="card-body" style="padding:2%;">
            <div class="d-flex col-md-12">
                <div class="col-md-2 text-left" style="padding-left: 4%;">
                    <a class="btn btn-sm btn-primary" href="{{ route('konfigurasi') }}" style="border-radius: 8px;">
                        <span class="text-white" style="font-size: 13px;">Kembali</span></a>
                </div>
                <div class="col-md-8 text-center">
                    <h4 class="text-center">EDIT LIST BASEMAP</h4>
                    <p class="text-center">Edit daftar basemap tertampil di peta.</p>
                </div>
                <div class="col-md-2 text-center"></div>
                {{-- <a href="#"><small>Show All</small></a> --}}

            </div>
            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est quod cupiditate esse fuga</p> --}}
            <div class="table-responsive">
                <form action="{{ route('updateBase', $basemap->id) }}" method="post" style="padding:5%;">
                    @method('PUT')
                    @csrf
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align:center;">#</th>
                                <th scope="col" style="text-align:center;">Attribution</th>
                                <th scope="col" style="text-align:center;">Variant</th>
                                <th scope="col" style="text-align:center;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" style="text-align:center;"><input type="text" class="form-control"
                                        value="{{ $basemap->id }}" disabled></th>
                                <td style="text-align:center;"><input type="text" class="form-control"
                                        value="{{ $basemap->attribution }}" disabled></td>
                                <td style="text-align:center;"><input type="text" class="form-control"
                                        value="{{ $basemap->variant }}" disabled>
                                </td>
                                <td style="text-align:center;">
                                    <select name="status" class="form-control">
                                        <option value="" selected>--Pilih Level--</option>
                                        <option value="Active" {{ $basemap->status == 'Active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="Inactive" {{ $basemap->status == 'Inactive' ? 'selected' : '' }}>
                                            Inactive
                                        </option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
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
