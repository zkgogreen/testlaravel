 <script type="text/javascript">
      var GABUNG2 = new L.LayerGroup();
      var items = [];

      var url ='http://localhost:8080';
      map = L.map('map', {}).setView([0.539731, 118.7240573], 4);


      //   var geojsonStyle = {
      //       fillColor: "#ff0000",
      //       color: "#000",
      //       weight: 1,
      //       opacity: 1,
      //       fillOpacity: 0.7,
      //   };

      //   var options = {
      //       maxZoom: 20,
      //       tolerance: 3,
      //       debug: 0,
      //       style: geojsonStyle
      //   };
      //   var layer_podes20 = L.geoJson.vt(dataspd, options);

      var layer_spd = new L.GeoJSON.AJAX("{{ 'assets/layer/request_layer_spd.php' }}", {
          style: function(
              feature) { // PEWARNAAN OBJEK POLYGON DIAMBIL DARI FIELD "color" PADA FILE GEOJSON geojson
              return {
                  color: "#000",
                  weight: 1,
                  fillColor: '#ffde17',
                  fillOpacity: 0.6
              }; // Berikan efek trasparan pada bagian "fillOpacity" agar basemap dapat terlihat
          },
          onEachFeature: function(feature, layer) {
              items.push(
                  layer
              ); // ini dibuat untuk menghubungkan variabel items ke dalam layer, ini berfungsi untuk menjalankan tool pencarian
              if (feature.properties) {
                  var content =
                      "<div class='table-responsive'><table class='table' style='margin-bottom:0; font-size:12px;'>" +
                      "<tr><th style='width:30%;'>Desa / Kelurahan</th><td>" + feature.properties.keldes +
                      "</td></tr>" +
                      "<tr><th style='width:30%;'>Kecamatan</th><td>" + feature.properties.kecamatan +
                      "</td></tr>" +
                      "<tr><th style='width:30%;'>Kabupaten / Kota</th><td>" + feature.properties.kabkot +
                      "</td></tr>" +
                      "<tr><th style='width:30%;'>Provinsi</th><td>" + feature.properties.provinsi +
                      "</td></tr>" +
                      "<tr><th style='width:30%;'>Kode Desa</th><td>" + feature.properties.kode_bps +
                      "</td></tr>" +
                      "<tr><th style='width:30%;'>Jumlah Penduduk</th><td>" + feature.properties
                      .jumlah_penduduk + "</td></tr>" +
                      "<tr><th style='width:30%;'>Jumlah KK</th><td>" + feature.properties.jumlah_kk +
                      "</td></tr>" +
                      "<tr><th style='width:30%;'>Jumlah UMKM</th><td>" + feature.properties.jumlah_umkm +
                      "</td></tr>" +
                      "<tr><th style='width:30%;'>Jenis UMKM</th><td>" + feature.properties.jenis_umkm +
                      "</td></tr>" +
                      "<tr><th style='width:30%;'>Mata Pencaharian Penduduk</th><td>" + feature.properties
                      .pencaharian + "</td></tr>" +
                      "<tr><th style='width:30%;'>Pendapatan Penduduk</th><td>" + feature.properties
                      .pendapatan + "</td></tr>" +
                      "<tr><th style='width:30%;'>Potensi Desa</th><td>" + feature.properties.potensi +
                      "</td></tr></table></div>" +
                      "<div class='wrapper center-block'> <div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'> <div class='panel panel-default'> <div class='panel-heading active' role='tab' id='headingOne'> <h4 class='panel-title'> <a role='button' data-toggle='collapse' data-parent='#accordion' href='#collapseOne' aria-expanded='false' aria-controls='collapseOne'> DOKUMENTASI </a> </h4> </div> <div id='collapseOne' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'> <div class='panel-body'> <div class='slideshow nowslide'> <div class='sliderdok'> <input type='radio' name='radio' id='radio1' checked> <input type='radio' name='radio' id='radio2'> <input type='radio' name='radio' id='radio3'> <input type='radio' name='radio' id='radio4'> <input type='radio' name='radio' id='radio5'> <div class='slidedok sh1'> <iframe src='" +
                      feature.properties.foto1 +
                      "preview' width='100%'></iframe> </div> <div class='slidedok'> <iframe src='" + feature
                      .properties.foto2 +
                      "preview' width='100%'></iframe> </div> <div class='slidedok'> <iframe src='" + feature
                      .properties.foto3 +
                      "preview' width='100%'></iframe> </div> <div class='slidedok'> <iframe src='" + feature
                      .properties.foto4 +
                      "preview' width='100%'></iframe> </div> <div class='slidedok'> <iframe src='" + feature
                      .properties.foto5 +
                      "preview' width='100%'></iframe> </div> </div> <div class='navslider'> <label for='radio1' class='barslider'></label> <label for='radio2' class='barslider'></label> <label for='radio3' class='barslider'></label> <label for='radio4' class='barslider'></label> <label for='radio5' class='barslider'></label> </div> </div> </div> </div> </div></div></div>";
                  layer.on('click', function(e) {
                      $("#drag_title_peta").html("SURVEY POTENSI DESA");
                      $("#feature-info").html(content);
                    $("#btnmodalpeta").trigger("click");
                  });
              }
              layer.on({
                  mouseover: function(e) {
                      var layer = e.target;
                      layer.setStyle({
                          weight: 1,
                          color: '#000',
                          dashArray: '',
                          fillColor: "#ff0000",
                          fillOpacity: 0.8
                      });
                      if (!L.Browser.ie && !L.Browser.opera) {
                          layer.bringToFront();
                      }
                  },
                  mouseout: function(e) {
                      layer_spd.resetStyle(e.target);
                  }
              });
          }
      });


    //   var layer_kabkot = new L.GeoJSON.AJAX("{{ 'assets/layer/request_layer_kabkot.php' }}", {
    //       style: function(
    //           feature) { // PEWARNAAN OBJEK POLYGON DIAMBIL DARI FIELD "color" PADA FILE GEOJSON geojson
    //           return {
    //               color: "#000",
    //               weight: 1,
    //               fillColor: '#ffde17',
    //               fillOpacity: 0.6
    //           }; // Berikan efek trasparan pada bagian "fillOpacity" agar basemap dapat terlihat
    //       }
    //   });

