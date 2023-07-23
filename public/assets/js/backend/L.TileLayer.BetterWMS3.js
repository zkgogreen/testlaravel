
// -----------------LAYER ADM---------------------

L.TileLayer.BetterWMSADM = L.TileLayer.WMS.extend({
  
  onAdd: function (map) {
    // Triggered when the layer is added to a map.
    //   Register a click listener, then do all the upstream WMS things
    L.TileLayer.WMS.prototype.onAdd.call(this, map);
    map.on('click', this.getFeatureInfo, this);
  },
  
  onRemove: function (map) {
    // Triggered when the layer is removed from a map.
    //   Unregister a click listener, then do all the upstream WMS things
    L.TileLayer.WMS.prototype.onRemove.call(this, map);
    map.off('click', this.getFeatureInfo, this);
  },
  
  getFeatureInfo: function (evt) {
    // Make an AJAX request to the server and hope for the best
    var url = this.getFeatureInfoUrl(evt.latlng),
        showResults = L.Util.bind(this.showGetFeatureInfo, this);
    $.ajax({
      url: url,
        // url: 'assets/js/proxy.php?url='+encodeURIComponent (url),
      success: function (data, status, xhr) {
      
      
      // **********************************   if info-FORMAT is json type is an object! 
      
        var err = typeof data === 'object' ? null : data;
        showResults(err, evt.latlng, data);
      },
      error: function (xhr, status, error) {
        showResults(error);  
      }
    });
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
          // INFO FORMAT JSON
      info_format: 'application/json',
      propertyName:'kode_wilayah,nama_desa,nama_kec,nama_kab,nama_provinsi,sumber_penghasilan_utama,topografi,ketersediaan_listrik,jenis_permukaan_jalan,sd_mi,smp_mts,smu_ma_smk,akademi_perguruantinggi,sektor_pendidikan,rumah_sakit,puskesmas,poliklinik_balai_pengobatan,sektor_kesehatan,sentra_industri,koperasi,pertokoan_lebihdari10,pasar,minimarket,restoran_siapsaji,hotel,hostel_motel_losmen_wisma,sektor_perekonomian,jumlah_bank_umum_pemerintah,jumlah_bank_umum_swasta,jumlah_bank_perkreditan_rakyat,perbankan,jumlah_poi,sarana_prasarana_rekreasi_wisata,bumdes,konsumsi_telekomunikasi_perkotaan_prov,konsumsi_telekomunikasi_perdesaan_prov,total_pengeluaran_rt_prov'
      
        };
    
    params[params.version === '1.3.0' ? 'i' : 'x'] = point.x;
    params[params.version === '1.3.0' ? 'j' : 'y'] = point.y;
    
    // return this._url + L.Util.getParamString(params, this._url, true);
    
    var url = this._url + L.Util.getParamString(params, this._url, true);
    
    
    /**
     * CORS workaround (using a basic php proxy)
     * 
     * Added 2 new options:
     *  - proxy
     *  - proxyParamName
     * 
     */
     
    // check if "proxy" option is defined (PS: path and file name)
    if(typeof this.wmsParams.proxy !== "undefined") {
      
      // check if proxyParamName is defined (instead, use default value)
      if(typeof this.wmsParams.proxyParamName !== "undefined")
        this.wmsParams.proxyParamName = 'url';
      
      // build proxy (es: "proxy.php?url=" )
      _proxy = this.wmsParams.proxy + '?' + this.wmsParams.proxyParamName + '=';
      
      url = _proxy + encodeURIComponent(url);
      
    } 
    
    return url;
    
  },
   showGetFeatureInfo: function (err, latlng, content) {
    if (err) {
   // console.log(err);
  return;
    } // do nothing if there's an error
  
  //console.log(content);
  
    if (content.features.length>0)
    {
    // Otherwise show the content in a popup, or something.
    // L.popup({ maxWidth: 800})
    //   .setLatLng(latlng)
    //   .setContent(buildpopup(content))
    //   .openOn(this._map);
         $("#feature-title").html("WILAYAH ADMINISTRASI");
      $("#feature-info").html(buildpopup(content));
      $("#featureModal").modal("show");  
      }
      else 
      {   // Optional... show an error message if no feature was returned
      $("#daneben").fadeIn(750);
      setTimeout(function(){ $("#daneben").fadeOut(750); }, 2000);
      }
  }
  
});

