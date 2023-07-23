// init();
// function init() {
// MENGATUR TITIK KOORDINAT TITIK TENGAN & LEVEL ZOOM PADA BASEMAP
// SKALA PETA
// var graphicScale = L.control.graphicScale({fill: 'hollow', labelPlacement: 'auto', showSubunits: true, maxUnitsWidth: '150'}).addTo(map);
// // MOUSE POSITION
// L.control.mouseCoordinate({utm:false, position: 'bottomleft'}).addTo(map);
// VARIABEL GABUNG

  // $("#kategori").on('change',function(){
  //   var kategori= $(this).val();

  //   $.ajax({
  //     url: 'request_kabkot.php' ,
  //     type: 'POST',
  //     data: "kategori="+kategori,
  //     success: function(kabkot)
  //     {
  //       $("#kabkot").html(kabkot);
  //     }

  //   });
  // });
  //   $("#kabkot").on('change',function(){
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


var GABUNG2 = new L.LayerGroup();
var items = [];

// var url = 'http://localhost:8080/geoserver/bpjs/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=bpjs:peserta&moutputFormat=text%2Fjavascript';

// var url = 'http://localhost:8080/geoserver/bpjs/wms';

// var layer_adm_kec = L.tileLayer.betterWmsADMKec(url, {
//     layers: 'bpjs:adm_kecamatan',
//     format: 'image/png',
//     transparent: true,
//     version: '1.1.0',
//     attribution: "myattribution",
//     zIndex: 1000
// });

// var layer_adm_kel = L.tileLayer.betterWmsADMKel(url, {
//     layers: 'bpjs:adm_kelurahan',
//     format: 'image/png',
//     transparent: true,
//     version: '1.1.0',
//     attribution: "myattribution",
//     zIndex: 1000
// });

// var layer_adm = L.tileLayer.betterWmsADMDesa(url, {
//     layers: 'bpjs:jatim',
//     format: 'image/png',
//     transparent: true,
//     version: '1.1.0',
//     attribution: "myattribution",
//     zIndex: 1000
// });

// var layer_pesertaBPJS = L.tileLayer.betterWmsPU(url, {
//     layers: 'bpjs:peserta',
//     format: 'image/png',
//     transparent: true,
//     zIndex: 1000
// });
// layer_pesertaBPJS.setParams({});
// $('#FILTER_RUN').click(function(e) {
//     e.preventDefault();
// function filterBPJS() {
//     var kategori = document.getElementById("kategori").value;
//     var kabkot = document.getElementById("kabkot").value;
//     var kecamatan = document.getElementById("kecamatan").value;
//     var kelurahan = document.getElementById("kelurahan").value;
//     var jenis_data = document.getElementById("jenisdata").value;
//     if(kategori == 'pilihsemuakategori') {
//             var filter = "data='BPJS'";
//     }else if(kabkot == 'piilhkabkot'){
//             var filter = "kategori='" + kategori + "'";
//     }else if(kecamatan == 'pilihkecamatan'){
//             var filter = "kategori='" + kategori + "' and kabkot='" + kabkot + "'";
//     }else if(kelurahan == 'pilihkelurahan'){
//             var filter = "kategori='" + kategori + "' and kabkot='" + kabkot + "' and kecamatan='" + kecamatan + "'";
//         }else{
//            var filter ="kategori='" + kategori + "' and kabkot='" + kabkot + "' and kecamatan='" + kecamatan + "' and kelurahan='" + kelurahan + "' and data='BPJS'";
//         }
// return layer_pesertaBPJS.setParams({cql_filter :filter}); 
//   }

map = L.map('map', {}).setView([-7.267998,112.7203173], 11);

