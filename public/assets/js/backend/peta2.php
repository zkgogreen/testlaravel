<script type="text/javascript">

var GABUNG2 = new L.LayerGroup();
var items = [];

map = L.map('map', {}).setView([0.539731,118.7240573], 4);

var content = "<div class='table-responsive'><table class='table table-striped table-bordered table-condensed' style='margin-bottom:0; font-size:12px;'><tr><th style='width:30%;'>Kecamatan</th><td>tes</td></tr><tr><th style='width:30%;'>Luas Area (Km2)</th><td>tes</td></tr><tr><th style='width:30%;'>Kepadatan Penduduk</th><td>tes</td></tr></table></div>";

  <?php
      $queri = mysqli_query($db,"Select * From layermap where layertype = 'POLYGON' OR 'POLYLINE' order by id");
        while ($datamap = mysqli_fetch_array ($queri)) {
      ?>

        <?php
      echo "
      ".$datamap['varname']." = new L.GeoJSON.AJAX('./assets/layer/".$datamap['filename'].".php',{
        style: function(feature){
       var warna = feature.properties.color; 
        return {color: '#000', weight: 1, fillColor: warna, fillOpacity: 0.6 }; 
      },
       onEachFeature: function(feature, layer){
        if (feature.properties) {
        items.push(layer); 
          layer.on('click', function(e) {
      $('#feature-title').html();
      $('#feature-info').html(content);
      $('#featureModal').modal('show'); 
});
    }      
  }
    });
      ";
    }
  ?>


var IconPeserta = L.Icon.extend({
    options:{
        iconSize: [15,15],
        // shadowSize: [36,36],
        iconAnchor: [18,18],
        shadowAnchor: [18,18],
        popupAnchor: [0,-6]
    }
});

// Create specific icons
var IPeserta1 = new IconPeserta({iconUrl: "./assets/images/legend/pu.png"});
var IPeserta2 = new IconPeserta({iconUrl: "./assets/images/legend/bpu.png"});
var IPeserta3 = new IconPeserta({iconUrl: "./assets/images/legend/non_bpjamsostek.png"});

var myData =  L.layerGroup([]);

var layer_PMI= new L.GeoJSON.AJAX("./assets/layer/layer_pmi.php",{
       pointToLayer: function (feature, latlng) {
                var marker = L.marker(latlng,{icon: IPeserta1});
        return marker;
      },
       onEachFeature: function(feature, layer){
if (feature.properties) {
                var content = "<div class='table-responsive'><table class='table table-striped table-bordered table-condensed' style='margin-bottom:0; font-size:12px;'>" +  
          "<tr><th style='width:30%;'>Nama UTD</th><td>" + feature.properties.nama_utd + "</td></tr>" + 
          "<tr><th style='width:30%;'>Alamat</th><td>" + feature.properties.alamat + "</td></tr>" + 
          "<tr><th style='width:30%;'>Telpon</th><td>" + feature.properties.telpon + "</td></tr>" +
          "<tr><th style='width:30%;'>Situs</th><td>" + feature.properties.situs + "</td></tr></table></div>";
          layer.on('click', function(e) {
      $("#feature-title").html("LOKASI PMI");
      $("#feature-info").html(content);
      $("#featureModal").modal("show"); 
});
           }
    }
    });

 myData.addLayer(layer_PMI); 


 function FilterSelect() {
      //  $('#filter_run').click(function(e) {
      //     e.preventDefault();
        var prov_fil = document.getElementById("_provinsi").value;
        var kabkot_fil = document.getElementById("_kabkot").value;
        // console.log(prov_fil);
        //  console.log(kabkot_fil);
        myData.clearLayers();
        map.removeLayer(myData);
var layer_PMI = new L.GeoJSON.AJAX("./assets/layer/layer_pmi.php",{
       pointToLayer: function (feature, latlng) {
                var marker = L.marker(latlng,{icon: IPeserta1});
        return marker;
      },
          filter: function(feature, layer) {   
          if( prov_fil == "pilihprovinsi") {
            var filter = (feature.properties.priority == '1');
          }else if (kabkot_fil == "piilhkabkot") {
            var filter = (feature.properties.provinsi == prov_fil);
          }else{
           var filter = (feature.properties.provinsi == prov_fil && feature.properties.kabkot == kabkot_fil);
          }
          return filter;
        },
           // filter: function(feature, layer) {   
           //       return (feature.properties.provinsi == prov_fil && feature.properties.kabkot == kabkot_fil);
           //  },
       onEachFeature: function(feature, layer){
if (feature.properties) {
                var content = "<div class='table-responsive'><table class='table table-striped table-bordered table-condensed' style='margin-bottom:0; font-size:12px;'>" +  
          "<tr><th style='width:30%;'>Nama UTD</th><td>" + feature.properties.nama_utd + "</td></tr>" + 
          "<tr><th style='width:30%;'>Alamat</th><td>" + feature.properties.alamat + "</td></tr>" + 
          "<tr><th style='width:30%;'>Telpon</th><td>" + feature.properties.telpon + "</td></tr>" +
          "<tr><th style='width:30%;'>Situs</th><td>" + feature.properties.situs + "</td></tr></table></div>";
          layer.on('click', function(e) {
      $("#feature-title").html("LOKASI PMI");
      $("#feature-info").html(content);
      $("#featureModal").modal("show"); 
});
           }
    }
    });

 myData.addLayer(layer_PMI); 
    myData.addTo(map);  
  }

var smallIcon4 = new L.Icon({
      iconSize: [1, 1],
      iconAnchor: [1, 2],
      popupAnchor:  [1, 1],
      iconUrl: 'img/custom-icon.png'
    });
var layer_pmi2 = new L.GeoJSON.AJAX("./assets/layer/layer_pmi.php",{
      pointToLayer: function(feature, latlng) {
        // console.log(latlng, feature);
        return L.marker(latlng, {
          icon: smallIcon4,
          title: feature.properties.nama_utd
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

  // DEFAULT EXTENT
L.control.defaultExtent({position: 'bottomright'}).addTo(map);

// LEGEND
// var legend = L.control({position: 'bottomleft'});

// legend.onAdd = function (map) {

//     var div = L.DomUtil.create('div', 'info-legend'),
//                 grades = ["Terdaftar PU", "Terdaftar BPU", "Non Bpjamsostek"],
//         labels = ["./assets/images/legend/pu.png","./assets/images/legend/bpu.png","./assets/images/legend/non_bpjamsostek.png"];

//     // loop through our density intervals and generate a label with a colored square for each interval
//     for (var i = 0; i < grades.length; i++) {
//    div.innerHTML += "<img src="+ labels[i] +" height='15' >" + grades[i] + '<br>';
//  }
//     return div;
// };

// legend.addTo(map);


  var controlSearch = new L.Control.Search({
    position:'topleft',    
    layer: layer_pmi2,
    initial: false,
    zoom: 15,
    marker: false,
    textPlaceholder: 'search...'
  });

  map.addControl(controlSearch); 

  // controlSearch.on('search:collapsed', function(e) {
  //     map.setView([0.539731,118.7240573], 4);
  // })

document.getElementById("layer_pmi").addEventListener("change", function(){
if (document.getElementById(this.id).checked == true){
myData.addTo(map);
} else {
myData.remove(map);
}
});

  <?php
    $queri = mysqli_query($db,"Select * From layermap where layertype = 'POLYGON' OR 'POLYLINE' order by id");
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