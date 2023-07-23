// -----------------PU START----------------------
L.TileLayer.BetterWMSPodes18 = L.TileLayer.WMS.extend({
  onAdd: function (map) {
    // Triggered when the layer is added to a map.
    //   Register a click listener, then do all the upstream WMS things
    L.TileLayer.WMS.prototype.onAdd.call(this, map)
    map.on('click', this.getFeatureInfo, this)
  },

  onRemove: function (map) {
    // Triggered when the layer is removed from a map.
    //   Unregister a click listener, then do all the upstream WMS things
    L.TileLayer.WMS.prototype.onRemove.call(this, map)
    map.off('click', this.getFeatureInfo, this)
  },

  getFeatureInfo: function (evt) {
    // Make an AJAX request to the server and hope for the best
    var url = this.getFeatureInfoUrl(evt.latlng),
      showResults = L.Util.bind(this.showGetFeatureInfo, this)
    $.ajax({
      // url: url,
      url: 'assets/js/proxy.php?url=' + encodeURIComponent(url),
      success: function (data, status, xhr) {
        var err = typeof data === 'string' ? null : data
        showResults(err, evt.latlng, data)
      },
      error: function (xhr, status, error) {
        showResults(error)
      },
    })
  },

  getFeatureInfoUrl: function (latlng) {
    // Construct a GetFeatureInfo request URL given a point
    var point = this._map.latLngToContainerPoint(latlng, this._map.getZoom()),
      size = this._map.getSize(),
      params = {
        request: 'GetFeatureInfo',
        service: 'WMS',
        srs: 'EPSG:4326',
        styles: this.wmsParams.styles,
        transparent: this.wmsParams.transparent,
        version: this.wmsParams.version,
        format: this.wmsParams.format,
        bbox: this._map.getBounds().toBBoxString(),
        height: size.y,
        width: size.x,
        layers: this.wmsParams.layers,
        query_layers: this.wmsParams.layers,
        // info_format: 'text/html'
        info_format: 'application/json',
      }

    params[params.version === '1.3.0' ? 'i' : 'x'] = point.x
    params[params.version === '1.3.0' ? 'j' : 'y'] = point.y

    return this._url + L.Util.getParamString(params, this._url, true)
  },

  showGetFeatureInfo: function (err, latlng, content) {
    if (err) {
      console.log(err)
      return
    } // do nothing if there's an error
    content = JSON.parse(content)
    console.log(content)
    record = content
    var tampil =
      "<table class='table' style='margin-bottom:0;'>" +
      "<tr><th style='width:30%;'>Kode Wilayah</th><td>" +
      record.features[0].properties.kode_wilayah +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Desa / Kelurahan</th><td>" +
      record.features[0].properties.nama_desa +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Kecamatan</th><td>" +
      record.features[0].properties.nama_kec +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Kabupaten / Kota</th><td>" +
      record.features[0].properties.nama_kab +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Provinsi</th><td>" +
      record.features[0].properties.nama_provinsi +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Sumber Penghasilan Utama</th><td>" +
      record.features[0].properties.sumber_penghasilan_utama +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Topografi</th><td>" +
      record.features[0].properties.topografi +
      '</td></tr>' +
      "<tr><th colspan='2' style='text-align: center;'><i>Jumlah Konsumsi Telekomunikasi Rumah Tangga</i></th></tr>" +
      "<tr><th style='width:30%;'>Perkotaan</th><td>" +
      record.features[0].properties.konsumsi_telekomunikasi_perkotaan_prov +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Perdesaan</th><td>" +
      record.features[0].properties.konsumsi_telekomunikasi_perdesaan_prov +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Total Pengeluaran Konsumsi Rumah Tangga</th><td>" +
      record.features[0].properties.total_pengeluaran_rt_prov +
      '</td></tr>' +
      "<tr><th colspan='2' style='text-align: center;'><i>Infrastruktur</i></th></tr>" +
      "<tr><th style='width:30%;'>Permukaan Jalan</th><td>" +
      record.features[0].properties.jenis_permukaan_jalan +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Ketersediaan Listrik</th><td>" +
      record.features[0].properties.ketersediaan_listrik +
      '</td></tr>' +
      // "<tr><hr colspan='2'></tr>" +
      "<tr><th style='width:30%;'>Jumlah BUMDES</th><td>" +
      record.features[0].properties.bumdes +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Jumlah Sarana Prasarana Wisata</th><td>" +
      record.features[0].properties.sarana_prasarana_rekreasi_wisata +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Jumlah POI</th><td>" +
      record.features[0].properties.jumlah_poi +
      '</td></tr></table></div>' +
      "<div class='wrapper center-block'> <div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'> <div class='panel panel-default'> <div class='panel-heading active' role='tab' id='headingOne'> <h4 class='panel-title'> <a role='button' data-toggle='collapse' data-parent='#accordion' href='#collapseOne' aria-expanded='true' aria-controls='collapseOne'> SEKTOR PERBANKAN  </a> </h4> </div> <div id='collapseOne' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'> <div class='panel-body'> <div class='table-responsive'><table class='table table-striped table-bordered table-condensed' style='margin-bottom:0;'><tr><th style='width:30%;'>Bank Umum Pemerintah</th><td>" +
      record.features[0].properties.jumlah_bank_umum_pemerintah +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Bank Umum Swasta</th><td>" +
      record.features[0].properties.jumlah_bank_umum_swasta +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Bank Perkreditan Rakyat</th><td>" +
      record.features[0].properties.jumlah_bank_perkreditan_rakyat +
      "</td></tr> </table> </div> </div> </div> </div> <div class='panel panel-default'> <div class='panel-heading' role='tab' id='headingTwo'> <h4 class='panel-title'> <a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapseTwo' aria-expanded='false' aria-controls='collapseTwo'> SEKTOR KESEHATAN </a> </h4> </div> <div id='collapseTwo' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingTwo'> <div class='panel-body'> <div class='table-responsive'><table class='table table-striped table-bordered table-condensed' style='margin-bottom:0;'><tr><th style='width:30%;'>Rumah Sakit</th><td>" +
      record.features[0].properties.rumah_sakit +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Puskesmas</th><td>" +
      record.features[0].properties.puskesmas +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Poliklinik</th><td>" +
      record.features[0].properties.poliklinik_balai_pengobatan +
      "</td></tr> </table> </div> </div> </div> </div> <div class='panel panel-default'> <div class='panel-heading' role='tab' id='headingThree'> <h4 class='panel-title'> <a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapseThree' aria-expanded='false' aria-controls='collapseThree'> SEKTOR PENDIDIKAN </a> </h4> </div> <div id='collapseThree' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingThree'> <div class='panel-body'> <div class='table-responsive'><table class='table table-striped table-bordered table-condensed' style='margin-bottom:0;'><tr><th style='width:30%;'>SD/MI</th><td>" +
      record.features[0].properties.sd_mi +
      '</td></tr>' +
      "<tr><th style='width:30%;'>SMP/MTs</th><td>" +
      record.features[0].properties.smp_mts +
      '</td></tr>' +
      "<tr><th style='width:30%;'>SMU/MA/SMK</th><td>" +
      record.features[0].properties.smu_ma_smk +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Akademi/Perguruan Tinggi</th><td>" +
      record.features[0].properties.akademi_perguruantinggi +
      "</td></tr> </table> </div> </div> </div> </div> <div class='panel panel-default'> <div class='panel-heading' role='tab' id='headingFour'> <h4 class='panel-title'> <a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapseFour' aria-expanded='false' aria-controls='collapseFour'> SEKTOR PEREKONOMIAN </a> </h4> </div> <div id='collapseFour' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingFour'> <div class='panel-body'><div class='table-responsive'><table class='table table-striped table-bordered table-condensed' style='margin-bottom:0;'><tr><th style='width:30%;'>Sentra Industri</th><td>" +
      record.features[0].properties.sentra_industri +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Koperasi</th><td>" +
      record.features[0].properties.koperasi +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Pertokoan > 10 Toko</th><td>" +
      record.features[0].properties.pertokoan_lebihdari10 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Pasar</th><td>" +
      record.features[0].properties.pasar +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Minimarket</th><td>" +
      record.features[0].properties.minimarket +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Restoran Siap Saji</th><td>" +
      record.features[0].properties.restoran_siapsaji +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Hotel</th><td>" +
      record.features[0].properties.hotel +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Hostel/motel/losmen/wisma</th><td>" +
      record.features[0].properties.hostel_motel_losmen_wisma +
      '</td></tr> </table></div> </div> </div> </div></div>'
    $('#feature-title').html('PODES (BPS) 2018')
    $('#feature-info').html(tampil)
    $('#featureInfo-map').toggle()
  },
})

