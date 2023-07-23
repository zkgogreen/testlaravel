function _buildDigitiseModalBox (targetmodal,context,geometry) {
  targetmodal = typeof targetmodal !== 'undefined' ? targetmodal : 'modalbox';
  context = typeof context !== 'undefined' ? context : 'POINT';
  geometry = typeof geometry !== 'undefined' ? geometry : 'POINT (110.21766 -7.459129)';
  
  var htmlformcomponent = "" +
      "<input type='hidden' id='command1' name='command1' value='"+context+"'/>" +
      "<input type='hidden' id='geometry1' name='geometry1' value='"+geometry+"'/>" +
      "<table id='feature_data' class='table table-condensed table-bordered table-striped'>" +
        "<thead>" +
          "<tr>" +
            "<th colspan='2' class='text-center'>Feature Data</th>" +
          "</tr>" +
        "</thead>" +
        "<tbody>" +
          "<tr>" +
            "<td class=''>Nama</td>" +
            "<td class='text-center'><input type='text' id='nama' name='nama' class='form-control' value=''/></td>" +
          "</tr>" +
          "<tr>" +
            "<td class=''>Radius</td>" +
            "<td class='text-center'><input type='text' id='radius' name='radius' class='form-control' value=''/></td>" +
          "</tr>" +
          "<tr>" +
            "<td class=''>Rendah</td>" +
            "<td class='text-center'><input type='text' id='val_rendah' name='val_rendah' class='form-control' value=''/></td>" +
          "</tr>" +
          "<tr>" +
            "<td class=''>Rata</td>" +
            "<td class='text-center'><input type='text' id='val_rerata' name='val_rerata' class='form-control' value=''/></td>" +
          "</tr>" +
          "<tr>" +
            "<td class=''>Tinggi</td>" +
            "<td class='text-center'><input type='text' id='val_tinggi' name='val_tinggi' class='form-control' value=''/></td>" +
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
  $("#form_modal_label").html("<i class='fa fa-pencil'></i>&nbsp;"+context+"");
  
  $('#'+targetmodal+'').modal({show:true, backdrop:'static', keyboard:false});
}
function _activateFeatureSave () {
  $("#savegeometrydata").on('click', function(evt){
    evt.stopImmediatePropagation();
    var commandContext = $('#command1').val();
    var namaString = $('#nama').val();
    var radiusString = $('#radius').val();
    var rendahString = $('#val_rendah').val();
    var rerataString = $('#val_rerata').val();
    var tinggiString = $('#val_tinggi').val();
    var geometry = $('#geometry1').val();
    if (commandContext == "POINT") {
      $.ajax({
        url: "./assets/js/create_point.php",
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