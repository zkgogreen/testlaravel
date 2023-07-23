<script type="text/javascript">

var GABUNG2 = new L.LayerGroup();
var items = [];

map = L.map('map', {}).setView([0.539731,118.7240573], 4);
var url = 'http://localhost:8080/geoserver/kominfo/wms';
var urlVT = 'http://localhost:8080/geoserver/gwc/service/tms/1.0.0/kominfo:adm_demand@EPSG%3A4326@pbf/{z}/{x}/{-y}.pbf';
var urlVT3 ='http://localhost:8080/geoserver/gwc/service/wmts?REQUEST=GetTile&SERVICE=WMTS&VERSION=1.0.0&LAYER=kominfo:adm_demand&STYLE=&TILEMATRIX=EPSG:4326:{z}&TILEMATRIXSET=EPSG:4326&FORMAT=application/vnd.mapbox-vector-tile&TILECOL={x}&TILEROW={y}';
var urlVT2 = 'http://localhost:8080/geoserver/gwc/demo/kominfo:adm_demand?gridSet=EPSG:4326&format=application/vnd.mapbox-vector-tile';


var layer_podes = L.tileLayer.betterWmsADM(url, {
    layers: 'kominfo:adm_demand',
    format: 'image/png',
    transparent: true,
    tiled: true,
    zIndex: 1000
});

var layer_podes2020 = L.tileLayer.betterWmsADM_PODES(url, {
    layers: 'kominfo:adm_podes2020',
    format: 'image/png',
    transparent: true,
    tiled: true,
    zIndex: 1000
});

// Set vectorTileOptions
// var vectorTileOptions = {
// vectorTileLayerStyles: {
// 'adm_demand': function() {
// return {
//   color: 'red',
//   opacity: 1,
//   fillColor: 'yellow',
//   fill: true,
// }
// },
// },
// interactive: true,  // Make sure that this VectorGrid fires mouse/pointer events
// }

// // Set the coordinate system
// var projection_epsg_no = '4326';
// // Set the variable for storing the workspace:layername
// var campground_geoserverlayer = 'kominfo:adm_demand';
// // Creating the full vectorTile url
// var campingURL = 'http://localhost:8080/geoserver/gwc/service/tms/1.0.0/' + campground_geoserverlayer + '@EPSG%3A' + projection_epsg_no + '@png/{z}/{x}/{-y}.png';
// // Creating the Leaflet vectorGrid object
// var layer_podes = L.vectorGrid.protobuf(campingURL, vectorTileOptions)

// // Define the action taken once a polygon is clicked. In this case we will create a popup with the camping name
// layer_podes.on('click', function(e) {
//     L.popup()
//       .setContent(e.layer.properties.nama_desa)
//       .setLatLng(e.latlng)
//       .openOn(map);
//   })
//   .addTo(map);

// // Add the vectorGrid to the map
// layer_podes.addTo(map);



// var layer_podes = L.vectorGrid.protobuf(urlVT3);
// var layer_podes = L.tileLayer.wms(url, {
//     layers: 'kominfo:adm_demand',
//     format: 'image/png',
//     transparent: true,
//     version: '1.1.0',
//     attribution: "myattribution",
//     zIndex: 1000
// });

// var tileIndex = geojsonvt(geoJSON);

