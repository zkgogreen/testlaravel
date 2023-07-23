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
                        <span style="background-color:#fff; border-radius:30px; opacity:0.7; padding:0.7rem!important">
                        <img src="{{ url('assets/images/kominfo-2.png') }}" alt="" style="margin-top:unset;">
                        
                    </span>
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a></li>
                        <li><a href="{{route('about')}}"><i class="fa fa-info-circle"></i> About</a></li>
                        <li><a href="{{route('maps')}}" class="active"><i class="fa fa-map"></i> Maps</a></li>
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
<section id="section-1">
<div id="map"></div>
</section>
@endsection

@section('addon-script')
@include('includes.frontend.tools')
<script>
    var map = L.map('map', {
   center: [-2.847297183146172, 116.7954945894402],
   zoom: 5,
   zoomControl: false,
   fullscreenControl: {
       pseudoFullscreen: true, // if true, fullscreen to page width and height
       position: 'bottomright',
   }
});

// var baseStadia1 = L.tileLayer.provider('Stadia.AlidadeSmooth').addTo(map);
var baseGoogle1 = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
            attribution: '&copy; <a href="https://geosis.id">GeoSIS Maps</a>'
        });
        var baseGoogle2 = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
            attribution: '&copy; <a href="https://geosis.id">GeoSIS Maps</a>'
        });
        var baseEsri = L.tileLayer.provider('Esri.WorldImagery');
        var baseOsm = L.tileLayer.provider('OpenStreetMap');
        var baseStadia1 = L.tileLayer.provider('Stadia.AlidadeSmooth');
        var baseStadia2 = L.tileLayer.provider('Stadia.AlidadeSmoothDark').addTo(map);
        document.getElementById("pilihbasemap").addEventListener("change", function() {
            selected_value = $("input[name='card']:checked").val();
            if (selected_value == 'baseEsri') {
                baseEsri.addTo(map);
                baseOsm.remove();
                baseGoogle1.remove();
                baseGoogle2.remove();
                baseStadia1.remove();
                baseStadia2.remove();
            } else if (selected_value == 'baseStadia1') {
                baseStadia1.addTo(map);
                baseEsri.remove();
                baseOsm.remove();
                baseGoogle1.remove();
                baseGoogle2.remove();
                baseStadia2.remove();
            } else if (selected_value == 'baseOsm') {
                baseOsm.addTo(map);
                baseEsri.remove();
                baseGoogle1.remove();
                baseGoogle2.remove();
                baseStadia1.remove();
                baseStadia2.remove();
            } else if (selected_value == 'baseStadia2') {
                baseStadia2.addTo(map);
                baseEsri.remove();
                baseOsm.remove();
                baseGoogle1.remove();
                baseGoogle2.remove();
                baseStadia1.remove();
            } else if (selected_value == 'baseGoogle1') {
                baseGoogle1.addTo(map);
                baseEsri.remove();
                baseOsm.remove();
                baseGoogle2.remove();
                baseStadia1.remove();
                baseStadia2.remove();
            } else if (selected_value == 'baseGoogle2') {
                baseGoogle2.addTo(map);
                baseEsri.remove();
                baseOsm.remove();
                baseGoogle1.remove();
                baseStadia1.remove();
                baseStadia2.remove();
            }
        });

var datasettools = L.easyButton(
            '<span class="iconify" data-icon="carbon:heat-map" data-width="18" data-height="18"></span>',
            function OpenDataset() {
                var x = document.getElementById("menu-dataset");
                var y = document.getElementById("datasettools");
                if (x.style.display === "none") {
                    x.style.display = "block";
                    y.style.background = "#538f91";
                    y.style.color = "#ffffff";
                } else {
                    x.style.display = "none";
                    y.style.background = "#ffffff";
                    y.style.color = "#000000";
                }
            }, "Layer Tools", 'topright', 'datasettools').addTo(map);

                  // zoom tools
        var zoomtool = L.control.zoom({
            position: 'bottomright'
        }).addTo(map);

        // zoom default tools
        var zoomdefaulttool = L.control.defaultExtent({
            position: 'bottomright'
        }).addTo(map);

             // coortinate tools
        var coordinate = L.control.coordProjection().addTo(map);

         // legend tools
         var legendtool = L.easyButton(
            '<span class="iconify" data-icon="material-symbols:list-alt-outline-rounded" data-width="18" data-height="18"></span>',
            function OpenLegend() {
                var x = document.getElementById("menu-legend");
                var y = document.getElementById("legendtools");
                if (x.style.display === "none") {
                    x.style.display = "block";
                    y.style.background = "#538f91";
                    y.style.color = "#ffffff";
                } else {
                    x.style.display = "none";
                    y.style.background = "#ffffff";
                    y.style.color = "#000000";
                }
            }, "Map Legend", 'bottomleft', 'legendtools').addTo(map);


</script>
@endsection