  <script type="text/javascript">
      var GABUNG2 = new L.LayerGroup();
      var items = [];

      map = L.map('map', {}).setView([0.539731, 118.7240573], 4);
      //   var url = 'http://localhost:8080/geoserver/kominfo/wms';
      var url2 = 'http://172.30.102.158:8080/geoserver/kominfo2/wms';
      // var urlVT = 'http://localhost:8080/geoserver/gwc/service/tms/1.0.0/kominfo:adm_demand@EPSG%3A4326@pbf/{z}/{x}/{-y}.pbf';
      // var urlVT3 ='http://localhost:8080/geoserver/gwc/service/wmts?REQUEST=GetTile&SERVICE=WMTS&VERSION=1.0.0&LAYER=kominfo:adm_demand&STYLE=&TILEMATRIX=EPSG:4326:{z}&TILEMATRIXSET=EPSG:4326&FORMAT=application/vnd.mapbox-vector-tile&TILECOL={x}&TILEROW={y}';
      // var urlVT2 = 'http://localhost:8080/geoserver/gwc/demo/kominfo:adm_demand?gridSet=EPSG:4326&format=application/vnd.mapbox-vector-tile';


      var layer_podes18 = L.tileLayer.betterWmsPodes18(url2, {
          layers: 'kominfo2:podes18_maps',
          format: 'image/png',
          transparent: true,
          tiled: true,
          zIndex: 1000
      });

      var layer_podes20 = L.tileLayer.betterWmsPodes20_2(url2, {
          layers: 'kominfo2:podes20_spd_kp_dukcapil',
          format: 'image/png',
          transparent: true,
          tiled: true,
          zIndex: 1000
      });
      layer_podes20.setParams({});
      // $('#FILTER_RUN').click(function(e) {
      // e.preventDefault();
      function FilterPODES() {
          var prov_fil = document.getElementById("provinsi").value;
          var kab_fil = document.getElementById("kabkot").value;
          var kec_fil = document.getElementById("kecamatan").value;
          var kel_fil = document.getElementById("kelurahan").value;
          if (prov_fil == 'pilihprovinsi') {
              var filter = "negara='Indonesia'";
          } else if (kab_fil == 'piilhkabkot') {
              var filter = "r101n='" + prov_fil + "'";
          } else if (kec_fil == 'pilihkecamatan') {
              var filter = "r101n='" + prov_fil + "' and r102n='" + kab_fil + "'";
          } else if (kel_fil == 'pilihkelurahan') {
              var filter = "r101n='" + prov_fil + "' and r102n='" + kab_fil + "' and r103n='" + kec_fil + "'";
          } else {
              var filter = "r101n='" + prov_fil + "' and r102n='" + kab_fil + "' and r103n='" + kec_fil +
                  "' and r104n='" + kel_fil + "'";
          }
          return layer_podes20.setParams({
              cql_filter: filter
          });
      }


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
                      "<tr><th style='width:30%;'>Desa / Kelurahan</th><td>" + feature.properties.r104n +
                      "</td></tr>" +
                      "<tr><th style='width:30%;'>Kecamatan</th><td>" + feature.properties.r103n +
                      "</td></tr>" +
                      "<tr><th style='width:30%;'>Kabupaten / Kota</th><td>" + feature.properties.r102n +
                      "</td></tr>" +
                      "<tr><th style='width:30%;'>Provinsi</th><td>" + feature.properties.r101n +
                      "</td></tr>" +
                      "<tr><th style='width:30%;'>Kode Desa</th><td>" + feature.properties.kode_bps +
                      "</td></tr>" +
                      "<tr><th style='width:30%;'>Jumlah Penduduk</th><td>" + feature.properties
                      .spd_jumlah_penduduk + "</td></tr>" +
                      "<tr><th style='width:30%;'>Jumlah KK</th><td>" + feature.properties.spd_jumlah_kk +
                      "</td></tr>" +
                      "<tr><th style='width:30%;'>Jumlah UMKM</th><td>" + feature.properties.spd_jumlah_umkm +
                      "</td></tr>" +
                      "<tr><th style='width:30%;'>Jenis UMKM</th><td>" + feature.properties.spd_jenis_umkm +
                      "</td></tr>" +
                      "<tr><th style='width:30%;'>Mata Pencaharian Penduduk</th><td>" + feature.properties
                      .spd_pencaharian + "</td></tr>" +
                      "<tr><th style='width:30%;'>Pendapatan Penduduk</th><td>" + feature.properties
                      .spd_pendapatan + "</td></tr>" +
                      "<tr><th style='width:30%;'>Potensi Desa</th><td>" + feature.properties.spd_potensi +
                      "</td></tr></table></div>" +
                      "<div class='wrapper center-block'> <div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'> <div class='panel panel-default'> <div class='panel-heading active' role='tab' id='headingOne'> <h4 class='panel-title'> <a role='button' data-toggle='collapse' data-parent='#accordion' href='#collapseOne' aria-expanded='true' aria-controls='collapseOne'> DOKUMENTASI </a> </h4> </div> <div id='collapseOne' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'> <div class='panel-body'> <div class='slideshow nowslide'> <div class='sliderdok'> <input type='radio' name='radio' id='radio1' checked> <input type='radio' name='radio' id='radio2'> <input type='radio' name='radio' id='radio3'> <input type='radio' name='radio' id='radio4'> <input type='radio' name='radio' id='radio5'> <div class='slidedok sh1'> <iframe src='" +
                      feature.properties.spd_foto1 +
                      "preview' width='100%'></iframe> </div> <div class='slidedok'> <iframe src='" + feature
                      .properties.spd_foto2 +
                      "preview' width='100%'></iframe> </div> <div class='slidedok'> <iframe src='" + feature
                      .properties.spd_foto3 +
                      "preview' width='100%'></iframe> </div> <div class='slidedok'> <iframe src='" + feature
                      .properties.spd_foto4 +
                      "preview' width='100%'></iframe> </div> <div class='slidedok'> <iframe src='" + feature
                      .properties.spd_foto5 +
                      "preview' width='100%'></iframe> </div> </div> <div class='navslider'> <label for='radio1' class='barslider'></label> <label for='radio2' class='barslider'></label> <label for='radio3' class='barslider'></label> <label for='radio4' class='barslider'></label> <label for='radio5' class='barslider'></label> </div> </div> </div> </div> </div></div></div>";
                  layer.on('click', function(e) {
                      $("#feature-title").html("SURVEY POTENSI DESA");
                      $("#feature-info").html(content);
                      $("#featureInfo-map").toggle();
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


      var layer_prioritas = new L.GeoJSON.AJAX("{{ 'assets/layer/request_layer_kp.php' }}", {
          style: function(
              feature) { // PEWARNAAN OBJEK POLYGON DIAMBIL DARI FIELD "color" PADA FILE GEOJSON geojson
              if (feature.properties.kp_prioritas_filter == '5 DESTINASI SUPER PRIORITAS') {
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
                      "<tr><th style='width:30%;'>Desa / Kelurahan</th><td>" + feature.properties.r104n +
                      "</td></tr>" +
                      "<tr><th style='width:30%;'>Kecamatan</th><td>" + feature.properties.r103n +
                      "</td></tr>" +
                      "<tr><th style='width:30%;'>Kabupaten / Kota</th><td>" + feature.properties.r102n +
                      "</td></tr>" +
                      "<tr><th style='width:30%;'>Provinsi</th><td>" + feature.properties.r101n +
                      "</td></tr>" +
                      "<tr><th style='width:30%;'>Jenis Kawasan</th><td>" + feature.properties
                      .kp_jenis_kawasan + "</td></tr>" +
                      "<tr><th style='width:30%;'>3T</th><td>" + feature.properties.kp_3t + "</td></tr>" +
                      "<tr><th style='width:30%;'>LOKPRI</th><td>" + feature.properties.kp_lokpri +
                      "</td></tr>" +
                      "<tr><th style='width:30%;'>Keterangan</th><td>" + feature.properties
                      .kp_prioritas_filter + "</td></tr></table></div>";
                  layer.on('click', function(e) {
                      $("#feature-title").html("KAWASAN PRIORITAS");
                      $("#feature-info").html(content);
                      $("#featureInfo-map").toggle();
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
                      $("#feature-title").html("PENERIMA BANTUAN");
                      $("#feature-info").html(content);
                      $("#featureInfo-map").toggle();
                  });
              }
          }
      });


      //   var penerima_bantuan2 = new L.GeoJSON.AJAX("{{ route('PBgetMap') }}", {
      //       pointToLayer: function(feature, latlng) {
      //           return marker = L.marker(latlng, {
      //               icon: IPB2
      //           });
      //       },
      //       // create marker object, pass custom icon as option, add to map    
      //       onEachFeature: function(feature, layer) {
      //           if (feature.properties) {
      //               var content =
      //                   "<div class='table-responsive'><table class='table' style='margin-bottom:0;'>" +
      //                   "<tr><th style='width:30%;'>Nama</th><td>" + feature.properties.nama_lengkap +
      //                   "</td></tr>" + "<tr><th style='width:30%;'>Jenis Usaha</th><td>" + feature.properties
      //                   .keterangan +
      //                   "</td></tr>" + "<tr><th style='width:30%;'>Desa / Kelurahan</th><td>" + feature
      //                   .properties.iddesa +
      //                   "</td></tr>" + "<tr><th style='width:30%;'>Kecamatan</th><td>" + feature.properties
      //                   .idkec +
      //                   "</td></tr>" + "<tr><th style='width:30%;'>Kab / Kota</th><td>" + feature.properties
      //                   .idkabupaten +
      //                   "</td></tr>" + "<tr><th style='width:30%;'>Provinsi</th><td>" + feature.properties
      //                   .idprovinsi +
      //                   "</td></tr>" + "<tr><th style='width:30%;'>Bandwith</th><td>" + feature.properties
      //                   .bandwith +
      //                   "</td></tr>" + "<tr><th style='width:30%;'>Tahun Bantuan</th><td>" + feature.properties
      //                   .tahun +
      //                   "</td></tr></table></div>";
      //               layer.on('click', function(e) {
      //                   $("#feature-title").html("PENERIMA BANTUAN");
      //                   $("#feature-info").html(content);
      //                   $("#featureInfo-map").toggle();
      //               });
      //           }
      //       }
      //   });



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
                      $("#feature-title").html("POINT OF INTEREST");
                      $("#feature-info").html(content);
                      $("#featureInfo-map").toggle();
                  });
              }
          }
      }).addTo(map);


      //   var layer_penerimabantuan = L.layerGroup([penerima_bantuan1, penerima_bantuan2]);

      var baseGoogle1 = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
          maxZoom: 20,
          subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
      });
      var baseGoogle2 = L.tileLayer('htt://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
          maxZoom: 20,
          subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
      });
      var baseEsri = L.tileLayer.provider('Esri.WorldImagery');
      var baseEsri2 = L.tileLayer.provider('Esri.NatGeoWorldMap');
      var baseOsm = L.tileLayer.provider('OpenStreetMap');
      var baseCarto = L.tileLayer.provider('CartoDB.DarkMatter').addTo(map);

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

      // DEFAULT EXTENT
      L.control.defaultExtent({
          position: 'bottomright'
      }).addTo(map);


      var searchControl = new L.Control.Search({
          layer: layer_prioritas,
          propertyName: 'r104n',
          marker: false,
          moveToLocation: function(latlng, title, map) {
              //map.fitBounds( latlng.layer.getBounds() );
              var zoom = map.getBoundsZoom(latlng.layer.getBounds());
              map.setView(latlng, zoom); // access the zoom
          }
      });

      searchControl.on('search:locationfound', function(e) {

          //console.log('search:locationfound', );

          //map.removeLayer(this._markerSearch)

          e.layer.setStyle({
              fillColor: '#3f0',
              color: '#0f0'
          });
          if (e.layer._popup)
              e.layer.openPopup();

      }).on('search:collapsed', function(e) {

          layer_prioritas.eachLayer(function(layer) { //restore feature color
              layer_prioritas.resetStyle(layer);
          });
      });

      map.addControl(searchControl); //inizialize search control

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

      document.getElementById('layer_prioritas').addEventListener('change', function() {
          if (document.getElementById(this.id).checked == true) {
              layer_prioritas.addTo(map);
          } else {
              layer_prioritas.remove(map);
          }
      });
      document.getElementById('layer_podes18').addEventListener('change', function() {
          if (document.getElementById(this.id).checked == true) {
              layer_podes18.addTo(map);
          } else {
              layer_podes18.remove(map);
          }
      });
      document.getElementById('layer_podes20').addEventListener('change', function() {
          if (document.getElementById(this.id).checked == true) {
              layer_podes20.addTo(map);
          } else {
              layer_podes20.remove(map);
          }
      });
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
      document.getElementById('layer_poi').addEventListener('change', function() {
          if (document.getElementById(this.id).checked == true) {
              layer_poi.addTo(map);
          } else {
              layer_poi.remove(map);
          }
      });

      document.getElementById("pilihbasemap").addEventListener("change", function() {
          // $('#pilihbasemap').change(function () {
          selected_value = $("input[name='base']:checked").val();
          if (selected_value == 'baseEsri') {
              baseEsri.addTo(map);
              baseEsri2.remove();
              baseOsm.remove();
              baseCarto.remove();
              baseGoogle1.remove();
              //   baseGoogle2.remove();
          } else if (selected_value == 'baseEsri2') {
              baseEsri2.addTo(map);
              baseEsri.remove();
              baseOsm.remove();
              baseCarto.remove();
              baseGoogle1.remove();
              //   baseGoogle2.remove();
          } else if (selected_value == 'baseOsm') {
              baseOsm.addTo(map);
              baseEsri.remove();
              baseEsri2.remove();
              baseCarto.remove();
              baseGoogle1.remove();
              //   baseGoogle2.remove();
          } else if (selected_value == 'baseCarto') {
              baseCarto.addTo(map);
              baseEsri.remove();
              baseEsri2.remove();
              baseOsm.remove();
              baseGoogle1.remove();
              //   baseGoogle2.remove();
          } else if (selected_value == 'baseGoogle1') {
              baseGoogle1.addTo(map);
              baseEsri.remove();
              baseEsri2.remove();
              baseOsm.remove();
              baseCarto.remove();
              //   baseGoogle2.remove();
          }
          //   else if (selected_value == 'baseGoogle2') {
          //       baseGoogle2.addTo(map);
          //       baseEsri.remove();
          //       baseEsri2.remove();
          //       baseOsm.remove();
          //       baseCarto.remove();
          //       baseGoogle1.remove();
          //   }
      });

      setTimeout(function() {
          map.invalidateSize(true)
      }, 300);
  </script>