// get color depending on population density value
  function getColore(d) {  
    return d > 90.1  ? '#7bc043' :
        d > 70.1   ? '#fdf498' :
        d > 50.1   ? '#f37736' :
        d > 30.1   ? '#ff6289' :
        d > 1   ? '#ee4035' :
              '#f2fac9';
  }

  function style(feature) {
    return {
      weight: 1.5,
      opacity: 1,
      color: '#999',
      fillOpacity: 0.6,
      fillColor: getColore(feature.properties.persen_pu)
    };
  }

  var layer_admkecPU;

  function onEachFeature1(feature, layer) {
    if (feature.properties) {
          var content = "<div class='col' id='grafik_pie1' style='padding:0;'></div>" +
          "<script type='text/javascript'>" +
          "Highcharts.chart('grafik_pie1', {chart: {plotBackgroundColor: null, plotBorderWidth: null, plotShadow: false, type: 'pie'" +
          "},title: {text: 'STATUS PEKERJAAN'}, tooltip: {" +
          "pointFormat: '{series.name}: <b>{point.y} ({point.percentage:.1f}%)</b>'}," +
          "plotOptions: {pie: {allowPointSelect: true, cursor: 'pointer',dataLabels: {" +
          "enabled: true, format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f}%)'," +
          "style: {color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'} }}}," +
          "series: [{name: 'Status Pekerjaan',olorByPoint: true, data: [{ name: 'Belum/tidak bekerja'," +
          "y: " + feature.properties.belum_tidak_bekerja + ",sliced: true, selected: true}, {" +
          "name: 'Aparatur Pejabat Negara', y: " + feature.properties.aparatur_pejabat_negara+ "}, {" +
          "name: 'Tenaga Pengajar',y: " + feature.properties.tenaga_pengajar + "}, {name: 'Wiraswasta'," +
          "y: " + feature.properties.wiraswasta + "}, {name: 'Pertanian dan Peternakan'," +
          "y: " + feature.properties.pertanian_dan_peternakan + "}, {name: 'Nelayan', y: " + feature.properties.nelayan + "" +
          "}, {name: 'Tenaga Kesehatan', y: " + feature.properties.tenaga_kesehatan + "}, {" +
          "name: 'Pensiunan',y: "+ feature.properties.pensiunan + "}, {name: 'Pekerjaan Lainnya'," +
          "y: " + feature.properties.pekerjaan_lainnya + "}]}]}); </script>";
          var content2 = "<div class='table-responsive'><table class='table' style='margin-bottom:0;'>" + 
            "<tr><th>JUMLAH PENDUDUK</th><td>" + feature.properties.penduduk + " Jiwa</td></tr>" + 
            "<tr><th>PERSENTASE PU</th><td>" + feature.properties.persen_pu + " %</td></tr>" +
            "<tr><th>KECAMATAN</th><td>" + feature.properties.kecamatan + "</td></tr>" +
            "<tr><th>KAB/ KOTA</th><td>" + feature.properties.kabkot + "</td></tr>" + 
            "<tr><th>PROVINSI</th><td>" + feature.properties.provinsi + "</td></tr></table></div>";
          layer.on('click', function(e) {
      $("#feature-title5").html("ADM KECAMATAN PU");
       $("#contentChart").html(content);
       $("#contentTable").html(content2);
      $("#modalkecamatan").modal("show"); 
});
           }
  }