//     var yellowToRed = new L.HSLHueFunction(new L.Point(50, 60), new L.Point(100, 0));
// // var data = "{{ 'assets/layer/request_layer_kabkot.php' }}";
//     var layer = new L.ChoroplethDataLayer(datajakarta, {
//     // For the full options, see the documentation
//     displayOptions: {
//         // The display will be colored by your 'density' property in your GeoJSON. This accesses the feature object directory, so the 'properties' prefix is required if you're going to access a GeoJSON property on your data.
//         'properties.id_kab': {
//             // A legend will automatically be generated for you. You can add this as a control. This displayName property will be the title for this layer's legend.
//             displayName: 'Density',
//             color: yellowToRed
//         }
//     }
// }).addTo(map);


            // fetch("{{ 'assets/layer/request_layer_kabkot.php'}}")
            // .then(response => response.json())
            // .then(data => {
            //     // Buat dan tambahkan visualisasi density dengan DVF
            //     L.dvf.shape(data, {
            //         gradient: { 0.4: 'blue', 0.65: 'lime', 1: 'red' }
            //     }).addTo(map);
            // });
// var density = 

var layer_density = new L.LayerGroup([]).addTo(map);
var densitymap; // Tambahkan deklarasi variabel densitymap di luar fungsi showMapDensity()

var legend;
// Menambahkan kontrol warna menggunakan input range
var colorInput = document.createElement('input');
    colorInput.type = 'range';
    colorInput.min = 0;
    colorInput.max = 100;
    colorInput.value = 70;
    colorInput.addEventListener('input', function (event) {
      updateColors(event.target.value);
    });

        // Ambil data GeoJSON dari Laravel
