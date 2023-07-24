        <!-- partial:partials/_sidebar.html -->
        {{-- <div class="sidebar2 mt-3">

            <nav>
                <ul>
                  <li>
                    <div class="home-icon">
                      <div class="roof">
                        <div class="roof-edge"></div>
                      </div>
                      <div class="front"></div>
                    </div>
                  </li>
                  <li>
                    <div class="about-icon">
                      <div class="head">
                        <div class="eyes"></div>
                        <div class="beard"></div>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="work-icon">
                      <div class="paper"></div>
                      <div class="lines"></div>
                      <div class="lines"></div>
                      <div class="lines"></div>
                    </div>
                  </li>
                  <li>
                    <div class="mail-icon">
                      <div class="mail-base">
                        <div class="mail-top"></div>
                      </div>
                    </div>
                  </li>
                </ul>
              </nav>
    
            {{-- <div id="petacari"></div>
            <ul class="nav">
                <li class="nav-item p-3 {{ request()->is('dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="menu-icon typcn typcn-document-text"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item p-3">
                    <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                        aria-controls="ui-basic">
                        <i class="menu-icon typcn typcn-coffee"></i>
                        <span class="menu-title">Dataset</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse mt-2 p-3" id="ui-basic"
                        style="background: #fff;
                    border-radius: 7px;">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="#">Master Data</a>
                            </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="#">Layer Data</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="#">Configuration</a>
                                </li>
                        </ul>
                    </div>
                </li>

                @if (Auth::user()->roles == 'ADMIN')
                    <li class="nav-item p-3 ">
                        <a class="nav-link" href="{{ route('basisdata') }}">
                            <i class="menu-icon typcn typcn-user-outline"></i>
                            <span class="menu-title">Basis Data</span>
                        </a>
                    </li>
                @elseif (Auth::user()->roles == 'SUPER USER')
                    <li class="nav-item p-3 {{ request()->is('pengguna') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('pengguna') }}">
                            <i class="menu-icon typcn typcn-th-large-outline"></i>
                            <span class="menu-title">PENGGUNA</span>
                        </a>
                    </li>
                @else
                @endif
                <li class="nav-item p-3" id='logoutbtn'>
                    <form action="{{ url('logout') }}" method="post">
                        @csrf
                        <button class="nav-link btn btn-sm btn-danger btn-block text-center" type="submit">
                            <i class="menu-icon typcn typcn-user-outline"></i>
                            <span class="menu-title text-white text-center">SIGN OUT</span>
                        </button>
                    </form>
                </li>
            </ul> --}}
        {{-- </div> --}}



        <div class="container-sidebar">
            <a class="navbar-brand brand-logo-mini align-center" href="#" style="background-color: #fff;
            width: 100%;
            text-align: center;">
                <img src="{{ url('assets/images/kominfo-2.png') }}" alt="logo" style="height: 55px;"> </a>
<div class="userlogin p-2 mb-2" style="background-color:#ffffff; border-radius:4px;">
    <div class="row">
        <div class="col-md-9">
           <p class="font-weight-normal text-muted mb-0">Hallo, <span class="font-weight-bold">{{ Auth::user()->name }}</span></p>
            <small class="fst-italic">{{ Auth::user()->email }} |  {{ Auth::user()->roles }} </small>
        </div>
        <div class="col-md-3">
                   <form action="{{ url('logout') }}" method="post" class="mt-1">
                    @csrf
                    <button class="btn btn-sm" type="submit">
                        <span
                        class="iconify" data-icon="fa:sign-out" data-width="20"
                        data-height="20" style="vertical-align: bottom;
                        "></span>
                    </button>
                </form>
        </div>
    </div>
        </div>
            <nav>
                    <ul class="mcd-menu">
                        <li>
                            <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                                <span class="iconify icon-menu" data-icon="material-symbols:dashboard" data-width="20" data-height="20"></span>
                                <strong>Dashboard</strong>
                                <small>Map & resume</small>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dataset')}}" class="{{ request()->is('dataset*') ? 'active' : '' }}">
                                <span class="iconify icon-menu" data-icon="carbon:data-volume" data-width="20" data-height="20"></span>
                                <strong>Dataset</strong>
                                <small>Create Data & Table</small>
                            </a>
                        </li>
                        {{-- @if (Auth::user()->roles == 'ADMIN')
                        <li>
                            <a href="#" class="{{ request()->is('content*') ? 'active' : '' }}">
                                <span class="iconify icon-menu" data-icon="fluent:content-settings-24-regular" data-width="20" data-height="20"></span>
                                <strong>Content Management</strong>
                                <small>Configuration 6extual content</small>
                            </a>
                        </li> --}}
                        @if (Auth::user()->roles == 'SUPER USER')
                        <li>
                            <a href="{{ route('user-management') }}" class="{{ request()->is('user*') ? 'active' : '' }}">
                                <span class="iconify icon-menu" data-icon="fa-solid:user-cog" data-width="20" data-height="20"></span>
                                <strong>User Management</strong>
                                <small>configuration all user</small>
                            </a>
                        </li>                 
                        @else
                        @endif
                        <li>
                            <a href="">
                                <span class="iconify icon-menu" data-icon="bx:file" data-width="20" data-height="20"></span>
                                <strong>User Guide</strong>
                                <small>How to use sigap-fbb</small>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('privacy') }}" class="{{ request()->is('privacy') ? 'active' : '' }}">
                                <span class="iconify icon-menu" data-icon="ic:baseline-privacy-tip" data-width="20" data-height="20"></span>
                                <strong>Privacy Policy</strong>
                                <small>-</small>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('toc') }}" class="{{ request()->is('toc') ? 'active' : '' }}">
                                <span class="iconify icon-menu" data-icon="carbon:rule-filled" data-width="20" data-height="20"></span>
                                <strong>Term & Condition</strong>
                                <small>-</small>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>