layer_admkecPU = new L.GeoJSON.AJAX("./assets/layer/request_layer_adm_kec.php",{
    style: style,
    onEachFeature: onEachFeature1
  });


 function style2(feature) {
    return {
      weight: 1.5,
      opacity: 1,
      color: '#999',
      fillOpacity: 0.6,
      fillColor: getColore(feature.properties.persen_bpu)
    };
  }

  var layer_admkecBPU;

  function onEachFeature2(feature, layer) {
    if (feature.properties) {
    var content = "<div class='col' id='grafik_pie1' style='padding:0;'></div>" +
          "<script type='text/javascript'>" +
          "Highcharts.chart('grafik_pie1', {chart: {plotBackgroundColor: null, plotBorderWidth: null, plotShadow: false, type: 'pie'" +
          "},title: {text: 'STATUS PEKERJAAN'}, tooltip: {" +
          "pointFormat: '{series.name}: <b>{point.y} ({point.percentage:.1f}%)</b>'}," +
          "plotOptions: {pie: {allowPointSelect: true, cursor: 'pointer',dataLabels: {" +
          "enabled: true, format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f}%)'," +
          "style: {color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'} }}}," +
          "series: [{name: 'Status Pekerjaan',olorByPoint: true, data: [{ name: 'Belum/tidak bekerja'," +
          "y: " + feature.properties.belum_tidak_bekerja + ",sliced: true, selected: true}, {" +
          "name: 'Aparatur Pejabat Negara', y: " + feature.properties.aparatur_pejabat_negara+ "}, {" +
          "name: 'Tenaga Pengajar',y: " + feature.properties.tenaga_pengajar + "}, {name: 'Wiraswasta'," +
          "y: " + feature.properties.wiraswasta + "}, {name: 'Pertanian dan Peternakan'," +
          "y: " + feature.properties.pertanian_dan_peternakan + "}, {name: 'Nelayan', y: " + feature.properties.nelayan + "" +
          "}, {name: 'Tenaga Kesehatan', y: " + feature.properties.tenaga_kesehatan + "}, {" +
          "name: 'Pensiunan',y: "+ feature.properties.pensiunan + "}, {name: 'Pekerjaan Lainnya'," +
          "y: " + feature.properties.pekerjaan_lainnya + "}]}]}); </script>";
          var content2 = "<div class='table-responsive'><table class='table' style='margin-bottom:0;'>" + 
            "<tr><th>JUMLAH PENDUDUK</th><td>" + feature.properties.penduduk + " Jiwa</td></tr>" + 
            "<tr><th>PERSENTASE BPU</th><td>" + feature.properties.persen_bpu + " %</td></tr>" +
            "<tr><th>KECAMATAN</th><td>" + feature.properties.kecamatan + "</td></tr>" +
            "<tr><th>KAB/ KOTA</th><td>" + feature.properties.kabkot + "</td></tr>" + 
            "<tr><th>PROVINSI</th><td>" + feature.properties.provinsi + "</td></tr></table></div>";
          layer.on('click', function(e) {
      $("#feature-title5").html("ADM KECAMATAN BPU");
       $("#contentChart").html(content);
       $("#contentTable").html(content2);
      $("#modalkecamatan").modal("show"); 
});
           }
  }
layer_admkecBPU = new L.GeoJSON.AJAX("./assets/layer/request_layer_adm_kec.php",{
    style: style2,
    onEachFeature: onEachFeature2
  });


 function style3(feature) {
    return {
      weight: 1.5,
      opacity: 1,
      color: '#999',
      fillOpacity: 0.6,
      fillColor: getColore(feature.properties.persen_pu_bpu)
    };
  }

  var layer_admkecPUBPU;

     function onEachFeature3(feature, layer) {
    if (feature.properties) {
          var content = "<div class='col' id='grafik_pie1' style='padding:0;'></div>" +
          "<script type='text/javascript'>" +
          "Highcharts.chart('grafik_pie1', {chart: {plotBackgroundColor: null, plotBorderWidth: null, plotShadow: false, type: 'pie'" +
          "},title: {text: 'STATUS PEKERJAAN'}, tooltip: {" +
          "pointFormat: '{series.name}: <b>{point.y} ({point.percentage:.1f}%)</b>'}," +
          "plotOptions: {pie: {allowPointSelect: true, cursor: 'pointer',dataLabels: {" +
          "enabled: true, format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f}%)'," +
          "style: {color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'} }}}," +
          "series: [{name: 'Status Pekerjaan',olorByPoint: true, data: [{ name: 'Belum/tidak bekerja'," +
          "y: " + feature.properties.belum_tidak_bekerja + ",sliced: true, selected: true}, {" +
          "name: 'Aparatur Pejabat Negara', y: " + feature.properties.aparatur_pejabat_negara+ "}, {" +
          "name: 'Tenaga Pengajar',y: " + feature.properties.tenaga_pengajar + "}, {name: 'Wiraswasta'," +
          "y: " + feature.properties.wiraswasta + "}, {name: 'Pertanian dan Peternakan'," +
          "y: " + feature.properties.pertanian_dan_peternakan + "}, {name: 'Nelayan', y: " + feature.properties.nelayan + "" +
          "}, {name: 'Tenaga Kesehatan', y: " + feature.properties.tenaga_kesehatan + "}, {" +
          "name: 'Pensiunan',y: "+ feature.properties.pensiunan + "}, {name: 'Pekerjaan Lainnya'," +
          "y: " + feature.properties.pekerjaan_lainnya + "}]}]}); </script>";
          var content2 = "<div class='table-responsive'><table class='table' style='margin-bottom:0;'>" + 
            "<tr><th>JUMLAH PENDUDUK</th><td>" + feature.properties.penduduk + " Jiwa</td></tr>" + 
            "<tr><th>PERSENTASE PU-BPU</th><td>" + feature.properties.persen_pu_bpu + " %</td></tr>" +
            "<tr><th>KECAMATAN</th><td>" + feature.properties.kecamatan + "</td></tr>" +
            "<tr><th>KAB/ KOTA</th><td>" + feature.properties.kabkot + "</td></tr>" + 
            "<tr><th>PROVINSI</th><td>" + feature.properties.provinsi + "</td></tr></table></div>"
          layer.on('click', function(e) {
      $("#feature-title5").html("ADM KECAMATAN PU-BPU");
       $("#contentChart").html(content);
       $("#contentTable").html(content2);
      $("#modalkecamatan").modal("show"); 
});
           }
  }