function showMapDensity(){
var tabel = document.getElementById("density").value;
    $.ajax({
    url: base_url + '/getGeoJSONData/' + tabel,
    type: "get",
    data: {
    layer: tabel,
    },
    dataType: "json",
success: function(data) {
    if(data){
        layer_density.eachLayer(function (layer) {
        map.removeLayer(layer);
        });
                if (legend) {
                    legend.remove(map);
                }
        // Tambahkan data GeoJSON sebagai layer vektor
        densitymap = L.geoJSON(data, {
            style: function(feature) {
                        var density = feature.properties.jumlah;
                        var fillColor = getColor(density, colorInput.value);
                        return {
                            fillColor: fillColor,
                            weight: 1,
                            opacity: 1,
                            color: 'white',
                            fillOpacity: 0.7
                        };
                    },
            onEachFeature: function(feature, layer) {
        items.push(
            layer
        ); // ini dibuat untuk menghubungkan variabel items ke dalam layer, ini berfungsi untuk menjalankan tool pencarian
        if (feature.properties) {
            var content =
                "<div class='table-responsive'><table class='table' style='margin-bottom:0; font-size:12px;'>" +
                "<tr><th style='width:30%;'>Kabupaten / Kota</th><td>" + feature.properties.kabkot +
                "</td></tr>" +
                "<tr><th style='width:30%;'>Provinsi</th><td>" + feature.properties.provinsi +
                "</td></tr>" +
                "<tr><th style='width:30%;'>Jumlah</th><td>" + feature.properties.jumlah + "</td></tr></table></div>";
            layer.on('click', function(e) {
                $("#drag_title_peta").html("DENSITY MAP");
                $("#feature-info").html(content);
                $("#btnmodalpeta").trigger("click");
            });
        }
        layer.on({
            mouseover: function(e) {
                var layer = e.target;
                layer.setStyle({
                    weight: 1,
                    color: '#000',
                    dashArray: '',
                    fillColor: "#ff0000",
                    fillOpacity: 0.8
                });
                if (!L.Browser.ie && !L.Browser.opera) {
                    layer.bringToFront();
                }
            },
            mouseout: function(e) {
                densitymap.resetStyle(e.target);
            }
        });
    }
        });
        layer_density.addLayer(densitymap); 

     // Menambahkan kontrol warna ke peta
     var legend = L.control({ position: 'bottomright' });
        legend.onAdd = function (map) {
          var div = L.DomUtil.create('div', 'info legend');
          div.innerHTML = '<strong>Density Scale:</strong> <br> Low <input type="range" min="0" max="100" value="70" id="density-scale"> High';
          L.DomEvent.disableClickPropagation(div);
          return div;
        };
        legend.addTo(map);

        // Memanggil fungsi updateColors() untuk inisialisasi
        // updateColors(colorInput.value);
            // Perbaiki fungsi updateColors() untuk mengakses densitymap
            function updateColors(scale) {
                    densitymap.eachLayer(function(layer) {
                        var density = layer.feature.properties.jumlah;
                        var fillColor = getColor(density, scale);
                        layer.setStyle({ fillColor: fillColor });
                    });
                }

    } else {
        // densitymap.remove(map);
        layer_density.eachLayer(function (layer) {
map.removeLayer(layer);
        });
            if (legend) {
                    legend.remove(map);
                }
    }
}
});
}

    function clearMapDensity(){
    layer_density.eachLayer(function (layer) {
    map.removeLayer(layer);
});
if (legend) {
        legend.remove(map);
    }
    }

    // Fungsi untuk menentukan warna fill berdasarkan nilai density dan skala warna pengguna
    function getColor(density, scale) {
      // Menghitung persentase berdasarkan range jumlah penduduk tertinggi
      var maxDensity = 2; // Ganti dengan jumlah penduduk tertinggi dalam data Anda
      var percentage = density / maxDensity * 100;

      // Mendapatkan nilai opacity berdasarkan skala pengguna
      var opacity = scale / 100;

      // Mendapatkan nilai warna fill berdasarkan persentase dan skala opacity
      var color = 'rgba(255, 0, 0, ' + opacity + ')'; // Ganti dengan warna yang Anda inginkan

      return percentage > scale ? color : 'transparent';
    }

    // Memperbarui warna setiap feature pada peta berdasarkan input pengguna
    // function updateColors(scale) {
    //   densitymap.eachLayer(function (layer) {
    //     var density = layer.feature.properties.jumlah;
    //     var fillColor = getColor(density, scale);
    //     layer.setStyle({ fillColor: fillColor });
    //   });
    // }

        //     .catch(error => console.error('Error:', error));
        // }
//     var options = {
//   maxZoom: 16,
//   tolerance: 3,
//   debug: 0,
//   style: {
//     fillColor: "#1EB300",
//     color: "#F2FF00",
//   },
// };
// var data = "{{ 'assets/layer/request_layer_kabkot.php' }}";
// // var layer_kabkot = L.geoJson.vt(data, options);