var layer_spd = new L.GeoJSON.AJAX("./assets/layer/request_layer_survey_potensidesa.php",{
    style: function(feature){ // PEWARNAAN OBJEK POLYGON DIAMBIL DARI FIELD "color" PADA FILE GEOJSON geojson
        return {color: "#000", weight: 1, fillColor: '#ffde17', fillOpacity: 0.6 }; // Berikan efek trasparan pada bagian "fillOpacity" agar basemap dapat terlihat
      },
      onEachFeature: function(feature, layer){
        items.push(layer); // ini dibuat untuk menghubungkan variabel items ke dalam layer, ini berfungsi untuk menjalankan tool pencarian
        if (feature.properties) {
          var content = "<div class='table-responsive'><table class='table table-striped table-bordered table-condensed' style='margin-bottom:0; font-size:12px;'>" + 
          "<tr><th style='width:30%;'>Desa / Kelurahan</th><td>" + feature.properties.kel_des + "</td></tr>" + 
          "<tr><th style='width:30%;'>Kecamatan</th><td>" + feature.properties.kec + "</td></tr>" + 
          "<tr><th style='width:30%;'>Kabupaten / Kota</th><td>" + feature.properties.kab_kot + "</td></tr>" + 
          "<tr><th style='width:30%;'>Provinsi</th><td>" + feature.properties.prov + "</td></tr>" + 
          "<tr><th style='width:30%;'>Kode Desa</th><td>" + feature.properties.kode + "</td></tr>" + 
          "<tr><th style='width:30%;'>Jumlah Penduduk</th><td>" + feature.properties.jumlah_penduduk + "</td></tr>" +
          "<tr><th style='width:30%;'>Jumlah KK</th><td>" + feature.properties.jumlah_kk + "</td></tr>" +
          "<tr><th style='width:30%;'>Jumlah UMKM</th><td>" + feature.properties.jumlah_umkm + "</td></tr>" + 
          "<tr><th style='width:30%;'>Jenis UMKM</th><td>" + feature.properties.jenis_umkm + "</td></tr>" + 
          "<tr><th style='width:30%;'>Mata Pencaharian Penduduk</th><td>" + feature.properties.pencaharian + "</td></tr>" + 
          "<tr><th style='width:30%;'>Pendapatan Penduduk</th><td>" + feature.properties.pendapatan + "</td></tr>" +
          "<tr><th style='width:30%;'>Potensi Desa</th><td>" + feature.properties.potensi + "</td></tr></table></div>" +
          "<div class='wrapper center-block'> <div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'> <div class='panel panel-default'> <div class='panel-heading active' role='tab' id='headingOne'> <h4 class='panel-title'> <a role='button' data-toggle='collapse' data-parent='#accordion' href='#collapseOne' aria-expanded='true' aria-controls='collapseOne'> DOKUMENTASI </a> </h4> </div> <div id='collapseOne' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'> <div class='panel-body'> <div class='slideshow nowslide'> <div class='sliderdok'> <input type='radio' name='radio' id='radio1' checked> <input type='radio' name='radio' id='radio2'> <input type='radio' name='radio' id='radio3'> <input type='radio' name='radio' id='radio4'> <input type='radio' name='radio' id='radio5'> <div class='slidedok sh1'> <iframe src='" + feature.properties.foto1 + "preview' width='100%'></iframe> </div> <div class='slidedok'> <iframe src='" + feature.properties.foto2 + "preview' width='100%'></iframe> </div> <div class='slidedok'> <iframe src='" + feature.properties.foto3 + "preview' width='100%'></iframe> </div> <div class='slidedok'> <iframe src='" + feature.properties.foto4 + "preview' width='100%'></iframe> </div> <div class='slidedok'> <iframe src='" + feature.properties.foto5 + "preview' width='100%'></iframe> </div> </div> <div class='navslider'> <label for='radio1' class='barslider'></label> <label for='radio2' class='barslider'></label> <label for='radio3' class='barslider'></label> <label for='radio4' class='barslider'></label> <label for='radio5' class='barslider'></label> </div> </div> </div> </div> </div></div></div>";
          layer.on('click', function(e) {
      $("#feature-title").html("SURVEY POTENSI DESA");
      $("#feature-info").html(content);
      $("#featureModal").modal("show"); 
});
           }
      layer.on({
      mouseover: function (e) {
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
      mouseout: function (e) {
        layer_spd.resetStyle(e.target);
      }
    });
    }
    }); 


var layer_prioritas =  L.layerGroup([]);

var dataPrioritas = new L.GeoJSON.AJAX("./assets/layer/request_layer_prioritas.php",{
    style: function(feature){ // PEWARNAAN OBJEK POLYGON DIAMBIL DARI FIELD "color" PADA FILE GEOJSON geojson
      //   return {color: "#000", weight: 1, fillColor: '#428bca', fillOpacity: 0.6 }; // Berikan efek trasparan pada bagian "fillOpacity" agar basemap dapat terlihat
      // },
        if (feature.properties.prioritas_filter == '5 DESTINASI SUPER PRIORITAS'){
          var styleprioritas = {color: "#000", weight: 1, fillColor: '#1965bf', fillOpacity: 0.6};
              } else {
          var styleprioritas = {color: "#000", weight: 1, fillColor: '#ee7600', fillOpacity: 0.6};
            };
        return styleprioritas;
      },
      onEachFeature: function(feature, layer){
        items.push(layer); // ini dibuat untuk menghubungkan variabel items ke dalam layer, ini berfungsi untuk menjalankan tool pencarian
        if (feature.properties) {
          var content = "<div class='table-responsive'><table class='table table-striped table-bordered table-condensed' style='margin-bottom:0; font-size:12px;'>" + 
          "<tr><th style='width:30%;'>ID Desa</th><td>" + feature.properties.id_desa + "</td></tr>" + 
          "<tr><th style='width:30%;'>Desa / Kelurahan</th><td>" + feature.properties.desa + "</td></tr>" + 
          "<tr><th style='width:30%;'>Kecamatan</th><td>" + feature.properties.kecamatan + "</td></tr>" + 
          "<tr><th style='width:30%;'>Kabupaten / Kota</th><td>" + feature.properties.kabkot + "</td></tr>" + 
          "<tr><th style='width:30%;'>Provinsi</th><td>" + feature.properties.provinsi + "</td></tr>" + 
          "<tr><th style='width:30%;'>Jenis Kawasan</th><td>" + feature.properties.jenis_kawasan + "</td></tr>" +
          "<tr><th style='width:30%;'>3T</th><td>" + feature.properties.t3 + "</td></tr>" +
          "<tr><th style='width:30%;'>LOKPRI</th><td>" + feature.properties.lokpri + "</td></tr>" + 
          "<tr><th style='width:30%;'>Keterangan</th><td>" + feature.properties.prioritas_filter + "</td></tr></table></div>";
          layer.on('click', function(e) {
      $("#feature-title").html("KAWASAN PRIORITAS");
      $("#feature-info").html(content);
      $("#featureModal").modal("show"); 
});
           }
      layer.on({
      mouseover: function (e) {
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
      mouseout: function (e) {
        dataPrioritas.resetStyle(e.target);
      }
    });
    }
    }); 

 layer_prioritas.addLayer(dataPrioritas); 


 function FilterSelect() {
      //  $('#filter_run').click(function(e) {
      //     e.preventDefault();
        var prov_fil = document.getElementById("_provinsi").value;
        var kabkot_fil = document.getElementById("_kabkot").value;
        var kecamatan_fil = document.getElementById("_kecamatan").value;
        // console.log(prov_fil);
        //  console.log(kabkot_fil);
        layer_prioritas.clearLayers();
        map.removeLayer(layer_prioritas);
var dataPrioritas = new L.GeoJSON.AJAX("./assets/layer/request_layer_prioritas.php",{
    style: function(feature){ // PEWARNAAN OBJEK POLYGON DIAMBIL DARI FIELD "color" PADA FILE GEOJSON geojson
      //   return {color: "#000", weight: 1, fillColor: '#428bca', fillOpacity: 0.6 }; // Berikan efek trasparan pada bagian "fillOpacity" agar basemap dapat terlihat
      // },
        if (feature.properties.prioritas_filter == '5 DESTINASI SUPER PRIORITAS'){
          var styleprioritas = {color: "#000", weight: 1, fillColor: '#1965bf', fillOpacity: 0.6};
              } else {
          var styleprioritas = {color: "#000", weight: 1, fillColor: '#ee7600', fillOpacity: 0.6};
            };
        return styleprioritas;
      },
      filter: function(feature, layer) {   
          if( prov_fil == "pilihprovinsi") {
            var filter = (feature.properties.priority == '1');
          }else if (kabkot_fil == "piilhkabkot") {
            var filter = (feature.properties.provinsi == prov_fil);
          }else if (kecamatan_fil == "piilhkecamatan") {
            var filter = (feature.properties.kabkot == kabkot_fil);
          }else{
           var filter = (feature.properties.provinsi == prov_fil && feature.properties.kabkot == kabkot_fil && feature.properties.kecamatan == kecamatan_fil);
          }
          return filter;
        },
      onEachFeature: function(feature, layer){
        items.push(layer); // ini dibuat untuk menghubungkan variabel items ke dalam layer, ini berfungsi untuk menjalankan tool pencarian
        if (feature.properties) {
          var content = "<div class='table-responsive'><table class='table table-striped table-bordered table-condensed' style='margin-bottom:0; font-size:12px;'>" + 
          "<tr><th style='width:30%;'>ID Desa</th><td>" + feature.properties.id_desa + "</td></tr>" + 
          "<tr><th style='width:30%;'>Desa / Kelurahan</th><td>" + feature.properties.desa + "</td></tr>" + 
          "<tr><th style='width:30%;'>Kecamatan</th><td>" + feature.properties.kecamatan + "</td></tr>" + 
          "<tr><th style='width:30%;'>Kabupaten / Kota</th><td>" + feature.properties.kabkot + "</td></tr>" + 
          "<tr><th style='width:30%;'>Provinsi</th><td>" + feature.properties.provinsi + "</td></tr>" + 
          "<tr><th style='width:30%;'>Jenis Kawasan</th><td>" + feature.properties.jenis_kawasan + "</td></tr>" +
          "<tr><th style='width:30%;'>3T</th><td>" + feature.properties.t3 + "</td></tr>" +
          "<tr><th style='width:30%;'>LOKPRI</th><td>" + feature.properties.lokpri + "</td></tr>" + 
          "<tr><th style='width:30%;'>Keterangan</th><td>" + feature.properties.prioritas_filter + "</td></tr></table></div>";
          layer.on('click', function(e) {
      $("#feature-title").html("KAWASAN PRIORITAS");
      $("#feature-info").html(content);
      $("#featureModal").modal("show"); 
});
           }
      layer.on({
      mouseover: function (e) {
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
      mouseout: function (e) {
        dataPrioritas.resetStyle(e.target);
      }
    });
    }
    }); 

 layer_prioritas.addLayer(dataPrioritas); 
 layer_prioritas.addTo(map); 
 }

// var layer_penerima_bantuan = L.tileLayer.betterWmsPenerimaBantuan(url, {
//     layers: 'kominfo:penerima_bantuan',
//     format: 'image/png',
//     transparent: true,
//     version: '1.1.0',
//     attribution: "myattribution",
//     zIndex: 1100
// });

var IconPB = L.Icon.extend({
    options:{
        iconSize: [8,8],
        // shadowSize: [36,36],
        iconAnchor: [12,12],
        shadowAnchor: [12,12],
        popupAnchor: [0,-6]
    }
});

var IPB1 = new IconPB({iconUrl: "./assets/images/icon/mark3.png"});
var IPB2 = new IconPB({iconUrl: "./assets/images/icon/mark2.png"});
var IPB3 = new IconPB({iconUrl: "./assets/images/icon/mark4.png"});
var layer_penerimabantuan = new L.GeoJSON.AJAX("./assets/layer/request_layer_penerima_bantuan.php",{
      pointToLayer: function(feature, latlng) {
          if (feature.properties.thn_bantuan == '2019'){
                var marker = L.marker(latlng,{icon: IPB1});
            } else if (feature.properties.thn_bantuan == '2020') {
                var marker = L.marker(latlng,{icon: IPB2});
              }else {
                var marker = L.marker(latlng,{icon: IPB3});
            };
        return marker;
      },
    // create marker object, pass custom icon as option, add to map    
      onEachFeature: function(feature, layer){
if (feature.properties) {
          var content = "<div class='table-responsive'><table class='table table-striped table-bordered table-condensed' style='margin-bottom:0;'>" + 
          "<tr><th style='width:30%;'>Nama</th><td>" + feature.properties.nama 
          + "</td></tr>" + "<tr><th style='width:30%;'>Kontak Telpon</th><td>" + feature.properties.telepon 
          + "</td></tr>" + "<tr><th style='width:30%;'>Email</th><td>" + feature.properties.email 
          + "</td></tr>" + "<tr><th style='width:30%;'>Jenis Usaha</th><td>" + feature.properties.jenis_usaha 
          + "</td></tr>" + "<tr><th style='width:30%;'>Produk Usaha</th><td>" + feature.properties.produk 
           + "</td></tr>" + "<tr><th style='width:30%;'>Desa / Kelurahan</th><td>"  + feature.properties.desa  
          + "</td></tr>" + "<tr><th style='width:30%;'>Kecamatan</th><td>"  + feature.properties.kecamatan  
          + "</td></tr>" + "<tr><th style='width:30%;'>Kab / Kota</th><td>"  + feature.properties.kab_kota  
          + "</td></tr>" + "<tr><th style='width:30%;'>Provinsi</th><td>"  + feature.properties.provinsi  
          + "</td></tr></table></div>";
          layer.on('click', function(e) {
      $("#feature-title").html("PENERIMA BANTUAN");
      $("#feature-info").html(content);
      $("#featureModal").modal("show"); 
});
           }
    }
    });


var smallIcon2 = new L.Icon({
      iconSize: [10, 10],
      iconAnchor: [6, 7],
      iconUrl: './assets/images/icon/mark2.png'
    });
// var layer_calon_penerima_bantuan = new L.GeoJSON.AJAX("./assets/layer/request_layer_calon_penerima_bantuan.php",{
//       pointToLayer: function(feature, latlng) {
//         // console.log(latlng, feature);
//         return L.marker(latlng, {
//           icon: smallIcon2
//         });
//       },
      
//     // create marker object, pass custom icon as option, add to map    
//       onEachFeature: function(feature, layer){
// if (feature.properties) {
//           var content = "<div class='table-responsive'><table class='table table-striped table-bordered table-condensed' style='margin-bottom:0;'>" + 
//           "<tr><th style='width:30%;'>Nama Usaha</th><td>" + feature.properties.ikm_umkm 
//           + "</td></tr>" + "<tr><th style='width:30%;'>Nama Pemilik</th><td>" + feature.properties.nama 
//           + "</td></tr>" + "<tr><th style='width:30%;'>Jenis Usaha</th><td>" + feature.properties.keterangan 
//           + "</td></tr>" + "<tr><th style='width:30%;'>Tahun Survey</th><td>" + feature.properties.tahun 
//           + "</td></tr>" + "<tr><th style='width:30%;'>Alamat</th><td>" + feature.properties.alamat 
//           + "</td></tr>" + "<tr><th style='width:30%;'>Desa / Kelurahan</th><td>"  + feature.properties.desa  
//           + "</td></tr>" + "<tr><th style='width:30%;'>Kecamatan</th><td>"  + feature.properties.kecamatan  
//           + "</td></tr>" + "<tr><th style='width:30%;'>Kab / Kota</th><td>"  + feature.properties.kabkot  
//           + "</td></tr>" + "<tr><th style='width:30%;'>Provinsi</th><td>"  + feature.properties.provinsi
//           + "</td></tr>" + "<tr><th style='width:30%;'>PIC</th><td>"  + feature.properties.pic
//           + "</td></tr>" + "<tr><th style='width:30%;'>Kontak PIC</th><td>"  + feature.properties.kontak  
//           + "</td></tr></table></div>";
//           layer.on('click', function(e) {
//       $("#feature-title").html("CALON PENERIMA BANTUAN");
//       $("#feature-info").html(content);
//       $("#featureModal").modal("show"); 
// });
//            }
//     }
//     });


var IconPOI = L.Icon.extend({
    options:{
        iconSize: [8,8],
        // shadowSize: [36,36],
        iconAnchor: [12,12],
        shadowAnchor: [12,12],
        popupAnchor: [0,-6]
    }
});

var IconPOInon = new L.Icon({
    iconSize: [1, 1],
    iconAnchor: [1, 2],
    popupAnchor: [1, 1],
    iconUrl: 'img/custom-icon.png'
});

// Create specific icons
var IPOI1 = new IconPOI({iconUrl: "./assets/images/icon/poi1.png"});
var IPOI2 = new IconPOI({iconUrl: "./assets/images/icon/poi2.png"});
var IPOI3 = new IconPOI({iconUrl: "./assets/images/icon/poi3.png"});
var IPOI4 = new IconPOI({iconUrl: "./assets/images/icon/poi4.png"});
var layer_poi = new L.GeoJSON.AJAX("./assets/layer/request_layer_poi.php",{
      pointToLayer: function(feature, latlng) {
              if (feature.properties.jenis_poi == 'Pemerintah'){
                var marker = L.marker(latlng,{icon: IPOI1});
            } else if (feature.properties.jenis_poi == 'Pendidikan') {
                var marker = L.marker(latlng,{icon: IPOI2});
              } else if (feature.properties.jenis_poi == 'Kesehatan') {
                var marker = L.marker(latlng,{icon: IPOI3});
              } else if (feature.properties.jenis_poi == 'Niaga') {
                var marker = L.marker(latlng,{icon: IPOI4});
              }else {
                var marker = L.marker(latlng,{icon: IconPOInon});
            };
        return marker;
      },
    // create marker object, pass custom icon as option, add to map    
      onEachFeature: function(feature, layer){
if (feature.properties) {
          var content = "<div class='table-responsive'><table class='table table-striped table-bordered table-condensed' style='margin-bottom:0;'>" + 
          "<tr><th style='width:30%;'>Nama POI</th><td>" + feature.properties.namobj 
          + "</td></tr>" + "<tr><th style='width:30%;'>Keterangan</th><td>" + feature.properties.remark 
          + "</td></tr>" + "<tr><th style='width:30%;'>Kategori</th><td>" + feature.properties.jenis_poi 
          layer.on('click', function(e) {
      $("#feature-title2").html("POINT OF INTEREST");
      $("#feature-info2").html(content);
      $("#featureModal2").modal("show"); 
});
           }
    }
    });


var smallIcon4 = new L.Icon({
    iconSize: [1, 1],
    iconAnchor: [1, 2],
    popupAnchor: [1, 1],
    iconUrl: 'img/custom-icon.png'
});
var layer_prioritas_search = new L.GeoJSON.AJAX("./assets/layer/request_layer_prioritas2.php", {
    pointToLayer: function (feature, latlng) {
        // console.log(latlng, feature);
        return L.marker(latlng, {
            icon: smallIcon4,
            title: feature.properties.desa + ' ,ID : ' + feature.properties.id_desa
        });
    }
}).addTo(map); 

var baseEsri = L.tileLayer.provider('Esri.WorldImagery').addTo(map);
var baseOsm = L.tileLayer.provider('OpenStreetMap');
var baseCarto = L.tileLayer.provider('CartoDB.DarkMatter');

// MENAMPILKAN TOOLS UNTUK MEMILIH BASEMAP
// L.control.groupedLayers(baseMaps).addTo(map);

L.control.fullscreen({
  position: 'bottomright', // change the position of the button can be topleft, topright, bottomright or bottomleft, defaut topleft
  title: 'Show me the fullscreen !', // change the title of the button, default Full Screen
  titleCancel: 'Exit fullscreen mode', // change the title of the button when fullscreen is on, default Exit Full Screen
  content: null, // change the content of the button, can be HTML, default null
  forceSeparateButton: false, // force seperate button to detach from zoom buttons, default false
  forcePseudoFullscreen: false, // force use of pseudo full screen even if full screen API is available, default false
  fullscreenElement: false // Dom element to render in full screen, false by default, fallback to map._container
}).addTo(map);



// MEASURE LINE
let polylineMeasure = L.control.polylineMeasure({position: 'topleft', unit: 'metres', showBearings: true, clearMeasurementsOnStop: false, showClearControl: true, showUnitControl: false })
polylineMeasure.addTo(map);
function debugevent(e) {console.debug(e.type, e, polylineMeasure._currentLine)}
map.on('polylinemeasure:toggle', debugevent);
map.on('polylinemeasure:start', debugevent);
map.on('polylinemeasure:resume', debugevent);
map.on('polylinemeasure:finish', debugevent);
map.on('polylinemeasure:clear', debugevent);
map.on('polylinemeasure:add', debugevent);
map.on('polylinemeasure:insert', debugevent);
map.on('polylinemeasure:move', debugevent);
map.on('polylinemeasure:remove', debugevent);

  // DEFAULT EXTENT
L.control.defaultExtent({position: 'bottomright'}).addTo(map);


var controlSearch = new L.Control.Search({
    position: 'topleft',
    layer: layer_prioritas_search,
    initial: false,
    zoom: 13,
    marker: false,
    textPlaceholder: 'search...'
});

  map.addControl(controlSearch); 

  var drawControl = new L.Control.Draw({
    draw: {
      position: 'topleft',
      polyline: true,
      polygon: true,
      rectangle: false,
      circle: false,
      marker: true,
      circlemarker: false
    },
    edit: false
  });
  
  map.addControl(drawControl);


  // controlSearch.on('search:collapsed', function(e) {
  //     map.setView([0.539731,118.7240573], 4);
  // })

// document.getElementById("layer_pmi").addEventListener("change", function(){
// if (document.getElementById(this.id).checked == true){
// myData.addTo(map);
// } else {
// myData.remove(map);
// }
// });

  <?php
    $queri = mysqli_query($db,"Select * From layermap order by id");
        while ($datamap = mysqli_fetch_array ($queri)) {
      ?>


   <?php
echo "document.getElementById('".$datamap['varname']."').addEventListener('change', function(){
if (document.getElementById(this.id).checked == true){
".$datamap['varname'].".addTo(map);
} else {
".$datamap['varname'].".remove(map);
}
});
      ";
    }
  ?>

  document.getElementById("pilihbasemap").addEventListener("change", function () {
    // $('#pilihbasemap').change(function () {
    selected_value = $("input[name='base']:checked").val();
    if (selected_value == 'baseEsri') {
        baseEsri.addTo(map);
        baseOsm.remove();
        baseCarto.remove();
    } else if (selected_value == 'baseOsm') {
        baseOsm.addTo(map);
        baseEsri.remove();
        baseCarto.remove();
    } else if (selected_value == 'baseCarto') {
        baseCarto.addTo(map);
        baseEsri.remove();
        baseOsm.remove();
    }
});

 setTimeout(function(){ map.invalidateSize(true)}, 300);
</script>