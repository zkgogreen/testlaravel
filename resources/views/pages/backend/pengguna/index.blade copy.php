@extends('layouts.admin')

@push('addon-modal')
    <!-- modal import excel -->
    <div class="modal" id="addPengguna" tabindex="-1" role="dialog" aria-labelledby="Add Pengguna Baru"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="width: 25%;">
            <div class="modal-content">
                <div class="modal-header p-1 col-md-12">
                    <div class="col-md-2">
                        <span class="iconify" data-icon="akar-icons:arrow-left" data-width="19"  data-dismiss="modal" data-height="19"></span></div>
                    <div class="col-md-8 text-center">
                        <h4 class="modal-title mb-0" id="addPenggunaTitle" style="margin-left: 3%;">Tambah Pengguna
                    </h4>
                </div>
                <div class="col-md-2">
            </div>
                </div>
                <div class="modal-body text-center">
                    {{-- <span class="iconify" data-icon="lucide:import" data-width="100" data-height="100"
                data-flip="horizontal"></span> --}}
                    <form action="{{ route('add-pengguna') }}" method="POST">
                        @csrf
                         <!-- name -->
                        <div class="mb-3">
                                <input id="name" type="text" class="form-control form-style-custom2 @error('name') is-invalid @enderror" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                                <!-- Email -->
        <div class="mb-3">
            <input type="email" class="form-control form-style-custom  @error('email') is-invalid @enderror" name="email"
                placeholder="Email" required autocomplete="email" autofocus value="{{ old('email') }}">
            <span class="iconify icon-style-custom" data-icon="gridicons:user" data-width="29" data-height="29"></span>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <!-- Password -->
        <div class="mb-3">
            <input type="password" class="form-control form-style-custom @error('password') is-invalid @enderror"
                placeholder="Password" aria-label="Password" aria-describedby="password-addon" name="password" required
                autocomplete="new-password">
            <span class="iconify icon-style-custom" data-icon="dashicons:lock" data-width="29" data-height="29"></span>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

             <!-- confirmation Password -->
             <div class="mb-3">
                <input type="password" class="form-control form-style-custom"
                    placeholder="Confirm Password" aria-label="Password" aria-describedby="password-addon" name="password_confirmation" required
                    autocomplete="new-password">
                <span class="iconify icon-style-custom" data-icon="dashicons:lock" data-width="29" data-height="29"></span>
            </div>
            <div class="mb-3">
            <select class="form-control form-style-custom2" name="roles">
                <option value="">Pilih Level</option>
                <option value="SUPER USER">SUPER USER</option>
                <option value="ADMIN">ADMIN</option>
                <option value="USER">USER</option>
            </select>
        </div>

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
    </div>
    <!-- end modal import excel -->


      <!-- modal import excel -->
      <div class="modal" id="deleteConfirm" tabindex="-1" role="dialog" aria-labelledby="Delete Confirm"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document" style="width: 25%;">
          <div class="modal-content">
              <div class="modal-body text-center">
                  {{-- <span class="iconify" data-icon="lucide:import" data-width="100" data-height="100"
              data-flip="horizontal"></span> --}}
                       <!-- name -->
    <div>
        <h4 class="text-center">Yakin akan menghapus data ?</h4>
        <p class="text-center">data yang telah di hapus tidak akan bisa dikembalikan</p>
    </div>

    <div class="text-center">
        <button type="submit" id="modalDelete" class="btn btn-sm bg-primary text-white mb-0 text-center"
            style=" border-radius: 4px; width: 30%; text-transform: none;">Hapus</span></button>
        <button type="reset" class="btn btn-sm btn-secondary  mb-0 text-center"
            style="border-radius: 4px;width: 30%;text-transform: none; border:1px solid #dfe0e1"
            data-bs-dismiss="modal">Batal</span></button>
    </div>
              </div>
          </div>
      </div>
  </div>
  <!-- end modal import excel -->

  @endpush

@section('content')
<div class="card col-md-12">
    <!-- <div class="card-block" style="padding: 1%; padding-top: 1.5%;"> -->
      <div class="card-body" style="padding:2%;">
        <!-- <h4 class="card-title">Simple Basic Map</h4> -->
        <div class="d-flex col-md-12">
            <div class="col-md-9 text-left mt-1">
          <h4 class="mb-0">Daftar Pengguna & Hak Akses</h4>
        </div>
          {{-- <a href="#"><small>Show All</small></a> --}}
          <div class="col-md-3 text-right">
                    <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addPengguna" style="border-radius: 8px;">
                        <span class="iconify text-white iconbtn" data-icon="fa-solid:user-plus" data-width="19" data-height="19"></span>
                        <span class="text-white" style="font-size: 13px;">Tambah Pengguna</span></a>
                    </div>
        </div>
  <div class="table-responsive p-3">
    <table class="table align-items-center mb-0">
      <thead>
        <tr>
          <th class="text-uppercase text-center text-xxs font-weight-bolder">No</th>
          <th class="text-uppercase text-center text-xxs font-weight-bolder">Nama</th>
          <th class="text-uppercase text-center text-xxs font-weight-bolder">Email</th>
          <th class="text-uppercase text-center text-xxs font-weight-bolder">Level</th>
          <th class="text-uppercase  text-center text-xxs font-weight-bolder">Tanggal Dibuat</th>
          <th class="text-secondary opacity-7"></th>
        </tr>
      </thead>
      <tbody>
        @forelse ($items as $item)
        <tr>
            <th class="align-middle text-center" scope="row"><h6 class="mb-0 text-sm">{{ $item->id }}</h6></th>
            <td class="align-middle text-center"><p class="text-xs font-weight-bold mb-0">{{ $item->name }}</p></td>
            <td class="align-middle text-center"><span>{{ $item->email }}</span></td>
            <td class="align-middle text-center"><span>{{ $item->roles }}</span></td>
            <td class="align-middle text-center"><span>{{ $item->created_at }}</span></td>
            <td class="align-middle text-center">
              <a href="{{ route('edit-pengguna' , $item->id) }}" class="btn btn-link text-dark px-3 mb-0" data-toggle="tooltip" data-original-title="Edit item">
                <span class="iconify" data-icon="ci:edit" data-width="19" data-height="19"></span> Edit
              </a>
              <form action="{{ route('destroy-pengguna' , $item->id) }}" method="post" class="d-inline" 
                onsubmit="return confirm('Yakin hapus data?')">
                @csrf
                @method('delete')
              <button class="btn btn-link text-danger text-gradient px-3 mb-0" data-toggle="tooltip" data-original-title="Delete item">
                <span class="iconify" data-icon="fluent:delete-48-filled" data-width="19" data-height="19"></span> Delete
              </button>
              {{-- <button class="btn btn-link text-danger text-gradient px-3 mb-0" data-toggle="modal" data-target="#deleteConfirm" class="confrimDel" data-id="{{ $item->id }}" data-toggle="tooltip" data-original-title="Delete item">
                Delete
              </button> --}}
            </form>
            </td>
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

@section('addon-script')

{{-- <script>
$('.confrimDel').click(function(){
    var id=$(this).data('id');
    $('#modalDelete').attr('href','destroy-pengguna/'+id);
})
</script> --}}

@endsection