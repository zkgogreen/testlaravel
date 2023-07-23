<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" style="max-width: 420px;
      margin-top: 30%;">
        <div class="modal-body p-0">
                <div class="login-container">
                  <span class="iconify logo" data-icon="material-symbols:lock-person-outline"></span>
                  <h3>User Authentication</h3>
                  <p>Sistem Informasi Geospasial Potensi Ekosistem Broadband</p>
                  <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                      <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">
                            <span class="iconify icon" data-icon="ic:baseline-email"></span>
                        </span>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" aria-label="Email" aria-describedby="addon-wrapping"   
                        name="email" required autocomplete="email" autofocus
                        value="{{ old('email') }}">
                      </div>
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                    </div>
                    <div class="mb-3">
                      <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">
                            <span class="iconify icon" data-icon="material-symbols:password"></span>
                        </span>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" aria-label="Password" aria-describedby="addon-wrapping"
                        name="password" required autocomplete="current-password">
                      </div>
                      @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-8 mt-2">
                                @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">Forgot Your Password ?</a>
                            @endif
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-outline-dark float-end w-100">Login</button>
                            </div>
                        </div>
                    </div>
                    <p class="fw-normal mb-0">Kementerian Komunikasi dan Informatika</p>
                    <p class="fw-lighter mb-0">Direktorat Pengendalian Pos dan Informatika</p>
                  </form>
                </div>
        </div>
      </div>
    </div>
  </div>