layer_admkecPUBPU = new L.GeoJSON.AJAX("./assets/layer/request_layer_adm_kec.php",{
    style: style3,
    onEachFeature: onEachFeature3
  });

var layer_admkelPU;

     function onEachFeature4(feature, layer) {
    if (feature.properties) {
      var content = "<div class='col' id='grafik_pie1' style='padding:0;'></div>" +
          "<script type='text/javascript'>" +
          "Highcharts.chart('grafik_pie1', {chart: {plotBackgroundColor: null, plotBorderWidth: null, plotShadow: false, type: 'pie'" +
          "},title: {text: 'STATUS PEKERJAAN'}, tooltip: {" +
          "pointFormat: '{series.name}: <b>{point.y} ({point.percentage:.1f}%)</b>'}," +
          "plotOptions: {pie: {allowPointSelect: true, cursor: 'pointer',dataLabels: {" +
          "enabled: true, format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f}%)'," +
          "style: {color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'} }}}," +
          "series: [{name: 'Status Pekerjaan',olorByPoint: true, data: [{ name: 'Belum/tidak bekerja'," +
          "y: " + feature.properties.belum_tidak_bekerja + ",sliced: true, selected: true}, {" +
          "name: 'Aparatur Pejabat Negara', y: " + feature.properties.aparatur_pejabat_negara+ "}, {" +
          "name: 'Tenaga Pengajar',y: " + feature.properties.tenaga_pengajar + "}, {name: 'Wiraswasta'," +
          "y: " + feature.properties.wiraswasta + "}, {name: 'Pertanian dan Peternakan'," +
          "y: " + feature.properties.pertanian_dan_peternakan + "}, {name: 'Nelayan', y: " + feature.properties.nelayan + "" +
          "}, {name: 'Tenaga Kesehatan', y: " + feature.properties.tenaga_kesehatan + "}, {" +
          "name: 'Pensiunan',y: "+ feature.properties.pensiunan + "}, {name: 'Pekerjaan Lainnya'," +
          "y: " + feature.properties.pekerjaan_lainnya + "}]}]}); </script>";
          var content2 = "<div class='table-responsive'><table class='table' style='margin-bottom:0;'>" + 
           "<tr><th>JUMLAH PENDUDUK</th><td>" + feature.properties.jumlah_penduduk + " Jiwa</td></tr>" + 
            "<tr><th>JUMLAH KK</th><td>" + feature.properties.jumlah_kk + "</td></tr>" +
            "<tr><th>PERSENTASE PU</th><td>" + feature.properties.persen_pu + " %</td></tr>" +
            "<tr><th>DESA/ KELURAHAN</th><td>" + feature.properties.kelurahan + "</td></tr>" +
            "<tr><th>KECAMATAN</th><td>" + feature.properties.kecamatan + "</td></tr>" +
            "<tr><th>KAB/ KOTA</th><td>" + feature.properties.kabkot + "</td></tr>" + 
            "<tr><th>PROVINSI</th><td>" + feature.properties.provinsi + "</td></tr></table></div>";
          layer.on('click', function(e) {
        $("#feature-title5").html("ADM KELURAHAN PU");
        $("#contentChart").html(content);
        $("#contentTable").html(content2);
        $("#modalkecamatan").modal("show"); 
});
           }
  }
layer_admkelPU = new L.GeoJSON.AJAX("./assets/layer/request_layer_adm_kel.php",{
    style: style,
    onEachFeature: onEachFeature4
  });

