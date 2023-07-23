@extends('layouts.admin')

@section('content')
    <div class="card col-md-12">
        <!-- <div class="card-block" style="padding: 1%; padding-top: 1.5%;"> -->
        <div class="card-body" style="padding:2%;">
            <!-- <h4 class="card-title">Simple Basic Map</h4> -->
            <div class="d-flex col-md-12">
                <div class="col-md-2 text-left" style="padding-left: 4%;">
                    <a class="btn btn-sm btn-primary" href="{{ route('pengguna') }}" style="border-radius: 8px;">
                        <span class="text-white" style="font-size: 13px;">Kembali</span></a>
                </div>
                <div class="col-md-8 text-center">
                    <h4 class="mt-2">Edit Pengguna &amp; Hak Akses</h4>
                </div>
                <div class="col-md-2 text-center"></div>
                {{-- <a href="#"><small>Show All</small></a> --}}

            </div>
            <form action="{{ route('update-pengguna', $item->id) }}" method="post" style="padding:5%;">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="title">Nama</label>
                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $item->name }}">
                </div>
                <div class="form-group">
                    <label for="title">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Email"
                        value="{{ $item->email }}">
                </div>
                <div class="form-group">
                    <label for="title">Level</label>
                    <select name="roles" class="form-control">
                        <option value="" selected>--Pilih Level--</option>
                        <option value="SUPER USER" {{ $item->roles == 'SUPER USER' ? 'selected' : '' }}>SUPER USER
                        </option>
                        <option value="ADMIN" {{ $item->roles == 'ADMIN' ? 'selected' : '' }}>ADMIN</option>
                        <option value="USER" {{ $item->roles == 'USER' ? 'selected' : '' }}>USER</option>
                    </select>
                </div>
                {{-- <button tyoe="submit" class="btn btn-primary btn-block">Simpan</button> --}}
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

@endsection
