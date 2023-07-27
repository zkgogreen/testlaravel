@extends('layouts.admin')

@push('addon-header')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold" style="font-size: 13px;">
                                            @foreach ($content as $item)
                                            @if($item->section === 'Dashboard Counter 1')
                                                {{$item->title}}
                                            @endif
                                        @endforeach
                                        </p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{number_format($content_count1)}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-primary shadow text-center border-radius-md">
                                        <!--  <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i> -->
                                        <i class="fa fa-location-arrow" aria-hidden="true"></i>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold" style="font-size: 13px;">
                                            @foreach ($content as $item)
                                            @if($item->section === 'Dashboard Counter 2')
                                                {{$item->title}}
                                            @endif
                                        @endforeach
                                        </p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{number_format($content_count2)}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-primary shadow text-center border-radius-md">
                                        <i class="fa fa-map" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold" style="font-size: 13px;">
                                            @foreach ($content as $item)
                                            @if($item->section === 'Dashboard Counter 3')
                                                {{$item->title}}
                                            @endif
                                        @endforeach
                                        </p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{number_format($content_count3)}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-primary shadow text-center border-radius-md">
                                        <i class="fa fa-users" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold" style="font-size: 13px;">
                                            @foreach ($content as $item)
                                            @if($item->section === 'Dashboard Counter 4')
                                                {{$item->title}}
                                            @endif
                                        @endforeach
                                        </p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{number_format($content_count4)}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-primary shadow text-center border-radius-md">
                                        <i class="fa fa-map-pin" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endpush

@section('content')
    <div class="row d-flex mb-2">
        <div class="col-md-12">
            @include('includes.backend.tools')
            <div class="card">
                <div id="btnmodalpeta"></div>
                {{-- <div class="card-body"> --}}
                <div id="map" class="map"></div>
                <div class="overlay"></div>
                {{-- <div id="legend" class="leaflet-control"></div> --}}
                @if (Auth::user()->roles == 'ADMIN')
                    @include('includes.backend.map')
                @else
                    @include('includes.backend.map2')
                @endif
                {{-- </div> --}}
            </div>
        </div>

    </div>
    @endsection

    @section('addon-modal')
                                      {{-- start popup info peta --}}
{{-- 
                                      <div id="draginfopeta" class="dialog" style="width: 350px;">
                                        <h3 id="drag_title_peta" class="p-2 mb-0"></h3>
                                          <div class="card-body" id="feature-info" style="height:150px; overflow:auto;">
                                      </div>
                                     <button type="button" id="drag_close6" class="btn btn-sm btn-outline-dark mx-2 float-right mb-2">Close</button>
                                      </div> --}}
                                    
                                      {{-- end popup info peta  --}}
    @endsection

@section('addon-script')
<script>
      $('#draginfopeta').simpleDialog({
    opener: '#btnmodalpeta',
    closer: '#drag_close6',
    dragger: '#drag_title_peta'
  });
</script>
<script>

        // jQuery(document).ready(function() {
        //     jQuery('select[name="provinsi"]').on('change', function() {
        //         var provID = jQuery(this).val();
        //         if (provID) {
        //             jQuery.ajax({
        //                 url: 'dropdownlist/getkabkot/' + provID,
        //                 type: "GET",
        //                 dataType: "json",
        //                 success: function(data) {
        //                     console.log(data);
        //                     jQuery('select[name="kabkot"]').empty();
        //                     $('select[name="kabkot"]').append(
        //                         '<option value="piilhkabkot" selected>Pilih Semua Kab/Kota</option>'
        //                     );
        //                     jQuery.each(data, function(key, value) {
        //                         $('select[name="kabkot"]').append('<option value="' +
        //                             key + '">' + value + '</option>');
        //                     });
        //                 }
        //             });
        //         } else {
        //             $('select[name="kabkot"]').empty();
        //         }
        //     });
        // });

        // jQuery(document).ready(function() {
        //     jQuery('select[name="kabkot"]').on('change', function() {
        //         var kabkotID = jQuery(this).val();
        //         if (kabkotID) {
        //             jQuery.ajax({
        //                 url: 'dropdownlist/getkecamatan/' + kabkotID,
        //                 type: "GET",
        //                 dataType: "json",
        //                 success: function(data) {
        //                     console.log(data);
        //                     jQuery('select[name="kecamatan"]').empty();
        //                     $('select[name="kecamatan"]').append(
        //                         '<option value="piilhkecamatan" selected>Pilih Semua Kecamatan</option>'
        //                     );
        //                     jQuery.each(data, function(key, value) {
        //                         $('select[name="kecamatan"]').append('<option value="' +
        //                             key + '">' + value + '</option>');
        //                     });
        //                 }
        //             });
        //         } else {
        //             $('select[name="kecamatan"]').empty();
        //         }
        //     });
        // });

        // jQuery(document).ready(function() {
        //     jQuery('select[name="kecamatan"]').on('change', function() {
        //         var kecamatanID = jQuery(this).val();
        //         if (kecamatanID) {
        //             jQuery.ajax({
        //                 url: 'dropdownlist/getkelurahan/' + kecamatanID,
        //                 type: "GET",
        //                 dataType: "json",
        //                 success: function(data) {
        //                     console.log(data);
        //                     jQuery('select[name="kelurahan"]').empty();
        //                     $('select[name="kelurahan"]').append(
        //                         '<option value="piilhkelurahan" selected>Pilih Semua Kelurahan</option>'
        //                     );
        //                     jQuery.each(data, function(key, value) {
        //                         $('select[name="kelurahan"]').append('<option value="' +
        //                             key + '">' + value + '</option>');
        //                     });
        //                 }
        //             });
        //         } else {
        //             $('select[name="kelurahan"]').empty();
        //         }
        //     });
        // });

    </script>
@endsection