var layer_admkelBPU;

     function onEachFeature5(feature, layer) {
    if (feature.properties) {
      var content = "<div class='col' id='grafik_pie1' style='padding:0;'></div>" +
          "<script type='text/javascript'>" +
          "Highcharts.chart('grafik_pie1', {chart: {plotBackgroundColor: null, plotBorderWidth: null, plotShadow: false, type: 'pie'" +
          "},title: {text: 'STATUS PEKERJAAN'}, tooltip: {" +
          "pointFormat: '{series.name}: <b>{point.y} ({point.percentage:.1f}%)</b>'}," +
          "plotOptions: {pie: {allowPointSelect: true, cursor: 'pointer',dataLabels: {" +
          "enabled: true, format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f}%)'," +
          "style: {color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'} }}}," +
          "series: [{name: 'Status Pekerjaan',olorByPoint: true, data: [{ name: 'Belum/tidak bekerja'," +
          "y: " + feature.properties.belum_tidak_bekerja + ",sliced: true, selected: true}, {" +
          "name: 'Aparatur Pejabat Negara', y: " + feature.properties.aparatur_pejabat_negara+ "}, {" +
          "name: 'Tenaga Pengajar',y: " + feature.properties.tenaga_pengajar + "}, {name: 'Wiraswasta'," +
          "y: " + feature.properties.wiraswasta + "}, {name: 'Pertanian dan Peternakan'," +
          "y: " + feature.properties.pertanian_dan_peternakan + "}, {name: 'Nelayan', y: " + feature.properties.nelayan + "" +
          "}, {name: 'Tenaga Kesehatan', y: " + feature.properties.tenaga_kesehatan + "}, {" +
          "name: 'Pensiunan',y: "+ feature.properties.pensiunan + "}, {name: 'Pekerjaan Lainnya'," +
          "y: " + feature.properties.pekerjaan_lainnya + "}]}]}); </script>";
          var content2 = "<div class='table-responsive'><table class='table' style='margin-bottom:0;'>" + 
            "<tr><th>JUMLAH PENDUDUK</th><td>" + feature.properties.jumlah_penduduk + " Jiwa</td></tr>" + 
            "<tr><th>JUMLAH KK</th><td>" + feature.properties.jumlah_kk + "</td></tr>" +
            "<tr><th>PERSENTASE BPU</th><td>" + feature.properties.persen_bpu + " %</td></tr>" +
            "<tr><th>DESA/ KELURAHAN</th><td>" + feature.properties.kelurahan + "</td></tr>" +
            "<tr><th>KECAMATAN</th><td>" + feature.properties.kecamatan + "</td></tr>" +
            "<tr><th>KAB/ KOTA</th><td>" + feature.properties.kabkot + "</td></tr>" + 
            "<tr><th>PROVINSI</th><td>" + feature.properties.provinsi + "</td></tr></table></div>";
          layer.on('click', function(e) {
      $("#feature-title5").html("ADM KELURAHAN BPU");
         $("#contentChart").html(content);
       $("#contentTable").html(content2);
      $("#modalkecamatan").modal("show"); 
});
           }
  }
