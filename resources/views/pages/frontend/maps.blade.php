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
                        @auth
                        <li><a href="{{route('dashboard')}}"><i class="fa fa-users"></i> Dashboard</a></li>
                        <li>
                      <form action="{{ url('logout') }}" method="post" class="mt-1">
                        @csrf
                        <button class="btn btn-sm" type="submit">
                            <span
                            class="iconify" data-icon="fa:sign-out" data-width="20"
                            data-height="20" style="vertical-align: bottom; color:#fff;
                            "></span>
                        </button>
                    </form>
                        </li>
                      @endauth
                      @guest
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="fa fa-sign-in-alt"></i> Sign In</a></li>
                        @endguest
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
    <div id="btnmodalpeta"></div>
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



// Perbaikan pada script
var layer_density = new L.LayerGroup([]).addTo(map);
var densitymap; // Tambahkan deklarasi variabel densitymap di luar fungsi showMapDensity()
// var legend;

// Menambahkan kontrol warna menggunakan input range
// var colorInput = document.createElement('input');
// colorInput.type = 'range';
// colorInput.min = 0;
// colorInput.max = 100;
// colorInput.value = 50;
// colorInput.addEventListener('input', function(event) {
//     updateColors(event.target.value);
// });
function showMapDensity() {
    var tabel = document.getElementById("density").value;
    $.ajax({
        url: base_url + '/getGeoJSONData2/' + tabel,
        type: "get",
        data: {
            layer: tabel,
        },
        dataType: "json",
        success: function (data) {
            if (data) {
                layer_density.eachLayer(function (layer) {
                    map.removeLayer(layer);
                });

                // Tambahkan data GeoJSON sebagai layer vektor
                densitymap = L.geoJSON(data, {
                    style: function (feature) {
                        // var density = feature.properties.jumlah;
                        var fillColor = getColor(feature.properties.jumlah);
                        return {
                            fillColor: fillColor,
                            weight: 1,
                            opacity: 1,
                            color: 'white',
                            fillOpacity: 0.7
                        };
                    },
                    onEachFeature: function (feature, layer) {
                        // ... (kode lainnya tetap sama)
                        if (feature.properties) {
            var content =
                "<div class='table-responsive'><table class='table' style='margin-bottom:0; font-size:12px;'>" +
                "<tr><th style='width:40%;'>Kabupaten / Kota</th><td>" + feature.properties.kabkot +
                "</td></tr>" +
                "<tr><th style='width:40%;'>Provinsi</th><td>" + feature.properties.provinsi +
                "</td></tr>" +
                "<tr><th style='width:40%;'>Jumlah</th><td>" + feature.properties.jumlah + "</td></tr></table></div>";
            layer.on('click', function(e) {
                $("#drag_title_peta").html("DENSITY MAP");
                $("#feature-info").html(content);
                $("#btnmodalpeta").trigger("click");
            });
        }
                    }
                });

                layer_density.addLayer(densitymap);
            } else {
                layer_density.eachLayer(function (layer) {
                    map.removeLayer(layer);
                });
            }
        }
    });
}

function clearMapDensity() {
    layer_density.eachLayer(function (layer) {
        map.removeLayer(layer);
    });
}

function getColor(density) {
    if (density > 1000) {
        return '#800026';
    } else if (density > 500) {
        return '#BD0026';
    } else if (density > 100) {
        return '#E31A1C';
    } else if (density > 50) {
        return '#FC4E2A';
    } else if (density > 20) {
        return '#FD8D3C';
    } else if (density > 10) {
        return '#FEB24C';
    } else if (density > 5) {
        return '#FED976';
    } else if (density > 1) {
        return '#FFEDA0';
    } else if (density = 1) {
        return '#FEeeee';
    } else {
        return '#FFffff';
    }
}

// var baseCarto1 = L.tileLayer.provider('Stadia.AlidadeSmooth').addTo(map);
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
        var baseCarto1 = L.tileLayer.provider('CartoDB.Positron');
        var baseCarto2 = L.tileLayer.provider('CartoDB.DarkMatter').addTo(map);
        document.getElementById("pilihbasemap").addEventListener("change", function() {
            selected_value = $("input[name='card']:checked").val();
            if (selected_value == 'baseEsri') {
                baseEsri.addTo(map);
                baseOsm.remove();
                baseGoogle1.remove();
                baseGoogle2.remove();
                baseCarto1.remove();
                baseCarto2.remove();
            } else if (selected_value == 'baseCarto1') {
                baseCarto1.addTo(map);
                baseEsri.remove();
                baseOsm.remove();
                baseGoogle1.remove();
                baseGoogle2.remove();
                baseCarto2.remove();
            } else if (selected_value == 'baseOsm') {
                baseOsm.addTo(map);
                baseEsri.remove();
                baseGoogle1.remove();
                baseGoogle2.remove();
                baseCarto1.remove();
                baseCarto2.remove();
            } else if (selected_value == 'baseCarto2') {
                baseCarto2.addTo(map);
                baseEsri.remove();
                baseOsm.remove();
                baseGoogle1.remove();
                baseGoogle2.remove();
                baseCarto1.remove();
            } else if (selected_value == 'baseGoogle1') {
                baseGoogle1.addTo(map);
                baseEsri.remove();
                baseOsm.remove();
                baseGoogle2.remove();
                baseCarto1.remove();
                baseCarto2.remove();
            } else if (selected_value == 'baseGoogle2') {
                baseGoogle2.addTo(map);
                baseEsri.remove();
                baseOsm.remove();
                baseGoogle1.remove();
                baseCarto1.remove();
                baseCarto2.remove();
            }
        });

var datasettools = L.easyButton(
            '<span class="iconify" data-icon="carbon:heat-map" data-width="18" data-height="18"></span>',
            function OpenDataset() {
                var x = document.getElementById("menu-dataset");
                var y = document.getElementById("datasettools");
                if (x.style.display === "none") {
                    x.style.display = "block";
                    y.style.background = "#3a86d4";
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
        //  var legendtool = L.easyButton(
        //     '<span class="iconify" data-icon="material-symbols:list-alt-outline-rounded" data-width="18" data-height="18"></span>',
        //     function OpenLegend() {
        //         var x = document.getElementById("menu-legend");
        //         var y = document.getElementById("legendtools");
        //         if (x.style.display === "none") {
        //             x.style.display = "block";
        //             y.style.background = "#3a86d4";
        //             y.style.color = "#ffffff";
        //         } else {
        //             x.style.display = "none";
        //             y.style.background = "#ffffff";
        //             y.style.color = "#000000";
        //         }
        //     }, "Map Legend", 'bottomleft', 'legendtools').addTo(map);



      $('#draginfopeta').simpleDialog({
    opener: '#btnmodalpeta',
    closer: '#drag_close6',
    dragger: '#drag_title_peta'
  });

</script>
@endsection