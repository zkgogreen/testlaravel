<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('assets/images/backend/kominfo.png') }}">
    <title>SIGAP-FBB | KOMINFO</title>
    <link href="{{ url('assets/vendor/bootstrap-2/css/bootstrap.min.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{url('assets/css/style.css') }}"> --}}
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ url('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/templatemo-woox-travel.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/animate.css') }}">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <script src="{{ url('assets/vendor/bootstrap-2/js/bootstrap.min.js') }}"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    
<style>
    /* body {
    background-color: #9DB2BF;
  } */
  .login-container {
    /* max-width: 420px; */
    margin: 0 auto;
    padding: 30px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    /* margin-top:13%; */
  }
  .login-container .logo {
    font-size: 40px;
    color: #007bff;
    margin-bottom: 20px;
    border: 2px solid #333;
padding: 5px;
border-radius: 5px;
  }
  .icon {
    color:#007bff;
  }
  .more-about {
    padding-bottom: 180px;
    padding-top: 150px;
  }
</style>
  </head>
<body>
    <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{route('home')}}" class="logo mt-3">
                        <img src="{{ url('assets/images/kominfo-1.png') }}" alt="">
                    </a>
                </nav>
            </div>
        </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->
@yield('content')
  </body>

</html>