L.tileLayer.betterWmsPodes18 = function (url, options) {
  return new L.TileLayer.BetterWMSPodes18(url, options)
}

// -----------------TIANG END----------------------

// -----------------PU START----------------------

L.TileLayer.BetterWMSPodes20 = L.TileLayer.WMS.extend({
  onAdd: function (map) {
    // Triggered when the layer is added to a map.
    //   Register a click listener, then do all the upstream WMS things
    L.TileLayer.WMS.prototype.onAdd.call(this, map)
    map.on('click', this.getFeatureInfo, this)
  },

  onRemove: function (map) {
    // Triggered when the layer is removed from a map.
    //   Unregister a click listener, then do all the upstream WMS things
    L.TileLayer.WMS.prototype.onRemove.call(this, map)
    map.off('click', this.getFeatureInfo, this)
  },

  getFeatureInfo: function (evt) {
    // Make an AJAX request to the server and hope for the best
    var url = this.getFeatureInfoUrl(evt.latlng),
      showResults = L.Util.bind(this.showGetFeatureInfo, this)
    $.ajax({
      // url: url,
      url: 'assets/js/proxy.php?url=' + encodeURIComponent(url),
      success: function (data, status, xhr) {
        var err = typeof data === 'string' ? null : data
        showResults(err, evt.latlng, data)
      },
      error: function (xhr, status, error) {
        showResults(error)
      },
    })
  },

  getFeatureInfoUrl: function (latlng) {
    // Construct a GetFeatureInfo request URL given a point
    var point = this._map.latLngToContainerPoint(latlng, this._map.getZoom()),
      size = this._map.getSize(),
      params = {
        request: 'GetFeatureInfo',
        service: 'WMS',
        srs: 'EPSG:4326',
        styles: this.wmsParams.styles,
        transparent: this.wmsParams.transparent,
        version: this.wmsParams.version,
        format: this.wmsParams.format,
        bbox: this._map.getBounds().toBBoxString(),
        height: size.y,
        width: size.x,
        layers: this.wmsParams.layers,
        query_layers: this.wmsParams.layers,
        // info_format: 'text/html'
        info_format: 'application/json',
      }

    params[params.version === '1.3.0' ? 'i' : 'x'] = point.x
    params[params.version === '1.3.0' ? 'j' : 'y'] = point.y

    return this._url + L.Util.getParamString(params, this._url, true)
  },

  showGetFeatureInfo: function (err, latlng, content) {
    if (err) {
      console.log(err)
      return
    } // do nothing if there's an error
    content = JSON.parse(content)
    console.log(content)
    record = content
  
    var tampil =
      "<table class='table' style='margin-bottom:0;'>" +
      // "<tr><th style='width:30%;'>Kode Wilayah</th><td>" + feature.properties.kode + "</td></tr>" +
      "<tr><th style='width:30%;'>Desa / Kelurahan</th><td>" +
      record.features[0].properties.r104n +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Kecamatan</th><td>" +
      record.features[0].properties.r103n +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Kabupaten / Kota</th><td>" +
      record.features[0].properties.r102n +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Provinsi</th><td>" +
      record.features[0].properties.r101n +
      '</td></tr>' +
      // "<tr><th style='width:30%;'>Status Pemerintahan</th><td>" +
      // record.features[0].properties.r301 +
      // "</td></tr>" +
      // "<tr><th colspan='2' style='text-align: center;'><i>Infrastruktur</i></th></tr>" +
      "<tr><th style='width:30%;'>Permukaan Jalan</th><td>" +
      record.features[0].properties.r801b1 +
      '</td></tr>' +
      // "<tr><hr colspan='2'></tr>" +
      // "<tr><th style='width:30%;'>Jumlah BUMDES</th><td>" +
      // record.features[0].properties.r1202 +
      // "</td></tr>" +
      "<tr><hr colspan='2'></tr>" +
      "<tr><th style='width:30%;'>Chart</th><td>" +
      "<a data-toggle='modal' data-target='#featureModal3' data-keyboard='false' data-backdrop='static' style='color:#337ab7;'>Tampilkan Chart</a>" +
      '</td></tr>' +
      '</table></div>' +
      "<div class='wrapper center-block'> <div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'>" +
      // "<div class='panel panel-default'> <div class='panel-heading' role='tab' id='headingZero'> <h4 class='panel-title'>" +
      // "<a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapseZero' aria-expanded='false' aria-controls='collapseOne'> CHART  </a> </h4>" +
      // "</div> <div id='collapseZero' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingZero'> <div class='panel-body'>" + 
      // "<div class='d-flex justify-content-center' id='chart' style='height:250px;'></div>" +
      // "</div> </div> </div>" +
      "<div class='panel panel-default'> <div class='panel-heading' role='tab' id='headingOne'> <h4 class='panel-title'>" +
      "<a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapseOne' aria-expanded='false' aria-controls='collapseOne'> SEKTOR KEUANGAN  </a> </h4>" +
      "</div> <div id='collapseOne' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingOne'> <div class='panel-body'> <div class='table-responsive'>" +
      "<table class='table table-striped table-bordered table-condensed' style='margin-bottom:0;'>" +
      "<tr><th style='width:30%;'>Bank Umum Pemerintah</th><td>" +
      record.features[0].properties.r903ak2 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Bank Umum Swasta</th><td>" +
      record.features[0].properties.r903bk2 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Bank Perkreditan Rakyat</th><td>" +
      record.features[0].properties.r903ck2 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Koperasi unit Desa</th><td>" +
      record.features[0].properties.r904a +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Koperasi Industri Kecil dan Kerjinan Rakyat</th><td>" +
      record.features[0].properties.r904b +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Koperasi Simpan Pinjam</th><td>" +
      record.features[0].properties.r904c +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Koperasi Lainnya</th><td>" +
      record.features[0].properties.r904d +
      "</td></tr></table> </div> </div> </div> </div>" +
      "<div class='panel panel-default'> <div class='panel-heading' role='tab' id='headingTwo'> <h4 class='panel-title'> <a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapseTwo' aria-expanded='false' aria-controls='collapseTwo'> SEKTOR KESEHATAN </a> </h4>" +
      "</div> <div id='collapseTwo' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingTwo'> <div class='panel-body'> <div class='table-responsive'><table class='table table-striped table-bordered table-condensed' style='margin-bottom:0;'>" +
      "<tr><th style='width:30%;'>Rumah Sakit</th><td>" +
      record.features[0].properties.r603ak2 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Rumah Sakit Bersalin</th><td>" +
      record.features[0].properties.r603bk2 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Puskesmas Rawat Inap</th><td>" +
      record.features[0].properties.r603ck2 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Puskesmas Tanap Rawat Inap</th><td>" +
      record.features[0].properties.r603dk2 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Puskesmas Pembantu</th><td>" +
      record.features[0].properties.r603ek2 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Poliklink / Balai Pengobatan</th><td>" +
      record.features[0].properties.r603fk2 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Tempat Praktek Dokter</th><td>" +
      record.features[0].properties.r603gk2 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Rumah bersalin</th><td>" +
      record.features[0].properties.r603hk2 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Tempat Praktek Bidan</th><td>" +
      record.features[0].properties.r603ik2 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Jumlah Poskesdes</th><td>" +
      record.features[0].properties.r603jk2 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Jumlah Polindes</th><td>" +
      record.features[0].properties.r603kk2 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Toko Apotek</th><td>" +
      record.features[0].properties.r603lk2 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Toko Khusus Obat/Jamu</th><td>" +
      record.features[0].properties.r603mk2 +
      "</td></tr></table> </div> </div> </div> </div> <div class='panel panel-default'> <div class='panel-heading' role='tab' id='headingThree'> <h4 class='panel-title'>" +
      "<a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapseThree' aria-expanded='false' aria-controls='collapseThree'> SEKTOR PENDIDIKAN </a> </h4> </div>" +
      "<div id='collapseThree' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingThree'> <div class='panel-body'> <div class='table-responsive'><table class='table table-striped table-bordered table-condensed' style='margin-bottom:0;'>" +
      "<tr><th style='width:30%;'>TK Negeri</th><td>" +
      record.features[0].properties.r601bk2 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>TK Swasta</th><td>" +
      record.features[0].properties.r601bk3 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>RA/BA Negeri</th><td>" +
      record.features[0].properties.r601ck2 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>RA/BA Swasta</th><td>" +
      record.features[0].properties.r601ck3 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>SD Negeri</th><td>" +
      record.features[0].properties.r601dk2 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>SD Swasta</th><td>" +
      record.features[0].properties.r601dk3 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>MI Negeri</th><td>" +
      record.features[0].properties.r601ek2 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>MI Swasta</th><td>" +
      record.features[0].properties.r601ek3 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>SMP Negeri</th><td>" +
      record.features[0].properties.r601fk2 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>SMP Swasta</th><td>" +
      record.features[0].properties.r601fk3 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>MTs Negeri</th><td>" +
      record.features[0].properties.r601gk2 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>MTs Swasta</th><td>" +
      record.features[0].properties.r601gk3 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>SMA Negeri</th><td>" +
      record.features[0].properties.r601hk2 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>SMA Swasta</th><td>" +
      record.features[0].properties.r601hk3 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>MA Negeri</th><td>" +
      record.features[0].properties.r601ik2 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>MA Swasta</th><td>" +
      record.features[0].properties.r601ik3 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>SMK Negeri</th><td>" +
      record.features[0].properties.r601jk2 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>SMK Swasta</th><td>" +
      record.features[0].properties.r601jk3 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Akademi/Perguruan Tinggi Negeri</th><td>" +
      record.features[0].properties.r601kk2 +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Akademi/Perguruan Tinggi Swasta</th><td>" +
      record.features[0].properties.r601kk3 +
      '</td></tr></table> </div> </div> </div> </div> </div></div>';

      var keuangan = record.features[0].properties.r903ak2 + record.features[0].properties.r903bk2 + record.features[0].properties.r903ck2 + record.features[0].properties.r904a + record.features[0].properties.r904b + record.features[0].properties.r904c + record.features[0].properties.r904d;
    var kesehatan  = record.features[0].properties.r603ak2 + record.features[0].properties.r603bk2 + record.features[0].properties.r603ck2 + record.features[0].properties.r603dk2 + record.features[0].properties.r603ek2 + record.features[0].properties.r603fk2 + record.features[0].properties.r603gk2 + record.features[0].properties.r603hk2 + record.features[0].properties.r603ik2 + record.features[0].properties.r603jk2 + record.features[0].properties.r603kk2 + record.features[0].properties.r603lk2 + record.features[0].properties.r603mk2;
    var pendidikan =  record.features[0].properties.r601bk2 + record.features[0].properties.r601bk3 + record.features[0].properties.r601ck2 + record.features[0].properties.r601ck3 + record.features[0].properties.r601dk2 + record.features[0].properties.r601dk3 + record.features[0].properties.r601ek2 + record.features[0].properties.r601ek3 + record.features[0].properties.r601fk2 + record.features[0].properties.r601fk3 + record.features[0].properties.r601gk2 + record.features[0].properties.r601gk3 + record.features[0].properties.r601hk2 + record.features[0].properties.r601hk3 + record.features[0].properties.r601ik2 + record.features[0].properties.r601ik3 + record.features[0].properties.r601jk2 + record.features[0].properties.r601jk3 + record.features[0].properties.r601kk2 + record.features[0].properties.r601kk3;

    var options1 = {
      series: [
        keuangan,
        kesehatan,
        pendidikan,
      ],
      colors: [
        '#4ca6ff',
        '#ffd700',
        '#5ac15b',
      ],
      chart: {
        width: 350,
        type: 'pie',
      },
      labels: [
        'Sektor Keuangan',
        'Sektor Kesehatan',
        'Sektor Pendidikan',
      ],
      legend: {
        position: 'bottom',
      },
      responsive: [
        {
          breakpoint: 480,
          options: {
            chart: {
              width: 350,
            },
            legend: {
              position: 'bottom',
            },
          },
        },
      ],
    }

    var chart1 = new ApexCharts(document.querySelector('#chart'), options1)
    chart1.render();

    $('#feature-title').html('PODES (BPS) 2020')
    // $('#featureModal3').removeData()
    $('#feature-info').html(tampil)
    $('#featureInfo-map').toggle()
  },
})

