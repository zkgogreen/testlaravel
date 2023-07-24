@extends('layouts.app')

@section('navbar')
    
  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{route('home')}}" class="logo mt-3">
                        <img src="{{ url('assets/images/kominfo-1.png') }}" alt="">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="{{route('home')}}" class="active"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="{{route('about')}}"><i class="fa fa-info-circle"></i> About</a></li>
                        <li><a href="{{route('maps')}}"><i class="fa fa-map"></i> Maps</a></li>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="fa fa-sign-in-alt"></i> Sign In</a></li>
                    </ul>   
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->
@endsection

@section('content')
    <!-- ***** Main Banner Area Start ***** -->
  <section id="section-1">
    <div class="content-slider">
      <input type="radio" id="banner1" class="sec-1-input" name="banner" checked>
      <input type="radio" id="banner2" class="sec-1-input" name="banner">
      <input type="radio" id="banner3" class="sec-1-input" name="banner">
      <input type="radio" id="banner4" class="sec-1-input" name="banner">
      <div class="slider">
        <div id="top-banner-1" class="banner">
          <div class="banner-inner-wrapper header-text">
            <div class="main-caption">
              <h1>
                @foreach ($content as $item)
                @if($item->section === 'Home Slide 1')
            {{$item->title}}
                @endif
                @endforeach
              </h1>
              <div class="row">
                <div class="col-12">
                  <h2 class="m-3">
                    @foreach ($content as $item)
                    @if($item->section === 'Home Slide 1')
                {{$item->description}}
                    @endif
                    @endforeach
                  </h2>
                </div>
              </div>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                  <div class="more-info">
                    <div class="row">
                      <div class="col-lg-3 col-sm-6 col-6">
                        <i class="fa fa-1"></i>
                        <h4><span>
                          @foreach ($content as $item)
                          @if($item->section === 'Home Counter 1')
                      {{$item->title}}
                          @endif
                          @endforeach
                        </span><br>38</h4>
                      </div>
                      <div class="col-lg-3 col-sm-6 col-6">
                        <i class="fa fa-2"></i>
                        <h4><span>
                          @foreach ($content as $item)
                          @if($item->section === 'Home Counter 2')
                      {{$item->title}}
                          @endif
                          @endforeach
                          </span><br>514</h4>
                      </div>
                      <div class="col-lg-3 col-sm-6 col-6">
                        <i class="fa fa-3"></i>
                        <h4><span>
                          @foreach ($content as $item)
                          @if($item->section === 'Home Counter 3')
                      {{$item->title}}
                          @endif
                          @endforeach
                          </span><br>83,467</h4>
                      </div>
                      <div class="col-lg-3 col-sm-6 col-6">
                        <div class="main-button">
                          <a href="{{ url('maps')}}">Explore Map</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="top-banner-2" class="banner">
          <div class="banner-inner-wrapper header-text">
            <div class="main-caption">
              <h1>
                @foreach ($content as $item)
                @if($item->section === 'Home Slide 2')
            {{$item->title}}
                @endif
                @endforeach
              </h1>
              <div class="row">
                <div class="col-12">
                  <h2 class="mx-3">
                    @foreach ($content as $item)
                    @if($item->section === 'Home Slide 2')
                {{$item->description}}
                    @endif
                    @endforeach
                    </h2>
                </div>
              </div>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                  <div class="more-info">
                    <div class="row">
                      <div class="col-lg-3 col-sm-6 col-6">
                        <i class="fa fa-1"></i>
                        <h4><span>
                          @foreach ($content as $item)
                          @if($item->section === 'Home Counter 1')
                      {{$item->title}}
                          @endif
                          @endforeach
                        </span><br>38</h4>
                      </div>
                      <div class="col-lg-3 col-sm-6 col-6">
                        <i class="fa fa-2"></i>
                        <h4><span>
                          @foreach ($content as $item)
                          @if($item->section === 'Home Counter 2')
                      {{$item->title}}
                          @endif
                          @endforeach
                          </span><br>514</h4>
                      </div>
                      <div class="col-lg-3 col-sm-6 col-6">
                        <i class="fa fa-3"></i>
                        <h4><span>
                          @foreach ($content as $item)
                          @if($item->section === 'Home Counter 3')
                      {{$item->title}}
                          @endif
                          @endforeach
                          </span><br>83,467</h4>
                      </div>
                      <div class="col-lg-3 col-sm-6 col-6">
                        <div class="main-button">
                          <a href="{{ url('maps')}}">Explore Map</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="top-banner-3" class="banner">
          <div class="banner-inner-wrapper header-text">
            <div class="main-caption">
              <h1>
                @foreach ($content as $item)
                @if($item->section === 'Home Slide 3')
            {{$item->title}}
                @endif
                @endforeach
              </h1>
              <div class="row">
                <div class="col-12">
              <h2 class="mx-3">
                @foreach ($content as $item)
                @if($item->section === 'Home Slide 3')
            {{$item->description}}
                @endif
                @endforeach
              </h2>
                </div>
              </div>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                  <div class="more-info">
                    <div class="row">
                      <div class="col-lg-3 col-sm-6 col-6">
                        <i class="fa fa-1"></i>
                        <h4><span>
                          @foreach ($content as $item)
                          @if($item->section === 'Home Counter 1')
                      {{$item->title}}
                          @endif
                          @endforeach
                        </span><br>38</h4>
                      </div>
                      <div class="col-lg-3 col-sm-6 col-6">
                        <i class="fa fa-2"></i>
                        <h4><span>
                          @foreach ($content as $item)
                          @if($item->section === 'Home Counter 2')
                      {{$item->title}}
                          @endif
                          @endforeach
                          </span><br>514</h4>
                      </div>
                      <div class="col-lg-3 col-sm-6 col-6">
                        <i class="fa fa-3"></i>
                        <h4><span>
                          @foreach ($content as $item)
                          @if($item->section === 'Home Counter 3')
                      {{$item->title}}
                          @endif
                          @endforeach
                          </span><br>83,467</h4>
                      </div>
                      <div class="col-lg-3 col-sm-6 col-6">
                        <div class="main-button">
                          <a href="{{ url('maps')}}">Explore Map</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="top-banner-4" class="banner">
          <div class="banner-inner-wrapper header-text">
            <div class="main-caption">
              <h1>
                @foreach ($content as $item)
                @if($item->section === 'Home Slide 4')
            {{$item->title}}
                @endif
                @endforeach
              </h1>
              <div class="row">
                <div class="col-12">
              <h2 class="mx-3">
                @foreach ($content as $item)
                @if($item->section === 'Home Slide 3')
            {{$item->description}}
                @endif
                @endforeach
              </h2>
                </div>
              </div>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                  <div class="more-info">
                    <div class="row">
                      <div class="col-lg-3 col-sm-6 col-6">
                        <i class="fa fa-1"></i>
                        <h4><span>
                          @foreach ($content as $item)
                          @if($item->section === 'Home Counter 1')
                      {{$item->title}}
                          @endif
                          @endforeach
                        </span><br>38</h4>
                      </div>
                      <div class="col-lg-3 col-sm-6 col-6">
                        <i class="fa fa-2"></i>
                        <h4><span>
                          @foreach ($content as $item)
                          @if($item->section === 'Home Counter 2')
                      {{$item->title}}
                          @endif
                          @endforeach
                          </span><br>514</h4>
                      </div>
                      <div class="col-lg-3 col-sm-6 col-6">
                        <i class="fa fa-3"></i>
                        <h4><span>
                          @foreach ($content as $item)
                          @if($item->section === 'Home Counter 3')
                      {{$item->title}}
                          @endif
                          @endforeach
                          </span><br>83,467</h4>
                      </div>
                      <div class="col-lg-3 col-sm-6 col-6">
                        <div class="main-button">
                          <a href="{{ url('maps')}}">Explore Map</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="controls">
          <label for="banner1"><span class="progressbar"><span class="progressbar-fill"></span></span><span class="text">1</span></label>
          <label for="banner2"><span class="progressbar"><span class="progressbar-fill"></span></span><span class="text">2</span></label>
          <label for="banner3"><span class="progressbar"><span class="progressbar-fill"></span></span><span class="text">3</span></label>
          <label for="banner4"><span class="progressbar"><span class="progressbar-fill"></span></span><span class="text">4</span></label>
        </div>
      </nav>
    </div>
  </section>
  <!-- ***** Main Banner Area End ***** -->
@endsection