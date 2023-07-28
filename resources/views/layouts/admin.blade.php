<!DOCTYPE html>
<html lang="en">
    {{-- Access-Control-Allow-Origin: http://localhost:8080/geoserver/* --}}
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ Session::token() }}">
    <title>SIGAP-FBB | KOMINFO</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('assets/images/backend/kominfo.png') }}">
    <!-- plugins:css -->
    @include('includes.backend.style')
    @yield('addon-style')
    @include('includes.backend.script')
</head>

<body>
    @auth
        <div class="container-scroller p-3">
            {{-- @include('includes.backend.navbar') --}}
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">

                @include('includes.backend.sidebar')
                <!-- partial -->
                <div class="main-panel">
                    <div id="mobilenav" style="display: none;">
                        <div class="row mx-0">
                            <div class="col-md-12" style="display: flex;
                            background-color: #fff;">
                        <a class="navbar-brand brand-logo-mini align-center" href="#" style="background-color: #fff;
                        width: 100%;
                        text-align: center;">
                            <img src="{{ url('assets/images/kominfo-2.png') }}" alt="logo" style="height: 55px;"> </a>
                            <form action="{{ url('logout') }}" method="post" class="mt-2">
                                @csrf
                                <button class="btn btn-sm" type="submit">
                                    <span
                                    class="iconify" data-icon="fa:sign-out" data-width="20"
                                    data-height="20" style="vertical-align: bottom;
                                    "></span>
                                </button>
                            </form>
                        </div>
                        {{-- <div class="col-md-4">
                
                        </div> --}}
                        </div>
                    <nav>
                        <ul class="mcd-menu">
                            <li>
                                <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                                    <span class="iconify icon-menu" data-icon="material-symbols:dashboard" data-width="20" data-height="20"></span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('dataset')}}" class="{{ request()->is('dataset*') ? 'active' : '' }}">
                                    <span class="iconify icon-menu" data-icon="carbon:data-volume" data-width="20" data-height="20"></span>
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
                                </a>
                            </li>                 
                            @else
                            @endif
                            <li>
                                <a href="">
                                    <span class="iconify icon-menu" data-icon="bx:file" data-width="20" data-height="20"></span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('privacy') }}" class="{{ request()->is('privacy') ? 'active' : '' }}">
                                    <span class="iconify icon-menu" data-icon="ic:baseline-privacy-tip" data-width="20" data-height="20"></span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('toc') }}" class="{{ request()->is('toc') ? 'active' : '' }}">
                                    <span class="iconify icon-menu" data-icon="carbon:rule-filled" data-width="20" data-height="20"></span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    </div>
                    <div class="content-wrapper">
                        <!-- Page Title Header Starts-->

                        {{-- @include('includes.header') --}}
                        @stack('addon-header')
                        @include('includes.backend.alert')
                        @yield('addon-modal')
                        @yield('content')
                        <!-- end -->
                    </div>
                    <!-- content-wrapper ends -->
                    {{-- @include('includes.backend.footer') --}}
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        @include('includes.backend.modal')
        @yield('addon-script')
    @endauth
</body>

</html>
