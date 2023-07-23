var base_url = window.location.origin + "/project/gis-demand/public";

function _buildDigitiseModalBox (targetmodal,context,geometry) {
    targetmodal = typeof targetmodal !== 'undefined' ? targetmodal : 'modalbox';
    context = typeof context !== 'undefined' ? context : 'POINT';
    geometry = typeof geometry !== 'undefined' ? geometry : 'POINT (110.21766 -7.459129)';
    
    var htmlformcomponent = "" +
        "<input type='hidden' id='command' name='command' value='"+context+"'/>" +
        "<input type='hidden' id='geometry' name='geometry' value='"+geometry+"'/>" +
        "<table id='feature_data' class='table table-condensed table-bordered table-striped'>" +
        //   "<thead>" +
        //     "<tr>" +
        //       "<th colspan='2' class='text-center'>Feature Data 2</th>" +
        //     "</tr>" +
        //   "</thead>" +
          "<tbody>" +
          "<tr>" +
          "<td class=''>Id Desa</td>" +
          "<td class='text-center'><input type='text' id='id_desa' name='id_desa' class='form-control' value=''/></td>" +
          "</tr>" +
          "<tr>" +
          "<td class=''>Desa</td>" +
          "<td class='text-center'><input type='text' id='desa' name='desa' class='form-control' value=''/></td>" +
          "</tr>" +
          "<tr>" +
          "<td class=''>Kecamatan</td>" +
          "<td class='text-center'><input type='text' id='kecamatan' name='kecamatan' class='form-control' value=''/></td>" +
          "</tr>" +
          "<tr>" +
          "<td class=''>Kab / Kota</td>" +
          "<td class='text-center'><input type='text' id='kab_kota' name='kab_kota' class='form-control' value=''/></td>" +
          "</tr>" +
          "<tr>" +
          "<td class=''>Provinsi</td>" +
          "<td class='text-center'><input type='text' id='provinsi' name='provinsi' class='form-control' value=''/></td>" +
          "</tr>" +
          "<tr>" +
          "<td class=''>Nama</td>" +
          "<td class='text-center'><input type='text' id='nama' name='nama' class='form-control' value=''/></td>" +
          "</tr>" +
          "<tr>" +
          "<td class=''>Telepon</td>" +
          "<td class='text-center'><input type='text' id='telepon' name='telepon' class='form-control' value=''/></td>" +
          "</tr>" +
          "<tr>" +
          "<td class=''>Email</td>" +
          "<td class='text-center'><input type='text' id='email' name='email' class='form-control' value=''/></td>" +
          "</tr>" +
          "<tr>" +
          "<td class=''>Jenis Usaha</td>" +
          "<td class='text-center'><input type='text' id='jenis_usaha' name='jenis_usaha' class='form-control' value=''/></td>" +
          "</tr>" +
          "<tr>" +
          "<td class=''>Produk</td>" +
          "<td class='text-center'><input type='text' id='produk' name='produk' class='form-control' value=''/></td>" +
          "</tr>" +
          "<tr>" +
          "<td class=''>Nama PIC</td>" +
          "<td class='text-center'><input type='text' id='nama_pic' name='nama_pic' class='form-control' value=''/></td>" +
          "</tr>" +
          "<tr>" +
          "<td class=''>Kontak PIC</td>" +
          "<td class='text-center'><input type='text' id='kontak_pic' name='kontak_pic' class='form-control' value=''/></td>" +
          "</tr>" +
          "<tr>" +
          "<td class=''>Pengusul</td>" +
          "<td class='text-center'><input type='text' id='pengusul' name='pengusul' class='form-control' value=''/></td>" +
          "</tr>" +
          "<tr>" +
          "<td class=''>Keterangan</td>" +
          "<td class='text-center'><input type='text' id='keterangan' name='keterangan' class='form-control' value=''/></td>" +
          "</tr>" +
          "<tr>" +
          "<td class=''>Tahun Bantuan</td>" +
          "<td class='text-center'><input type='text' id='thn_bantuan' name='thn_bantuan' class='form-control' value=''/></td>" +
          "</tr>" +
            "<tr>" +
              "<td class=''>Geometry<br/>(in WKT)</td>" +
              "<td class='text-center'><textarea rows='5' style='width:100%;' readonly='true'>"+geometry+"</textarea></td>" +
            "</tr>" +
          "</tbody>" +
        "</table>" +
      "";
    var modalfooter = "" +
      "<button type='button' id='canceldigitize' class='btn btn-default' data-dismiss='modal'><i class='fa fa-power-off'></i>&nbsp;Cancel</button>" +
      "<button type='button' id='savegeometrydata' class='btn btn-primary'><i class='fa fa-floppy-o'></i>&nbsp;Save</button>" +
      "";
    $("#form_modal_body").empty();
    $("#form_modal_footer").empty().html(modalfooter);
    $("#form_modal_body").removeClass().addClass('modal-body');
    $("#form_modal_size").removeClass().addClass('modal-dialog');
    $("#form_modal_body").html(htmlformcomponent);
    $("#form_modal_label").html("Tambah Penerima Bantuan");
    
    $('#'+targetmodal+'').modal({show:true, backdrop:'static', keyboard:false});
  }
  function _activateFeatureSave () {
    $("#savegeometrydata").on('click', function(evt){
      evt.stopImmediatePropagation();
      var commandContext = $('#command').val();
      // var noteString = $('#notes').val();
      var id_desaString = $('#id_desa').val();
      var desaString = $('#desa').val();
      var kecamatanString = $('#kecamatan').val();
      var kab_kotaString = $('#kab_kota').val();
      var provinsiString = $('#provinsi').val();
      var namaString = $('#nama').val();
      var teleponString = $('#telepon').val();
      var emailString = $('#email').val();
      var jenis_usahaString = $('#jenis_usaha').val();
      var produkString = $('#produk').val();
      var nama_picString = $('#nama_pic').val();
      var kontak_picString = $('#kontak_pic').val();
      var pengusulString = $('#pengusul').val();
      var keteranganString = $('#keterangan').val();
      var thn_bantuanString = $('#thn_bantuan').val();
      var geometry = $('#geometry').val();
      if (commandContext == "POINT") {
        $.ajax({
          url: base_url + "/assets/js/create_point.php",
          method: "GET",
          dataType: "json",
          data: $('#dynamicform').serialize(),
          success: function (data) {
            if (data.response=="200") {
              $("#modalform").modal('hide');
            } else {
              $("#modalform").modal('hide');
              console.log('Failed to save.');
            }
          },
          username: null,
          password: null
        });
      } else {
        console.log('__undefined__');
      }
      return false;
    });
  }