layer_admkelBPU = new L.GeoJSON.AJAX("./assets/layer/request_layer_adm_kel.php",{
    style: style2,
    onEachFeature: onEachFeature5
  });

  var layer_admkelPUBPU;

     function onEachFeature6(feature, layer) {
    if (feature.properties) {
      var content = "<div class='col' id='grafik_pie1' style='padding:0;'></div>" +
          "<script type='text/javascript'>" +
          "Highcharts.chart('grafik_pie1', {chart: {plotBackgroundColor: null, plotBorderWidth: null, plotShadow: false, type: 'pie'" +
          "},title: {text: 'STATUS PEKERJAAN'}, tooltip: {" +
          "pointFormat: '{series.name}: <b>{point.y} ({point.percentage:.1f}%)</b>'}," +
          "plotOptions: {pie: {allowPointSelect: true, cursor: 'pointer',dataLabels: {" +
          "enabled: true, format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f}%)'," +
          "style: {color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'} }}}," +
          "series: [{name: 'Status Pekerjaan',olorByPoint: true, data: [{ name: 'Belum/tidak bekerja'," +
          "y: " + feature.properties.belum_tidak_bekerja + ",sliced: true, selected: true}, {" +
          "name: 'Aparatur Pejabat Negara', y: " + feature.properties.aparatur_pejabat_negara+ "}, {" +
          "name: 'Tenaga Pengajar',y: " + feature.properties.tenaga_pengajar + "}, {name: 'Wiraswasta'," +
          "y: " + feature.properties.wiraswasta + "}, {name: 'Pertanian dan Peternakan'," +
          "y: " + feature.properties.pertanian_dan_peternakan + "}, {name: 'Nelayan', y: " + feature.properties.nelayan + "" +
          "}, {name: 'Tenaga Kesehatan', y: " + feature.properties.tenaga_kesehatan + "}, {" +
          "name: 'Pensiunan',y: "+ feature.properties.pensiunan + "}, {name: 'Pekerjaan Lainnya'," +
          "y: " + feature.properties.pekerjaan_lainnya + "}]}]}); </script>";
          var content2 = "<div class='table-responsive'><table class='table' style='margin-bottom:0;'>" + 
            "<tr><th>JUMLAH PENDUDUK</th><td>" + feature.properties.jumlah_penduduk + " Jiwa</td></tr>" + 
            "<tr><th>JUMLAH KK</th><td>" + feature.properties.jumlah_kk + "</td></tr>" +
            "<tr><th>PERSENTASE PU-BPU</th><td>" + feature.properties.persen_pu_bpu + " %</td></tr>" +
            "<tr><th>DESA/ KELURAHAN</th><td>" + feature.properties.kelurahan + "</td></tr>" +
            "<tr><th>KECAMATAN</th><td>" + feature.properties.kecamatan + "</td></tr>" +
            "<tr><th>KAB/ KOTA</th><td>" + feature.properties.kabkot + "</td></tr>" + 
            "<tr><th>PROVINSI</th><td>" + feature.properties.provinsi + "</td></tr></table></div>";
          layer.on('click', function(e) {
      $("#feature-title5").html("ADM KELURAHAN PU-BPU");
             $("#contentChart").html(content);
       $("#contentTable").html(content2);
      $("#modalkecamatan").modal("show"); 
});
           }
  }
layer_admkelPUBPU = new L.GeoJSON.AJAX("./assets/layer/request_layer_adm_kel.php",{
    style: style3,
    onEachFeature: onEachFeature6
  });

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

