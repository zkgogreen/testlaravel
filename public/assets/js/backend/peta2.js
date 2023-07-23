// init();
// function init() {
// MENGATUR TITIK KOORDINAT TITIK TENGAN & LEVEL ZOOM PADA BASEMAP
// SKALA PETA
// var graphicScale = L.control.graphicScale({fill: 'hollow', labelPlacement: 'auto', showSubunits: true, maxUnitsWidth: '150'}).addTo(map);
// // MOUSE POSITION
// L.control.mouseCoordinate({utm:false, position: 'bottomleft'}).addTo(map);
// VARIABEL GABUNG

  $("#kategori").on('change',function(){
    var kategori= $(this).val();

    $.ajax({
      url: 'request_kecamatan.php' ,
      type: 'POST',
      data: "kategori="+kategori,
      success: function(kecamatan)
      {
        $("#kecamatan").html(kecamatan);
      }

    });
  });
   $("#kecamatan").on('change',function(){
    var kecamatan= $(this).val();

    $.ajax({
      url: 'request_kelurahan.php' ,
      type: 'POST',
      data: "kecamatan="+kecamatan,
      success: function(kelurahan)
      {
        $("#kelurahan").html(kelurahan);
      }

    });
  });

  //  $("#kabkot").on('change',function(){
  //   var kabkot= $(this).val();

  //   $.ajax({
  //     url: 'request_kecamatan.php' ,
  //     type: 'POST',
  //     data: "kabkot="+kabkot,
  //     success: function(kecamatan)
  //     {
  //       $("#kecamatan").html(kecamatan);
  //     }

  //   });
  // });

  //    $("#kecamatan").on('change',function(){
  //   var kecamatan= $(this).val();

  //   $.ajax({
  //     url: 'request_kelurahan.php' ,
  //     type: 'POST',
  //     data: "kecamatan="+kecamatan,
  //     success: function(kelurahan)
  //     {
  //       $("#kelurahan").html(kelurahan);
  //     }

  //   });
  // });


var GABUNG2 = new L.LayerGroup();
var items = [];

// var url = 'http://localhost:8080/geoserver/bpjs/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=bpjs:peserta&moutputFormat=text%2Fjavascript';

var url = 'http://localhost:8080/geoserver/bpjs/wms';

var layer_adm = L.tileLayer.betterWmsADM(url, {
    layers: 'bpjs:administrasi',
    format: 'image/png',
    transparent: true,
    zIndex: 1000
});

var layer_pu = L.tileLayer.betterWmsPU(url, {
    layers: 'bpjs:peserta',
    format: 'image/png',
    transparent: true,
    zIndex: 1000,
    cql_filter :"kategori='Terdaftar PU'"
});
layer_pu.setParams({});
$('#FILTER_RUN').click(function(e) {
    e.preventDefault();
    var kategori = document.getElementById("kategori").value;
    var kecamatan = document.getElementById("kecamatan").value;
    var kelurahan = document.getElementById("kelurahan").value;
    if(kategori == 'pilihsemuakategori') {
            var filter = "data='BPJS'";
    }else if(kecamatan == 'pilihkecamatan'){
            var filter = "kategori='" + kategori + "'";
    }else if(kelurahan == 'pilihkelurahan'){
            var filter = "kategori='" + kategori + "' and kecamatan='" + kecamatan + "'";
        }else{
           var filter ="kategori='" + kategori + "' + and kecamatan='" + kecamatan + "' and kelurahan='" + kelurahan + "'";
        }
return layer_pu.setParams({cql_filter :filter}); 
});

var layer_bpu = L.tileLayer.betterWmsBPU(url, {
    layers: 'pln_berau:peserta',
    format: 'image/png',
    transparent: true,
    zIndex: 1000,
    cql_filter :"kategori='Terdaftar BPU'"
});
layer_bpu.setParams({});
$('#FILTER_RUN').click(function(e) {
    e.preventDefault();
    var kategori = document.getElementById("kategori").value;
    var kecamatan = document.getElementById("kecamatan").value;
    var kelurahan = document.getElementById("kelurahan").value;
    if(kategori == 'pilihsemuakategori') {
            var filter = "data='BPJS'";
    }else if(kecamatan == 'pilihkecamatan'){
            var filter = "kategori='" + kategori + "'";
    }else if(kelurahan == 'pilihkelurahan'){
            var filter = "kategori='" + kategori + "' and kecamatan='" + kecamatan + "'";
        }else{
           var filter ="kategori='" + kategori + "' + and kecamatan='" + kecamatan + "' and kelurahan='" + kelurahan + "'";
        }
return layer_bpu.setParams({cql_filter :filter}); 
});

var layer_non_bpjamsostek = L.tileLayer.betterWmsNonBpjamsostek(url, {
    layers: 'pln_berau:peserta',
    format: 'image/png',
    transparent: true,
    zIndex: 1000,
    cql_filter :"kategori='Belum Terdaftar Bpjamsostek'"
});
layer_non_bpjamsostek.setParams({});
$('#FILTER_RUN').click(function(e) {
    e.preventDefault();
    var kategori = document.getElementById("kategori").value;
    var kecamatan = document.getElementById("kecamatan").value;
    var kelurahan = document.getElementById("kelurahan").value;
    if(kategori == 'pilihsemuakategori') {
            var filter = "data='BPJS'";
    }else if(kecamatan == 'pilihkecamatan'){
            var filter = "kategori='" + kategori + "'";
    }else if(kelurahan == 'pilihkelurahan'){
            var filter = "kategori='" + kategori + "' and kecamatan='" + kecamatan + "'";
        }else{
           var filter ="kategori='" + kategori + "' + and kecamatan='" + kecamatan + "' and kelurahan='" + kelurahan + "'";
        }
return layer_non_bpjamsostek.setParams({cql_filter :filter}); 
});


  

