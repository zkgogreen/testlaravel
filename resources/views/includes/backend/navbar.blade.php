  <!-- partial:partials/_navbar.html -->
  <nav class="navbar default-layout col-lg-12 col-12 fixed-top d-flex flex-row" style="border:0px;">
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <a class="navbar-brand brand-logo-mini" href="#">
            <img src="{{ url('assets/images/kominfo-2.png') }}" alt="logo" style="height: 60px;"> </a>
          <ul class="navbar-nav ml-auto">
              <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
                  <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown"
                      aria-expanded="false">
                      <img class="img-xs rounded-circle" src="{{ url('assets/images/backend/faces/pengguna.png') }}"
                          alt="Profile image"> </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown"
                      style="padding-bottom: 1px;">
                      <div class="dropdown-header text-center">
                          <img class="img-md rounded-circle" src="{{ url('assets/images/backend/faces/pengguna.png') }}"
                              alt="Profile image">
                          <p class="mb-1 mt-3 font-weight-semibold">{{ Auth::user()->name }} |
                              {{ Auth::user()->roles }}</p>
                          <p class="font-weight-light text-muted mb-0">{{ Auth::user()->email }}</p>
                      </div>
                      <form action="{{ url('logout') }}" method="post">
                          @csrf
                          <button class="btn btn-sm btn-danger btn-block text-center" type="submit">Sign Out <span
                                  class="iconify" data-icon="fa:sign-out" data-width="19"
                                  data-height="19"></span></button>
                      </form>
                  </div>
              </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
              data-toggle="offcanvas">
              <span class="mdi mdi-menu"></span>
          </button>
      </div>
  </nav>