var layer_PMI= new L.GeoJSON.AJAX("./assets/layer/request_pmi.php",{
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
        var choice = document.getElementById("filter").value;
        console.log(choice);
        myData.clearLayers();
        map.removeLayer(myData);
var layer_PMI = new L.GeoJSON.AJAX("./assets/layer/request_PMI.php",{
       pointToLayer: function (feature, latlng) {
                var marker = L.marker(latlng,{icon: IPeserta1});
        return marker;
      },
          filter: function(feature, layer) {   
                 return (feature.properties.provinsi == choice );
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
    myData.addTo(map);  
  }

function ResetFilter() {
var layer_PMI = new L.GeoJSON.AJAX("./assets/layer/request_PMI.php",{
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
    myData.addTo(map);  
}

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

var layer_kebakaran_buffer = new L.GeoJSON.AJAX("./assets/layer/nilai_tanah.php",{
    style: function(feature){
      var style
        return { color: "#d62d20", weight: 2.5, opacity: 0.3 };
    }
    }).addTo(map);


var baseMaps = {
// "<img src='img/basemap3.png' height='18px'/> Basemap Topography": L.tileLayer.provider('Esri.WorldTopoMap').addTo(map), 
"<img src='./assets/images/basemap3.png' height='18px'/> Esri World Imagery": L.tileLayer.provider('Esri.WorldImagery').addTo(map),
"<img src='./assets/images/basemap3.png' height='18px'/> Open Street Map": L.tileLayer.provider('OpenStreetMap'),
"<img src='./assets/images/basemap3.png' height='18px'/> CartoDB Dark": L.tileLayer.provider('CartoDB.DarkMatter'),
// "<img src='./assets/images/basemap3.png' height='18px'/> Night": L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png'),
        };

//AddLayer
// var Map_Opacity = {
//     "RTRW Opacity": rtrw
// };

// L.control.layers(
//     Map_Opacity,
//     {
//     collapsed: true
//     }
// ).addTo(map);

//OpacityControl
// L.control.opacity(
//     Map_Opacity,
//     {
//     collapsed: true
//     }
// ).addTo(map);


 /* Digitize Function */
//   var drawnItems = new L.FeatureGroup();
//   map.addLayer(drawnItems);
  
// var drawControl = new L.Control.Draw({
//     draw: {
//       position: 'topleft',
//       polyline: false,
//       polygon: false,
//       rectangle: false,
//       circle   : {
//             metric: true,
//             feet: false
//         },
//       marker: false,
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
    
//     if (type === 'circle') {
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

// MENAMPILKAN TOOLS UNTUK MEMILIH BASEMAP
L.control.groupedLayers(baseMaps).addTo(map);

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

// document.getElementById("layer_adm_kec").addEventListener("change", function(){
// if (document.getElementById(this.id).checked == true){
// layer_adm_kec.addTo(map);
// } else {
// layer_adm_kec.remove(map);
// }
// });
// document.getElementById("layer_adm_kel").addEventListener("change", function(){
// if (document.getElementById(this.id).checked == true){
// layer_adm_kel.addTo(map);
// } else {
// layer_adm_kel.remove(map);
// }
// });
// document.getElementById("layer_adm").addEventListener("change", function(){
// if (document.getElementById(this.id).checked == true){
// layer_admkecPU.addTo(map);
// } else {
// layer_admkecPU.remove(map);
// }
// });
// document.getElementById("layer_adm2").addEventListener("change", function(){
// if (document.getElementById(this.id).checked == true){
// layer_admkecBPU.addTo(map);
// } else {
// layer_admkecBPU.remove(map);
// }
// });
// document.getElementById("layer_adm3").addEventListener("change", function(){
// if (document.getElementById(this.id).checked == true){
// layer_admkecPUBPU.addTo(map);
// } else {
// layer_admkecPUBPU.remove(map);
// }
// });
document.getElementById("layer_pmi").addEventListener("change", function(){
if (document.getElementById(this.id).checked == true){
myData.addTo(map);
} else {
myData.remove(map);
}
});

// CONTROL BASEMAP
document.getElementById("pilihlayer").addEventListener("change", function () {
    // $('#pilihbasemap').change(function () {
    selected_value = $("input[name='layer']:checked").val();
if (selected_value == 'admkec_pu') {
    layer_admkecPU.addTo(map);
layer_admkecBPU.remove();
layer_admkecPUBPU.remove();
layer_admkelPU.remove();
layer_admkelBPU.remove();
layer_admkelPUBPU.remove();
} else if (selected_value == 'admkec_bpu') {
  layer_admkecBPU.addTo(map);
layer_admkecPU.remove();
layer_admkecPUBPU.remove();
layer_admkelPU.remove();
layer_admkelBPU.remove();
layer_admkelPUBPU.remove();
} else if (selected_value == 'admkec_pubpu') {
  layer_admkecPUBPU.addTo(map);
layer_admkecPU.remove();
layer_admkecBPU.remove();
layer_admkelPU.remove();
layer_admkelBPU.remove();
layer_admkelPUBPU.remove();
} else if (selected_value == 'admkel_pu') {
layer_admkelPU.addTo(map);
layer_admkelBPU.remove();
layer_admkelPUBPU.remove();
layer_admkecPUBPU.remove();
layer_admkecPU.remove();
layer_admkecBPU.remove();
} else if (selected_value == 'admkel_bpu') {
layer_admkelBPU.addTo(map);
layer_admkelPU.remove();
layer_admkelPUBPU.remove();
layer_admkecPUBPU.remove();
layer_admkecPU.remove();
layer_admkecBPU.remove();
} else if (selected_value == 'admkel_pubpu') {
layer_admkelPUBPU.addTo(map);
layer_admkelPU.remove();
layer_admkelBPU.remove();
layer_admkecPUBPU.remove();
layer_admkecPU.remove();
layer_admkecBPU.remove();
}
});

 setTimeout(function(){ map.invalidateSize(true)}, 300);
 // $("#mytabs").bootstrapDynamicTabs();
 // });
// document.getElementById("btnClickedValue").value = buttontext;

