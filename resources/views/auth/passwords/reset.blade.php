@extends('layouts.app2')

@section('content')

<div class="more-about" style="background:url('{{ url('assets/images/kominfo.jpg') }}') no-repeat center center; background-size: cover;">
    <div class="container"  style="max-width: 420px;">
        <div class="login-container">
          <span class="iconify logo" data-icon="material-symbols:lock-person-outline"></span>
        <h3>Reset Password</h3>
        <p>Sistem Informasi Geospasial Potensi Ekosistem Broadband</p>
            <form method="POST" action="{{ route('password.update') }}">
              @csrf
              <input type="hidden" name="token" value="{{ $token }}">
              <div class="mb-3">
                <div class="input-group flex-nowrap">
                  <span class="input-group-text" id="addon-wrapping">
                      <span class="iconify icon" data-icon="ic:baseline-email"></span>
                  </span>
                  <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" aria-label="Email" aria-describedby="addon-wrapping"   
                  name="email" required autocomplete="email" autofocus
                  value="{{ $email ?? old('email') }}">
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
                </div>
              </div>
              <div class="mb-3">
                <div class="input-group flex-nowrap">
                  <span class="input-group-text" id="addon-wrapping">
                      <span class="iconify icon" data-icon="material-symbols:password"></span>
                  </span>
                  <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" aria-label="Password" aria-describedby="addon-wrapping"
                  name="password" required autocomplete="current-password">
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
                </div>
              </div>
              <div class="mb-3">
                  <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">
                        <span class="iconify icon" data-icon="material-symbols:password"></span>
                    </span>
                    <input type="password" id="password-confirm" class="form-control @error('password') is-invalid @enderror" placeholder="Password" aria-label="Password" aria-describedby="addon-wrapping"
                    name="password_confirmation" required autocomplete="new-password">
                  </div>
                </div>
              <div class="mb-3">
                  <div class="row">
                      <div class="col-md-12">
                          <button type="submit" class="btn btn-outline-dark float-end w-100">Reset</button>
                      </div>
                  </div>
              </div>
              <p class="fw-normal mb-0">Kementerian Komunikasi dan Informatika</p>
              <p class="fw-lighter mb-0">Direktorat Pengendalian Pos dan Informatika</p>
            </form>
    </div>
</div>
</div>
@endsection
