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
                        <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="{{route('about')}}" class="active"><i class="fa fa-info-circle"></i> About</a></li>
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
<div class="more-about" style="background:url('{{ url('assets/images/kominfo.jpg') }}') no-repeat center center; background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 align-self-center">
                <div class="left-image">
                    {{-- <img src="{{ url('assets/images/south-east-asia-density-map-full.jpg') }}" alt=""> --}}
                    {{-- style="background:url('{{ url('assets/images/south-east-asia-density-map-full.jpg') }}') no-repeat center center;" --}}
                </div>
            </div>
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2>
                        @foreach ($content as $item)
                            @if($item->section === 'About Title')
                                {{$item->title}}
                            @endif
                        @endforeach
                    </h2>
                    <p>
                        @foreach ($content as $item)
                            @if($item->section === 'About Title')
                                {{$item->description}}
                            @endif
                        @endforeach
                    </p>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="info-item">
                            <h4>{{$content_count1}}</h4>
                            <span>
                              @foreach ($content as $item)
                              @if($item->section === 'About Counter 1')
                                  {{$item->title}}
                              @endif
                          @endforeach
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="info-item">
                            <h4>{{$content_count2}}</h4>
                            <span>
                              @foreach ($content as $item)
                              @if($item->section === 'About Counter 2')
                                  {{$item->title}}
                              @endif
                          @endforeach
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="info-item">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4> {{$content_count3}}</h4>
                                    <span>
                                        @foreach ($content as $item)
                                        @if($item->section === 'About Counter 3')
                                            {{$item->title}}
                                        @endif
                                    @endforeach
                                    </span>
                                </div>
                                <div class="col-lg-6">
                                    <h4>
                                        {{$content_count4}}
                                    </h4>
                                    <span>
                                        @foreach ($content as $item)
                                            @if($item->section === 'About Counter 4')
                                                {{$item->title}}
                                            @endif
                                        @endforeach
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="text-justify p-3 page-text-bg">
                    @foreach ($content as $item)
                        @if($item->section === 'About Desc')
                            {{$item->description}}
                        @endif
                    @endforeach
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
