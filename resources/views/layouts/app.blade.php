<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('assets/images/backend/kominfo.png') }}">
    <title>SIGAP-FBB | KOMINFO</title>
@include('includes.frontend.style')
  </head>

<body>

 @include('includes.frontend.loader')

 @yield('navbar')

  @yield('content')
@include('includes.frontend.script')
@include('includes.frontend.modal')
@yield('addon-script')

  </body>

</html>