map = L.map('map', {}).setView([-7.267998,112.7203173], 11);

// get color depending on population density value
  // function getColor(d) {
  //   return d > 200000  ? '#263e99' :
  //       d > 150000   ? '#2c7fb8' :
  //       d > 100000   ? '#41b6c4' :
  //       d > 50000   ? '#a1dab4' :
  //             '#f2fac9';
  // }

  function style(feature) {
    return {
      weight: 2,
      opacity: 1,
      color: '#999',
      dashArray: '3',
      fillOpacity: 0.7,
      fillColor: '#f2fac9'
    };
  }

function highlightFeature(e) {
    var layer = e.target;

    layer.setStyle({
      weight: 3,
      color: '#666',
      dashArray: '',
      fillOpacity: 0.7
    });

    if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
      layer.bringToFront();
    }

    // info.update(layer.feature.properties);
  }

  var layer_surabaya;

  function resetHighlight(e) {
    layer_surabaya.resetStyle(e.target);
    // info.update();
  }

  function zoomToFeature(e) {
    map.fitBounds(e.target.getBounds());
  }

  function onEachFeature(feature, layer) {
    layer.on({
      mouseover: highlightFeature,
      mouseout: resetHighlight,
      click: zoomToFeature
    });
  }
layer_surabaya = new L.GeoJSON.AJAX("./assets/layer/request_layer_adm.php",{
    style: style,
    onEachFeature: onEachFeature
  }).addTo(map);



var smallIcon4 = new L.Icon({
      iconSize: [1, 1],
      iconAnchor: [1, 2],
      popupAnchor:  [1, 1],
      iconUrl: 'img/custom-icon.png'
    });
var layer_peserta = new L.GeoJSON.AJAX("./assets/layer/request_layer_peserta.php",{
      pointToLayer: function(feature, latlng) {
        // console.log(latlng, feature);
        return L.marker(latlng, {
          icon: smallIcon4,
          title: feature.properties.nik
        });
      }
   }).addTo(map); 

var baseMaps = {
// "<img src='img/basemap3.png' height='18px'/> Basemap Topography": L.tileLayer.provider('Esri.WorldTopoMap').addTo(map), 
"<img src='img/basemap3.png' height='18px'/> Esri World Imagery": L.tileLayer.provider('Esri.WorldImagery').addTo(map),
"<img src='img/basemap3.png' height='18px'/> Open Street Map": L.tileLayer.provider('OpenStreetMap'),
        };


L.control.fullscreen({
  position: 'bottomright', // change the position of the button can be topleft, topright, bottomright or bottomleft, defaut topleft
  title: 'Show me the fullscreen !', // change the title of the button, default Full Screen
  titleCancel: 'Exit fullscreen mode', // change the title of the button when fullscreen is on, default Exit Full Screen
  content: null, // change the content of the button, can be HTML, default null
  forceSeparateButton: false, // force seperate button to detach from zoom buttons, default false
  forcePseudoFullscreen: false, // force use of pseudo full screen even if full screen API is available, default false
  fullscreenElement: false // Dom element to render in full screen, false by default, fallback to map._container
}).addTo(map);

  // DEFAULT EXTENT
L.control.defaultExtent({position: 'bottomright'}).addTo(map);

// LEGEND
var legend = L.control({position: 'bottomleft'});

legend.onAdd = function (map) {

    var div = L.DomUtil.create('div', 'info-legend'),
                grades = ["Terdaftar PU", "Terdaftar BPU", "Non Bpjamsostek"],
        labels = ["./assets/images/legend/pu.png","./assets/images/legend/bpu.png","./assets/images/legend/non_bpjamsostek.png"];

    // loop through our density intervals and generate a label with a colored square for each interval
    for (var i = 0; i < grades.length; i++) {
   div.innerHTML += "<img src="+ labels[i] +" height='15' >" + grades[i] + '<br>';
 }
    return div;
};

legend.addTo(map);


  var controlSearch = new L.Control.Search({
    position:'topleft',    
    layer: layer_peserta,
    initial: false,
    zoom: 15,
    marker: false,
    textPlaceholder: 'search...'
  });

  map.addControl(controlSearch); 

  // controlSearch.on('search:collapsed', function(e) {
  //     map.setView([0.539731,118.7240573], 4);
  // })

document.getElementById("layer_adm").addEventListener("change", function(){
if (document.getElementById(this.id).checked == true){
layer_adm.addTo(map);
} else {
layer_adm.remove(map);
}
});
document.getElementById("layer_pu").addEventListener("change", function(){
if (document.getElementById(this.id).checked == true){
layer_pu.addTo(map);
} else {
layer_pu.remove(map);
}
});
document.getElementById("layer_bpu").addEventListener("change", function(){
if (document.getElementById(this.id).checked == true){
layer_bpu.addTo(map);
} else {
layer_bpu.remove(map);
}
});
document.getElementById("layer_non_bpjamsostek").addEventListener("change", function(){
if (document.getElementById(this.id).checked == true){
layer_non_bpjamsostek.addTo(map);
} else {
layer_non_bpjamsostek.remove(map);
}
});

 setTimeout(function(){ map.invalidateSize(true)}, 300);
 // $("#mytabs").bootstrapDynamicTabs();
 // });