// // Set vectorTileOptions
// var vectorTileOptions = {
// vectorTileLayerStyles: {
// 'tb_kabkot': function() {
// return {
//   color: 'red',
//   opacity: 1,
//   fillColor: 'yellow',
//   fill: true,
// }
// },
// },
// interactive: true,	// Make sure that this VectorGrid fires mouse/pointer events
// }

// // Set the coordinate system
// var projection_epsg_no = '4326';
// // Set the variable for storing the workspace:layername
// var campground_geoserverlayer = 'sigap-fbb:tb_kabkot';
// // Creating the full vectorTile url
// // var campingURL = "https://api.maptiler.com/tiles/contours/{z}/{x}/{y}.pbf?key=h9tVkWq5EM7uqjG55jUg";
// var campingURL = url + '/geoserver/gwc/service/tms/1.0.0/' + campground_geoserverlayer + '@EPSG%3A' + projection_epsg_no + '@pbf/{z}/{x}/{-y}.pbf';
// // Creating the Leaflet vectorGrid object
// var camping_vectorgrid = L.vectorGrid.protobuf(campingURL, vectorTileOptions)

// // Define the action taken once a polygon is clicked. In this case we will create a popup with the camping name
// camping_vectorgrid.on('click', function(e) {
//     L.popup()
//       .setContent(e.layer.properties.wadmpr)
//       .setLatLng(e.latlng)
//       .openOn(map);
//   })
//   .addTo(map);