L.tileLayer.betterWmsPodes20 = function (url, options) {
  return new L.TileLayer.BetterWMSPodes20(url, options)
}

// -----------------TIANG END----------------------


// -----------------PU START----------------------

L.TileLayer.BetterWMSPodes20_2 = L.TileLayer.WMS.extend({
  onAdd: function (map) {
    // Triggered when the layer is added to a map.
    //   Register a click listener, then do all the upstream WMS things
    L.TileLayer.WMS.prototype.onAdd.call(this, map)
    map.on('click', this.getFeatureInfo, this)
  },

  onRemove: function (map) {
    // Triggered when the layer is removed from a map.
    //   Unregister a click listener, then do all the upstream WMS things
    L.TileLayer.WMS.prototype.onRemove.call(this, map)
    map.off('click', this.getFeatureInfo, this)
  },

  getFeatureInfo: function (evt) {
    // Make an AJAX request to the server and hope for the best
    var url = this.getFeatureInfoUrl(evt.latlng),
      showResults = L.Util.bind(this.showGetFeatureInfo, this)
    $.ajax({
      // url: url,
      url: 'assets/js/proxy.php?url=' + encodeURIComponent(url),
      success: function (data, status, xhr) {
        var err = typeof data === 'string' ? null : data
        showResults(err, evt.latlng, data)
      },
      error: function (xhr, status, error) {
        showResults(error)
      },
    })
  },

  getFeatureInfoUrl: function (latlng) {
    // Construct a GetFeatureInfo request URL given a point
    var point = this._map.latLngToContainerPoint(latlng, this._map.getZoom()),
      size = this._map.getSize(),
      params = {
        request: 'GetFeatureInfo',
        service: 'WMS',
        srs: 'EPSG:4326',
        styles: this.wmsParams.styles,
        transparent: this.wmsParams.transparent,
        version: this.wmsParams.version,
        format: this.wmsParams.format,
        bbox: this._map.getBounds().toBBoxString(),
        height: size.y,
        width: size.x,
        layers: this.wmsParams.layers,
        query_layers: this.wmsParams.layers,
        // info_format: 'text/html'
        info_format: 'application/json',
      }

    params[params.version === '1.3.0' ? 'i' : 'x'] = point.x
    params[params.version === '1.3.0' ? 'j' : 'y'] = point.y

    return this._url + L.Util.getParamString(params, this._url, true)
  },

  showGetFeatureInfo: function (err, latlng, content) {
    if (err) {
      console.log(err)
      return
    } // do nothing if there's an error
    content = JSON.parse(content)
    console.log(content)
    record = content
  
    var tampil =
      "<table class='table' style='margin-bottom:0;'>" +
      // "<tr><th style='width:30%;'>Kode Wilayah</th><td>" + feature.properties.kode + "</td></tr>" +
      "<tr><th style='width:30%;'>Desa / Kelurahan</th><td>" +
      record.features[0].properties.r104n +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Kecamatan</th><td>" +
      record.features[0].properties.r103n +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Kabupaten / Kota</th><td>" +
      record.features[0].properties.r102n +
      '</td></tr>' +
      "<tr><th style='width:30%;'>Provinsi</th><td>" +
      record.features[0].properties.r101n +
      '</td></tr>' +
      // "<tr><th style='width:30%;'>Status Pemerintahan</th><td>" +
      // record.features[0].properties.r301 +
      // "</td></tr>" +
      // "<tr><th colspan='2' style='text-align: center;'><i>Infrastruktur</i></th></tr>" +
      "<tr><th style='width:30%;'>Permukaan Jalan</th><td>" +
      record.features[0].properties.r801b1 +
      '</td></tr>' +
      // "<tr><hr colspan='2'></tr>" +
      // "<tr><th style='width:30%;'>Jumlah BUMDES</th><td>" +
      // record.features[0].properties.r1202 +
      // "</td></tr>" +
      "<tr><hr colspan='2'></tr>" +
      "<tr><th style='width:30%;'>Chart</th><td>" +
      "<a data-toggle='modal' data-target='#featureModal3' data-keyboard='false' data-backdrop='static' style='color:#337ab7;'>Tampilkan Chart</a>" +
      '</td></tr>' +
      '</table>';

      var keuangan = record.features[0].properties.r903ak2 + record.features[0].properties.r903bk2 + record.features[0].properties.r903ck2 + record.features[0].properties.r904a + record.features[0].properties.r904b + record.features[0].properties.r904c + record.features[0].properties.r904d;
    var kesehatan  = record.features[0].properties.r603ak2 + record.features[0].properties.r603bk2 + record.features[0].properties.r603ck2 + record.features[0].properties.r603dk2 + record.features[0].properties.r603ek2 + record.features[0].properties.r603fk2 + record.features[0].properties.r603gk2 + record.features[0].properties.r603hk2 + record.features[0].properties.r603ik2 + record.features[0].properties.r603jk2 + record.features[0].properties.r603kk2 + record.features[0].properties.r603lk2 + record.features[0].properties.r603mk2;
    var pendidikan =  record.features[0].properties.r601bk2 + record.features[0].properties.r601bk3 + record.features[0].properties.r601ck2 + record.features[0].properties.r601ck3 + record.features[0].properties.r601dk2 + record.features[0].properties.r601dk3 + record.features[0].properties.r601ek2 + record.features[0].properties.r601ek3 + record.features[0].properties.r601fk2 + record.features[0].properties.r601fk3 + record.features[0].properties.r601gk2 + record.features[0].properties.r601gk3 + record.features[0].properties.r601hk2 + record.features[0].properties.r601hk3 + record.features[0].properties.r601ik2 + record.features[0].properties.r601ik3 + record.features[0].properties.r601jk2 + record.features[0].properties.r601jk3 + record.features[0].properties.r601kk2 + record.features[0].properties.r601kk3;

    var options1 = {
      series: [
        keuangan,
        kesehatan,
        pendidikan,
      ],
      colors: [
        '#4ca6ff',
        '#ffd700',
        '#5ac15b',
      ],
      chart: {
        width: 350,
        type: 'pie',
      },
      labels: [
        'Sektor Keuangan',
        'Sektor Kesehatan',
        'Sektor Pendidikan',
      ],
      legend: {
        position: 'bottom',
      },
      responsive: [
        {
          breakpoint: 480,
          options: {
            chart: {
              width: 350,
            },
            legend: {
              position: 'bottom',
            },
          },
        },
      ],
    }

    var chart1 = new ApexCharts(document.querySelector('#chart'), options1)
    chart1.render();

    $('#feature-title').html('PODES (BPS) 2020')
    // $('#featureModal3').removeData()
    $('#feature-info').html(tampil)
    $('#featureInfo-map').toggle()
  },
})

L.tileLayer.betterWmsPodes20_2 = function (url, options) {
  return new L.TileLayer.BetterWMSPodes20_2(url, options)
}

// -----------------TIANG END----------------------