L.tileLayer.betterWmsADM = function (url, options) {
  return new L.TileLayer.BetterWMSADM(url, options);  
};

function buildpopup(content){

    var record; 

 var info = "<div class='table-responsive'>";

    for (var i=0 ; i < content.features.length; i++ ){

        record = content.features[i];

        info+="<table class='table table-striped table-bordered table-condensed' style='margin-bottom:0;'>" + 
    "<tr><th style='width:30%;'>Kode Wilayah</th><td>" + record.properties.kode_wilayah + "</td></tr>" + 
    "<tr><th style='width:30%;'>Desa / Kelurahan</th><td>" + record.properties.nama_desa + "</td></tr>" + 
    "<tr><th style='width:30%;'>Kecamatan</th><td>" + record.properties.nama_kec + "</td></tr>" + 
    "<tr><th style='width:30%;'>Kabupaten / Kota</th><td>" + record.properties.nama_kab + "</td></tr>" + 
    "<tr><th style='width:30%;'>Provinsi</th><td>" + record.properties.nama_provinsi + "</td></tr>" + 
    "<tr><th style='width:30%;'>Sumber Penghasilan Utama</th><td>" + record.properties.sumber_penghasilan_utama + "</td></tr>" + 
    "<tr><th style='width:30%;'>Topografi</th><td>" + record.properties.topografi + "</td></tr>" + 
    "<tr><th colspan='2' style='text-align: center;'><i>Jumlah Konsumsi Telekomunikasi Rumah Tangga</i></th></tr>" +
    "<tr><th style='width:30%;'>Perkotaan</th><td>" + record.properties.konsumsi_telekomunikasi_perkotaan_prov + "</td></tr>" + 
    "<tr><th style='width:30%;'>Perdesaan</th><td>" + record.properties.konsumsi_telekomunikasi_perdesaan_prov + "</td></tr>" + 
    "<tr><th style='width:30%;'>Total Pengeluaran Konsumsi Rumah Tangga</th><td>" + record.properties.total_pengeluaran_rt_prov+ "</td></tr>" + 
    "<tr><th colspan='2' style='text-align: center;'><i>Infrastruktur</i></th></tr>" +
    "<tr><th style='width:30%;'>Permukaan Jalan</th><td>" + record.properties.jenis_permukaan_jalan + "</td></tr>" + 
    "<tr><th style='width:30%;'>Ketersediaan Listrik</th><td>" + record.properties.ketersediaan_listrik + "</td></tr>" + 
    // "<tr><hr colspan='2'></tr>" +
    "<tr><th style='width:30%;'>Jumlah BUMDES</th><td>" + record.properties.bumdes + "</td></tr>" + 
    "<tr><th style='width:30%;'>Jumlah Sarana Prasarana Wisata</th><td>" + record.properties.sarana_prasarana_rekreasi_wisata + "</td></tr>" +
    "<tr><th style='width:30%;'>Jumlah POI</th><td>" + record.properties.jumlah_poi + "</td></tr></table></div>" +
    "<div class='wrapper center-block'> <div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'> <div class='panel panel-default'> <div class='panel-heading active' role='tab' id='headingOne'> <h4 class='panel-title'> <a role='button' data-toggle='collapse' data-parent='#accordion' href='#collapseOne' aria-expanded='true' aria-controls='collapseOne'> SEKTOR PERBANKAN  </a> </h4> </div> <div id='collapseOne' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headingOne'> <div class='panel-body'> <div class='table-responsive'><table class='table table-striped table-bordered table-condensed' style='margin-bottom:0;'><tr><th style='width:30%;'>Bank Umum Pemerintah</th><td>" + record.properties.jumlah_bank_umum_pemerintah + "</td></tr>" + "<tr><th style='width:30%;'>Bank Umum Swasta</th><td>" + record.properties.jumlah_bank_umum_swasta + "</td></tr>" + "<tr><th style='width:30%;'>Bank Perkreditan Rakyat</th><td>" + record.properties.jumlah_bank_perkreditan_rakyat + "</td></tr> </table> </div> </div> </div> </div> <div class='panel panel-default'> <div class='panel-heading' role='tab' id='headingTwo'> <h4 class='panel-title'> <a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapseTwo' aria-expanded='false' aria-controls='collapseTwo'> SEKTOR KESEHATAN </a> </h4> </div> <div id='collapseTwo' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingTwo'> <div class='panel-body'> <div class='table-responsive'><table class='table table-striped table-bordered table-condensed' style='margin-bottom:0;'><tr><th style='width:30%;'>Rumah Sakit</th><td>" + record.properties.rumah_sakit + "</td></tr>" + "<tr><th style='width:30%;'>Puskesmas</th><td>" + record.properties.puskesmas + "</td></tr>" + "<tr><th style='width:30%;'>Poliklinik</th><td>" + record.properties.poliklinik_balai_pengobatan + "</td></tr> </table> </div> </div> </div> </div> <div class='panel panel-default'> <div class='panel-heading' role='tab' id='headingThree'> <h4 class='panel-title'> <a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapseThree' aria-expanded='false' aria-controls='collapseThree'> SEKTOR PENDIDIKAN </a> </h4> </div> <div id='collapseThree' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingThree'> <div class='panel-body'> <div class='table-responsive'><table class='table table-striped table-bordered table-condensed' style='margin-bottom:0;'><tr><th style='width:30%;'>SD/MI</th><td>" + record.properties.sd_mi + "</td></tr>" + "<tr><th style='width:30%;'>SMP/MTs</th><td>" + record.properties.smp_mts + "</td></tr>" + "<tr><th style='width:30%;'>SMU/MA/SMK</th><td>" + record.properties.smu_ma_smk + "</td></tr>" + "<tr><th style='width:30%;'>Akademi/Perguruan Tinggi</th><td>" + record.properties.akademi_perguruantinggi + "</td></tr> </table> </div> </div> </div> </div> <div class='panel panel-default'> <div class='panel-heading' role='tab' id='headingFour'> <h4 class='panel-title'> <a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapseFour' aria-expanded='false' aria-controls='collapseFour'> SEKTOR PEREKONOMIAN </a> </h4> </div> <div id='collapseFour' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingFour'> <div class='panel-body'><div class='table-responsive'><table class='table table-striped table-bordered table-condensed' style='margin-bottom:0;'><tr><th style='width:30%;'>Sentra Industri</th><td>" + record.properties.sentra_industri + "</td></tr>" + "<tr><th style='width:30%;'>Koperasi</th><td>" + record.properties.koperasi + "</td></tr>" + "<tr><th style='width:30%;'>Pertokoan > 10 Toko</th><td>" + record.properties.pertokoan_lebihdari10 + "</td></tr>" + "<tr><th style='width:30%;'>Pasar</th><td>" + record.properties.pasar + "</td></tr>" + "<tr><th style='width:30%;'>Minimarket</th><td>" + record.properties.minimarket + "</td></tr>" + "<tr><th style='width:30%;'>Restoran Siap Saji</th><td>" + record.properties.restoran_siapsaji + "</td></tr>" + "<tr><th style='width:30%;'>Hotel</th><td>" + record.properties.hotel + "</td></tr>" + "<tr><th style='width:30%;'>Hostel/motel/losmen/wisma</th><td>" + record.properties.hostel_motel_losmen_wisma + "</td></tr> </table></div> </div> </div> </div></div>";


        if (i!= (content.features.length-1)){
            info += "<br />";
        }

    }

    info += "</div>"

     return info;

}


