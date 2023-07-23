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
        {{-- @include('includes.backend.script2') --}}
        @yield('addon-script')
    @endauth
</body>

</html>