// // Add the vectorGrid to the map
// camping_vectorgrid.addTo(map);

      var layer_prioritas = new L.GeoJSON.AJAX("{{ 'assets/layer/request_layer_kp.php' }}", {
          style: function(
              feature) { // PEWARNAAN OBJEK POLYGON DIAMBIL DARI FIELD "color" PADA FILE GEOJSON geojson
              if (feature.properties.keterangan == '5 DESTINASI SUPER PRIORITAS') {
                  var styleprioritas = {
                      color: "#000",
                      weight: 1,
                      fillColor: '#1965bf',
                      fillOpacity: 0.6
                  };
              } else {
                  var styleprioritas = {
                      color: "#000",
                      weight: 1,
                      fillColor: '#ee7600',
                      fillOpacity: 0.6
                  };
              };
              return styleprioritas;
          },
          onEachFeature: function(feature, layer) {
              items.push(
                  layer
              ); // ini dibuat untuk menghubungkan variabel items ke dalam layer, ini berfungsi untuk menjalankan tool pencarian
              if (feature.properties) {
                  var content =
                      "<div class='table-responsive'><table class='table' style='margin-bottom:0; font-size:12px;'>" +
                      "<tr><th style='width:30%;'>ID Desa</th><td>" + feature.properties.kode_bps +
                      "</td></tr>" +
                      "<tr><th style='width:30%;'>Desa / Kelurahan</th><td>" + feature.properties.keldes +
                      "</td></tr>" +
                      "<tr><th style='width:30%;'>Kecamatan</th><td>" + feature.properties.kecamatan +
                      "</td></tr>" +
                      "<tr><th style='width:30%;'>Kabupaten / Kota</th><td>" + feature.properties.kabkot +
                      "</td></tr>" +
                      "<tr><th style='width:30%;'>Provinsi</th><td>" + feature.properties.provinsi +
                      "</td></tr>" +
                      "<tr><th style='width:30%;'>Jenis Kawasan</th><td>" + feature.properties
                      .jenis_kawasan + "</td></tr>" +
                      "<tr><th style='width:30%;'>3T</th><td>" + feature.properties.status_3t + "</td></tr>" +
                      "<tr><th style='width:30%;'>LOKPRI</th><td>" + feature.properties.lokpri +
                      "</td></tr>" +
                      "<tr><th style='width:30%;'>Keterangan</th><td>" + feature.properties
                      .keterangan + "</td></tr></table></div>";
                  layer.on('click', function(e) {
                      $("#drag_title_peta").html("KAWASAN PRIORITAS");
                      $("#feature-info").html(content);
                       $("#btnmodalpeta").trigger("click");
                  });
              }
              layer.on({
                  mouseover: function(e) {
                      var layer = e.target;
                      layer.setStyle({
                          weight: 1,
                          color: '#000',
                          dashArray: '',
                          fillColor: "#ff0000",
                          fillOpacity: 0.8
                      });
                      if (!L.Browser.ie && !L.Browser.opera) {
                          layer.bringToFront();
                      }
                  },
                  mouseout: function(e) {
                      layer_prioritas.resetStyle(e.target);
                  }
              });
          }
      });


      var IconPB = L.Icon.extend({
          options: {
              iconSize: [8, 8],
              // shadowSize: [36,36],
              iconAnchor: [12, 12],
              shadowAnchor: [12, 12],
              popupAnchor: [0, -6]
          }
      });

      var IPB1 = new IconPB({
          iconUrl: "{{ 'assets/images/backend/icon/mark3.png' }}"
      });
      var IPB2 = new IconPB({
          iconUrl: "{{ 'assets/images/backend/icon/mark2.png' }}"
      });
      var IPB3 = new IconPB({
          iconUrl: "{{ 'assets/images/backend/icon/mark4.png' }}"
      });
      var IPB4 = new IconPB({
          iconUrl: "{{ 'assets/images/backend/icon/mark5.png' }}"
      });
      var layer_penerimabantuan = new L.GeoJSON.AJAX("{{ 'assets/layer/request_layer_pb.php' }}", {
          pointToLayer: function(feature, latlng) {
              if (feature.properties.keterangan == 'Integrasi SIDILAN') {
                  var marker = L.marker(latlng, {
                      icon: IPB2
                  });
              } else {
                  var marker = L.marker(latlng, {
                      icon: IPB1
                  });
              };
              return marker;
          },
          // create marker object, pass custom icon as option, add to map    
          onEachFeature: function(feature, layer) {
              if (feature.properties) {
                  var content =
                      "<div class='table-responsive'><table class='table' style='margin-bottom:0;'>" +
                      "<tr><th style='width:30%;'>Nama</th><td>" + feature.properties.nama +
                      "</td></tr>" + "<tr><th style='width:30%;'>Kontak Telpon</th><td>" + feature.properties
                      .telepon +
                      "</td></tr>" + "<tr><th style='width:30%;'>Email</th><td>" + feature.properties.email +
                      "</td></tr>" + "<tr><th style='width:30%;'>Jenis Usaha</th><td>" + feature.properties
                      .jenis_usaha +
                      "</td></tr>" + "<tr><th style='width:30%;'>Produk Usaha</th><td>" + feature.properties
                      .produk +
                      "</td></tr>" + "<tr><th style='width:30%;'>Alamat</th><td>" + feature
                      .properties.alamat +
                      "</td></tr>" + "<tr><th style='width:30%;'>Desa / Kelurahan</th><td>" + feature
                      .properties.desa +
                      "</td></tr>" + "<tr><th style='width:30%;'>Kecamatan</th><td>" + feature.properties
                      .kecamatan +
                      "</td></tr>" + "<tr><th style='width:30%;'>Kab / Kota</th><td>" + feature.properties
                      .kab_kota +
                      "</td></tr>" + "<tr><th style='width:30%;'>Provinsi</th><td>" + feature.properties
                      .provinsi +
                      "</td></tr>" + "<tr><th style='width:30%;'>Tahun Bantuan</th><td>" + feature.properties
                      .thn_bantuan +
                      "</td></tr>" + "<tr><th style='width:30%;'>Keterangan</th><td>" + feature.properties
                      .keterangan +
                      "</td></tr></table></div>";
                  layer.on('click', function(e) {
                      $("#drag_title_peta").html("PENERIMA BANTUAN");
                      $("#feature-info").html(content);
                       $("#btnmodalpeta").trigger("click");
                  });
              }
          }
      });


        // var penerima_bantuan2 = new L.GeoJSON.AJAX("{{ route('PBgetMap') }}", {
        // var layer_bantuanSTB = new L.GeoJSON.AJAX("{{ 'assets/layer/request_layer_stb.php' }}", {
        //     pointToLayer: function(feature, latlng) {
        //         return marker = L.marker(latlng, {
        //             icon: IPB2
        //         });
        //     },
        //     // create marker object, pass custom icon as option, add to map    
        //     onEachFeature: function(feature, layer) {
        //         if (feature.properties) {
        //             var content =
        //                 "<div class='table-responsive'><table class='table' style='margin-bottom:0;'>" +
        //                 "<tr><th style='width:30%;'>Nama</th><td>" + feature.properties.nama_lengkap +
        //                 "</td></tr>" + "<tr><th style='width:30%;'>Kontak Telpon</th><td>" + feature.properties
        //                 .telp +
        //                 "</td></tr>" + "<tr><th style='width:30%;'>Jenis Usaha</th><td>" + feature.properties
        //                 .keterangan +
        //                 "</td></tr>" + "<tr><th style='width:30%;'>Alamat</th><td>" + feature.properties
        //                 .alamat +
        //                 "</td></tr>" + "<tr><th style='width:30%;'>Desa / Kelurahan</th><td>" + feature
        //                 .properties.iddesa +
        //                 "</td></tr>" + "<tr><th style='width:30%;'>Kecamatan</th><td>" + feature.properties
        //                 .idkec +
        //                 "</td></tr>" + "<tr><th style='width:30%;'>Kab / Kota</th><td>" + feature.properties
        //                 .idkabupaten +
        //                 "</td></tr>" + "<tr><th style='width:30%;'>Provinsi</th><td>" + feature.properties
        //                 .idprovinsi +
        //                 "</td></tr>" + "<tr><th style='width:30%;'>Bandwith</th><td>" + feature.properties
        //                 .bandwith +
        //                 "</td></tr>" + "<tr><th style='width:30%;'>Tahun Bantuan</th><td>" + feature.properties
        //                 .tahun +
        //                 "</td></tr></table></div>";
        //             layer.on('click', function(e) {
        //                 $("#drag_title_peta").html("PENERIMA BANTUAN");
        //                 $("#feature-info").html(content);
        //                  $("#btnmodalpeta").trigger("click");
        //             });
        //         }
        //     }
        // });


      var smallIcon2 = new L.Icon({
          iconSize: [10, 10],
          iconAnchor: [6, 7],
          iconUrl: "{{ 'assets/images/backend/icon/mark2.png' }}"
      });


      var IconPOI = L.Icon.extend({
          options: {
              iconSize: [8, 8],
              // shadowSize: [36,36],
              iconAnchor: [12, 12],
              shadowAnchor: [12, 12],
              popupAnchor: [0, -6]
          }
      });

      var IconPOInon = new L.Icon({
          iconSize: [1, 1],
          iconAnchor: [1, 2],
          popupAnchor: [1, 1],
          iconUrl: 'img/custom-icon.png'
      });

      // Create specific icons
      var IPOI1 = new IconPOI({
          iconUrl: "{{ 'assets/images/backend/icon/poi1.png' }}"
      });
      var IPOI2 = new IconPOI({
          iconUrl: "{{ 'assets/images/backend/icon/poi2.png' }}"
      });
      var IPOI3 = new IconPOI({
          iconUrl: "{{ 'assets/images/backend/icon/poi3.png' }}"
      });
      var IPOI4 = new IconPOI({
          iconUrl: "{{ 'assets/images/backend/icon/poi4.png' }}"
      });
      var layer_poi = new L.GeoJSON.AJAX("{{ 'assets/layer/request_layer_poi.php' }}", {
          pointToLayer: function(feature, latlng) {
              if (feature.properties.jenis_poi == 'Pemerintah') {
                  var marker = L.marker(latlng, {
                      icon: IPOI1
                  });
              } else if (feature.properties.jenis_poi == 'Pendidikan') {
                  var marker = L.marker(latlng, {
                      icon: IPOI2
                  });
              } else if (feature.properties.jenis_poi == 'Kesehatan') {
                  var marker = L.marker(latlng, {
                      icon: IPOI3
                  });
              } else if (feature.properties.jenis_poi == 'Niaga') {
                  var marker = L.marker(latlng, {
                      icon: IPOI4
                  });
              } else {
                  var marker = L.marker(latlng, {
                      icon: IconPOInon
                  });
              };
              return marker;
          },
          // create marker object, pass custom icon as option, add to map    
          onEachFeature: function(feature, layer) {
              if (feature.properties) {
                  var content =
                      "<div class='table-responsive'><table class='table' style='margin-bottom:0;'>" +
                      "<tr><th style='width:30%;'>Nama POI</th><td>" + feature.properties.namobj +
                      "</td></tr>" + "<tr><th style='width:30%;'>Keterangan</th><td>" + feature.properties
                      .remark +
                      "</td></tr>" + "<tr><th style='width:30%;'>Kategori</th><td>" + feature.properties
                      .jenis_poi
                  layer.on('click', function(e) {
                      $("#drag_title_peta").html("POINT OF INTEREST");
                      $("#feature-info").html(content);
                       $("#btnmodalpeta").trigger("click");
                  });
              }
          }
      }).addTo(map);

      //   var layer_penerimabantuan = new L.LayerGroup(penerima_bantuan1, penerima_bantuan2);
      //   var layer_penerimabantuan = L.layerGroup([penerima_bantuan1, penerima_bantuan2]);

      // MENAMPILKAN TOOLS UNTUK MEMILIH BASEMAP
      // L.control.groupedLayers(baseMaps).addTo(map);

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

      L.control.fullscreen({
          position: 'bottomright', // change the position of the button can be topleft, topright, bottomright or bottomleft, defaut topleft
          title: 'Show me the fullscreen !', // change the title of the button, default Full Screen
          titleCancel: 'Exit fullscreen mode', // change the title of the button when fullscreen is on, default Exit Full Screen
          content: null, // change the content of the button, can be HTML, default null
          forceSeparateButton: false, // force seperate button to detach from zoom buttons, default false
          forcePseudoFullscreen: false, // force use of pseudo full screen even if full screen API is available, default false
          fullscreenElement: false // Dom element to render in full screen, false by default, fallback to map._container
      }).addTo(map);



      var datasettools = L.easyButton(
            '<span class="iconify" data-icon="solar:layers-bold" data-width="18" data-height="18"></span>',
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

      // MEASURE LINE
      let polylineMeasure = L.control.polylineMeasure({
          position: 'topleft',
          unit: 'metres',
          showBearings: true,
          clearMeasurementsOnStop: false,
          showClearControl: true,
          showUnitControl: false
      })
      polylineMeasure.addTo(map);

      function debugevent(e) {
          console.debug(e.type, e, polylineMeasure._currentLine)
      }
      map.on('polylinemeasure:toggle', debugevent);
      map.on('polylinemeasure:start', debugevent);
      map.on('polylinemeasure:resume', debugevent);
      map.on('polylinemeasure:finish', debugevent);
      map.on('polylinemeasure:clear', debugevent);
      map.on('polylinemeasure:add', debugevent);
      map.on('polylinemeasure:insert', debugevent);
      map.on('polylinemeasure:move', debugevent);
      map.on('polylinemeasure:remove', debugevent);

      var filtertools = L.easyButton(
            '<span class="iconify" data-icon="ri:filter-fill" data-width="18" data-height="18"></span>',
            function OpenFilter() {
                var x = document.getElementById("menu-filter");
                var y = document.getElementById("filtertools");
                if (x.style.display === "none") {
                    x.style.display = "block";
                    y.style.background = "#538f91";
                    y.style.color = "#ffffff";
                } else {
                    x.style.display = "none";
                    y.style.background = "#ffffff";
                    y.style.color = "#000000";
                }
            }, "Filter Tools", 'topleft', 'filtertools').addTo(map);

                                 // coortinate tools
        // var coordinate = L.control.coordProjection().addTo(map);

            var legendtools = L.easyButton(
            '<span class="iconify" data-icon="mdi:map-legend" data-width="18" data-height="18"></span>',
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
            }, "Legend Tools", 'bottomleft', 'legendtools').addTo(map);



      //       var drawnItems = new L.FeatureGroup();
      //   map.addLayer(drawnItems);

      //       // ADD POINT
      //       var drawControl = new L.Control.Draw({
      //     draw: {
      //       position: 'topleft',
      //       polyline: false,
      //       polygon: false,
      //       rectangle: false,
      //       circle: false,
      //       marker: true,
      //       circlemarker: false
      //     },
      //     edit: false
      //   });

      //   map.addControl(drawControl);

      //   map.on('draw:created', function (e) {
      //     var type = e.layerType, 
      //       layer = e.layer;

      //     var drawnJSONObject = layer.toGeoJSON();
      //     var objectGeometry = Terraformer.WKT.convert(drawnJSONObject.geometry);

      //     if (type === 'polyline') {
      //       _buildDigitiseModalBox('modalform','LINESTRING',objectGeometry);
      //     } else if (type === 'polygon') {
      //       _buildDigitiseModalBox('modalform','POLYGON',objectGeometry);
      //     } else if (type === 'marker') {
      //       _buildDigitiseModalBox('modalform','POINT',objectGeometry);
      //     } else {
      //       console.log('__undefined__');
      //     }
      //     //map.addLayer(layer);
      //     drawnItems.addLayer(layer);
      //   });

      //   $("#modalform").on('shown.bs.modal', function(){
      //     _activateFeatureSave();
      //   });

      // DEFAULT EXTENT
      L.control.defaultExtent({
          position: 'bottomright'
      }).addTo(map);


      // SEARCH ADMINSITRASI
      //   new L.Control.GPlaceAutocomplete({
      //       position: "topleft",
      //       callback: function(place) {
      //           var loc = place.geometry.location;
      //           map.panTo([loc.lat(), loc.lng()]);
      //           map.setZoom(13);
      //       },
      //       placeholder: 'Masukan Pencarian Administrasi'
      //   }).addTo(map);

      // controlSearch.on('search:collapsed', function(e) {
      //     map.setView([0.539731,118.7240573], 4);
      // })


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

        document.getElementById('layer_prioritas').addEventListener('change', function() {
          if (document.getElementById(this.id).checked == true) {
              layer_prioritas.addTo(map);
          } else {
              layer_prioritas.remove(map);
          }
      });

      document.getElementById('layer_prioritas').addEventListener('change', function() {
          if (document.getElementById(this.id).checked == true) {
              layer_prioritas.addTo(map);
          } else {
              layer_prioritas.remove(map);
          }
      });
    //   document.getElementById('layer_podes18').addEventListener('change', function() {
    //       if (document.getElementById(this.id).checked == true) {
    //           layer_podes18.addTo(map);
    //       } else {
    //           layer_podes18.remove(map);
    //       }
    //   });
    //   document.getElementById('layer_podes20').addEventListener('change', function() {
    //       if (document.getElementById(this.id).checked == true) {
    //           layer_podes20.addTo(map);
    //       } else {
    //           layer_podes20.remove(map);
    //       }
    //   });
      document.getElementById('layer_spd').addEventListener('change', function() {
          if (document.getElementById(this.id).checked == true) {
              layer_spd.addTo(map);
          } else {
              layer_spd.remove(map);
          }
      });
      document.getElementById('layer_penerimabantuan').addEventListener('change', function() {
          if (document.getElementById(this.id).checked == true) {
              layer_penerimabantuan.addTo(map);
          } else {
              layer_penerimabantuan.remove(map);
          }
      });

    //   document.getElementById('layer_bantuanSTB').addEventListener('change', function() {
    //       if (document.getElementById(this.id).checked == true) {
    //           layer_bantuanSTB.addTo(map);
    //       } else {
    //           layer_bantuanSTB.remove(map);
    //       }
    //   });

      document.getElementById('layer_poi').addEventListener('change', function() {
          if (document.getElementById(this.id).checked == true) {
              layer_poi.addTo(map);
          } else {
              layer_poi.remove(map);
          }
      });

//       document.getElementById('tc_administrasi').addEventListener('change', function() {
//       if (document.getElementById(this.id).checked == true) {
//         layer_kabkot.addTo(map);
//       } else {
//         layer_kabkot.remove(map);
//       }
//   });

      
      
  
      setTimeout(function() {
          map.invalidateSize(true)
      }, 300);
  </script>

@foreach ($spatial_layer as $item)
<script>
    document.getElementById('{{$item->title}}').addEventListener('change', function() {
      if (document.getElementById(this.id).checked == true) {
        layer_kabkot.addTo(map);
      } else {
        layer_kabkot.remove(map);
      }
  });
</script>
@endforeach 
<script src="{{ url('assets/vendor/draggable-dialog-modal/dist/jquery-simple-dialog.js') }}"></script>
<script>
      $('#draginfopeta').simpleDialog({
    opener: '#btnmodalpeta',
    closer: '#drag_close6',
    dragger: '#drag_title_peta'
  });
</script>