// -----------------RTRW START----------------------

L.TileLayer.BetterWMSRTRW2 = L.TileLayer.WMS.extend({
  
  onAdd: function (map) {
    // Triggered when the layer is added to a map.
    //   Register a click listener, then do all the upstream WMS things
    L.TileLayer.WMS.prototype.onAdd.call(this, map);
    map.on('click', this.getFeatureInfo, this);
  },
  
  onRemove: function (map) {
    // Triggered when the layer is removed from a map.
    //   Unregister a click listener, then do all the upstream WMS things
    L.TileLayer.WMS.prototype.onRemove.call(this, map);
    map.off('click', this.getFeatureInfo, this);
  },
  
  getFeatureInfo: function (evt) {
    // Make an AJAX request to the server and hope for the best
    var url = this.getFeatureInfoUrl(evt.latlng),
        showResults = L.Util.bind(this.showGetFeatureInfo, this);
    $.ajax({
      url: url,
       // url: './js/proxy.php?url=' + encodeURIComponent(url),
      success: function (data, status, xhr) {
      
      
      // **********************************   if info-FORMAT is json type is an object! 
      
        var err = typeof data === 'object' ? null : data;
        showResults(err, evt.latlng, data);
      },
      error: function (xhr, status, error) {
        showResults(error);  
      }
    });
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
          // INFO FORMAT JSON
      info_format: 'application/json',
      propertyName:'desc'
        };
    
    params[params.version === '1.3.0' ? 'i' : 'x'] = point.x;
    params[params.version === '1.3.0' ? 'j' : 'y'] = point.y;
    
    // return this._url + L.Util.getParamString(params, this._url, true);
    
    var url = this._url + L.Util.getParamString(params, this._url, true);
    
    
    /**
     * CORS workaround (using a basic php proxy)
     * 
     * Added 2 new options:
     *  - proxy
     *  - proxyParamName
     * 
     */
     
    // check if "proxy" option is defined (PS: path and file name)
    if(typeof this.wmsParams.proxy !== "undefined") {
      
      // check if proxyParamName is defined (instead, use default value)
      if(typeof this.wmsParams.proxyParamName !== "undefined")
        this.wmsParams.proxyParamName = 'url';
      
      // build proxy (es: "proxy.php?url=" )
      _proxy = this.wmsParams.proxy + '?' + this.wmsParams.proxyParamName + '=';
      
      url = _proxy + encodeURIComponent(url);
      
    } 
    
    return url;
    
  },
   showGetFeatureInfo: function (err, latlng, content) {
    if (err) {
   // console.log(err);
  return;
    } // do nothing if there's an error
  
  //console.log(content);
  
    if (content.features.length>0)
    {
    // Otherwise show the content in a popup, or something.
    // L.popup({ maxWidth: 800})
    //   .setLatLng(latlng)
    //   .setContent(buildpopup(content))
    //   .openOn(this._map);
      $("#feature-info").html(buildpopup(content));
      $("#featureModal").modal("show");  
      }
      else 
      {   // Optional... show an error message if no feature was returned
      $("#daneben").fadeIn(750);
      setTimeout(function(){ $("#daneben").fadeOut(750); }, 2000);
      }
  }
  
});

L.tileLayer.betterWmsRTRW2 = function (url, options) {
  return new L.TileLayer.BetterWMSRTRW2(url, options);  
};

function buildpopup(content){

    var record; 

 var info = "<div class='table-responsive'>";

    for (var i=0 ; i < content.features.length; i++ ){

        record = content.features[i];

        info+= record.properties.desc;

        if (i!= (content.features.length-1)){
            info += "<br />";
        }

    }

    info += "</div>"

     return info;

}

// -----------------RTRW END----------------------