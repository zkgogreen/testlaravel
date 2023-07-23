@extends('layouts.admin')

@section('content')
    <div class="card col-md-12">
        <div class="card-block" style="padding: 1%; padding-top: 1.5%;">
            <!-- <h4 class="card-title">Simple Basic Map</h4> -->
            <ul class="nav nav-tabs float-end" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="masterdata-tab" data-bs-toggle="tab" data-bs-target="#masterdatatab"
                        type="button" role="tab" aria-controls="masterdata" aria-selected="true">Master Data
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="layerdata-tab" data-bs-toggle="tab"
                        data-bs-target="#layerdatatab" type="button" role="tab" aria-controls="layerdata"
                        aria-selected="false">Layer
                    </button>
                </li>
            </ul>

            <div class="tab-content mt-4" id="myTabContent">
                <div class="tab-pane fade show active" id="masterddatatab" role="tabpanel"
                aria-labelledby="masterdata-tab">
                <h4>Master Data</h4>
                <p>Pembuatan format table yang dipergunakan untuk input data survey / density</p>

                <select class="form-control form-control-sm jtable w-100 mt-2" name="jenis_db" id="jenis_db">
                    <option value="tbnonselect" selected>Select Table Type</option>
                    <option value="tbspatial">Spatial</option>
                    <option value="tbnonspatial">Non Spatial</option>
                </select>

                <div class="row tbnonselect box2 mt-2">
                </div>

                <div class="row tbspatial box2 mt-2 mb-2">
                <form action="{{ route('createTB') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                              <table class="table table-bordered" id="dynamicAddRemove">
                                      <input type="hidden" name="type_table" class="form-control" value="Spatial" required>
                                <tr>
                                    <td colspan="2">
                                        <input type="text" name="name_table" class="form-control" placeholder="Enter Table Name" required>
                                      </td>
                                    <td colspan="1">
                                        <select class="select2 form-select" name="roles_table" required>
                                            {{-- <option value="#" selected>Select Table Role</option> --}}
                                            <option value="Private" selected>Private</option>
                                            <option value="Public">Public</option>
                                          </select>
                                    </td>
                                    <td colspan="1">
                                        <select class="select2 form-select" name="status_table" required>
                                            {{-- <option value="#" selected>Select Table Status</option> --}}
                                            <option value="ActiveAdmin">Active Admin Only</option>
                                            <option value="Active" selected>Active</option>
                                            <option value="Inactive">Inactive</option>
                                          </select>
                                    </td>
                                </tr>
                        <tr>
                            <th class="text-center">Column Name</th>
                            <th class="text-center">Type / Source</th>
                            <th class="text-center">Option</th>
                            <th class="text-center">Action / Notes</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="addMoreInputFields[0][kolom]" value="keldes" class="form-control" readonly/>
                            </td>
                            <td>
                                <select class="select2 form-select" name="addMoreInputFields[0][type]">
                              <option value="string" selected>string</option>
                            </select>
                            </td>
                            <td><select class="select2 form-select" name="addMoreInputFields[0][more]">
                                <option value="mandatory" selected>Mandatory</option>
                              </select>
                            </td>
                            <td class="text-center">
                                DEFAULT
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="addMoreInputFields[1][kolom]" value="kecamatan" class="form-control" readonly/>
                            </td>
                            <td>
                                <select class="select2 form-select" name="addMoreInputFields[1][type]">
                              <option value="string" selected>string</option>
                            </select>
                            </td>
                            <td><select class="select2 form-select" name="addMoreInputFields[1][more]">
                                <option value="mandatory" selected>Mandatory</option>
                              </select>
                            </td>
                            <td class="text-center">
                                DEFAULT
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="addMoreInputFields[2][kolom]" value="kabkot" class="form-control" readonly/>
                            </td>
                            <td>
                                <select class="select2 form-select" name="addMoreInputFields[2][type]">
                              <option value="string" selected>string</option>
                            </select>
                            </td>
                            <td><select class="select2 form-select" name="addMoreInputFields[2][more]">
                                <option value="mandatory" selected>Mandatory</option>
                              </select>
                            </td>
                            <td class="text-center">
                                DEFAULT
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="addMoreInputFields[3][kolom]" value="provinsi" class="form-control" readonly/>
                            </td>
                            <td>
                                <select class="select2 form-select" name="addMoreInputFields[3][type]">
                              <option value="string" selected>string</option>
                            </select>
                            </td>
                            <td><select class="select2 form-select" name="addMoreInputFields[3][more]">
                                <option value="mandatory" selected>Mandatory</option>
                              </select>
                            </td>
                            <td class="text-center">
                                DEFAULT
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="addMoreInputFields[4][kolom]" value="longitude" class="form-control" readonly/>
                            </td>
                            <td>
                                <select class="select2 form-select" name="addMoreInputFields[4][type]">
                              <option value="decimal" selected>decimal</option>
                            </select>
                            </td>
                            <td><select class="select2 form-select" name="addMoreInputFields[4][more]">
                                <option value="mandatory" selected>Mandatory</option>
                              </select>
                            </td>
                            <td class="text-center">
                                DEFAULT
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="addMoreInputFields[5][kolom]" value="latitude" class="form-control" readonly/>
                            </td>
                            <td>
                                <select class="select2 form-select" name="addMoreInputFields[5][type]">
                              <option value="decimal" selected>decimal</option>
                            </select>
                            </td>
                            <td><select class="select2 form-select" name="addMoreInputFields[5][more]">
                                <option value="mandatory" selected>Mandatory</option>
                              </select>
                            </td>
                            <td class="text-center">
                                DEFAULT <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add Field</button>
                            </td>
                        </tr>
    
                        {{-- <tr>
                    <td><input type="text" name="addMoreInputFields[0][kolom]" placeholder="Enter Column" class="form-control" /></td>
                    <td>
                        <select class="select2 form-select" name="addMoreInputFields[0][type]">
                            <option value="#" selected>Select Type</option>
                      <option value="date">date</option>
                      <option value="dateTime">dateTime</option>
                      <option value="decimal">decimal</option>
                      <option value="integer">integer</option>
                      <option value="string">string</option>
                      <option value="text">text</option>
                      <option value="time">time</option>
                      <option value="timestamp">timestamp</option>
                    </select></td>
                    <td>

                        <select class="select2 form-select" name="addMoreInputFields[0][more]">
                            <option value="nullable" selected>Null</option>
                      <option value="mandatory">Mandatory</option>
                      <option value="unique">Unique</option>
                    </select></td>
                     <td class="text-center"><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add Field</button></td>
                  </tr> --}}
                    </table>
                    <button type="submit" class="btn btn-primary btn-sm float-end mt-2">Save</button>
                              </form>
                </div>
                <div class="row tbnonspatial box2 mt-2 mb-2">
                    <form action="{{ route('createTB') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                                  <table class="table table-bordered" id="dynamicAddRemove2">
                                    <input type="hidden" name="type_table" class="form-control" value="Non Spatial" required>
                                    <tr>
                                        <td colspan="2">
                                            <input type="text" name="name_table" class="form-control" placeholder="Enter Table Name" required>
                                          </td>
                                        <td colspan="1">
                                            <select class="select2 form-select" name="roles_table" required>
                                                {{-- <option value="#" selected>Select Table Role</option> --}}
                                                <option value="Private" selected>Private</option>
                                                <option value="Public">Public</option>
                                              </select>
                                        </td>
                                        <td colspan="1">
                                            <select class="select2 form-select" name="status_table" required>
                                                {{-- <option value="#" selected>Select Table Status</option> --}}
                                                <option value="ActiveAdmin">Active Admin Only</option>
                                                <option value="Active" selected>Active</option>
                                                <option value="Inactive">Inactive</option>
                                              </select>
                                        </td>
                                    </tr>
                            <tr>
                                <th class="text-center">Column Name</th>
                                <th class="text-center">Type / Source</th>
                                <th class="text-center">Option</th>
                                <th class="text-center">Action / Notes</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="addMoreInputFields[0][kolom]" value="keldes" class="form-control" readonly/>
                                </td>
                                <td>
                                    <select class="select2 form-select" name="addMoreInputFields[0][type]">
                                  <option value="string" selected>string</option>
                                </select>
                                </td>
                                <td><select class="select2 form-select" name="addMoreInputFields[0][more]">
                                    <option value="mandatory" selected>Mandatory</option>
                                  </select>
                                </td>
                                <td class="text-center">
                                    DEFAULT
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="addMoreInputFields[1][kolom]" value="kecamatan" class="form-control" readonly/>
                                </td>
                                <td>
                                    <select class="select2 form-select" name="addMoreInputFields[1][type]">
                                  <option value="string" selected>string</option>
                                </select>
                                </td>
                                <td><select class="select2 form-select" name="addMoreInputFields[1][more]">
                                    <option value="mandatory" selected>Mandatory</option>
                                  </select>
                                </td>
                                <td class="text-center">
                                    DEFAULT
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="addMoreInputFields[2][kolom]" value="kabkot" class="form-control" readonly/>
                                </td>
                                <td>
                                    <select class="select2 form-select" name="addMoreInputFields[2][type]">
                                  <option value="string" selected>string</option>
                                </select>
                                </td>
                                <td><select class="select2 form-select" name="addMoreInputFields[2][more]">
                                    <option value="mandatory" selected>Mandatory</option>
                                  </select>
                                </td>
                                <td class="text-center">
                                    DEFAULT
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="addMoreInputFields[3][kolom]" value="provinsi" class="form-control" readonly/>
                                </td>
                                <td>
                                    <select class="select2 form-select" name="addMoreInputFields[3][type]">
                                  <option value="string" selected>string</option>
                                </select>
                                </td>
                                <td><select class="select2 form-select" name="addMoreInputFields[3][more]">
                                    <option value="mandatory" selected>Mandatory</option>
                                  </select>
                                </td>
                                <td class="text-center">
                                    DEFAULT <button type="button" name="add" id="dynamic-ar2" class="btn btn-outline-primary">Add Field</button>
                                </td>
                            </tr>
                        </table>
                        <button type="submit" class="btn btn-primary btn-sm float-end mt-2">Save</button>
                                  </form>
                </div>
                             <div class="row p-3">
                                <div id="tabel-dataset"></div>
                             </div>
                </div>

                <div class="tab-pane fade" id="layerdatatab" role="tabpanel" aria-labelledby="layerdata-tab">
                <h4>Layer</h4>
                <p>Pilih layer untuk menampilkan tabel atau menambahkan data</p>

                <select class="form-control form-control-sm jtable w-100 mt-2" name="jenis_data" id="jenis_data">
                    <option value="tbnonselect" selected>Select Master Data</option>
                    @foreach ($spatial_layer as $item)
                    <option value="{{$item->title}}">{{$item->name}}</option>  
                    @endforeach
                    <option value="tb_poi">Point Of Interest</option>  
                    <option value="tb_spd">Survey Potensi Desa</option>
                    <option value="tb_kp">Kawasan prioritas</option>
                    <option value="tb_penerima_bantuan">Penerima Bantuan</option>
                </select> 

                <div class="row mb-2 mt-2">
                   <div id="tabelForm"></div>  
                </div>
                <div class="row p-3">
                   <div id="tblayer"></div>
                </div>

                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('addon-script')
<script type="text/javascript">
    var a = 5;
    $("#dynamic-ar").click(function () {
        ++a;
        $("#dynamicAddRemove").append('<tr><td><input type="text" name="addMoreInputFields[' + a +
            '][kolom]" placeholder="Enter Column" class="form-control" required/></td><td><select class="select2 form-select" name="addMoreInputFields[' + a +'][type]"><option value="date">date</option><option value="dateTime">dateTime</option><option value="decimal">decimal</option><option value="integer">integer</option><option value="string">string</option><option value="text">text</option><option value="time">time</option><option value="timestamp">timestamp</option></select></td><td><select class="select2 form-select" name="addMoreInputFields[' + a +'][more]"><option value="mandatory">Mandatory</option><option value="unique">Unique</option><option value="nullable">Null</option></select></td><td class="text-center"><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>');
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
    var b = 3;
    $("#dynamic-ar2").click(function () {
        ++b;
        $("#dynamicAddRemove2").append('<tr><td><input type="text" name="addMoreInputFields[' + b +
            '][kolom]" placeholder="Enter Column" class="form-control" required/></td><td><select class="select2 form-select" name="addMoreInputFields[' + b +'][type]"><option value="date">date</option><option value="dateTime">dateTime</option><option value="decimal">decimal</option><option value="integer">integer</option><option value="string">string</option><option value="text">text</option><option value="time">time</option><option value="timestamp">timestamp</option></select></td><td><select class="select2 form-select" name="addMoreInputFields[' + b +'][more]"><option value="mandatory">Mandatory</option><option value="unique">Unique</option><option value="nullable">Null</option></select></td><td class="text-center"><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>');
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>

<script>
    $(document).ready(function() {
            $(".jtable").change(function() {
                $(this).find("option:selected").each(function() {
                    var optionValue = $(this).attr("value");
                    if (optionValue) {
                        $(".box2").not("." + optionValue).hide();
                        $("." + optionValue).show();
                    } else {
                        $(".box2").hide();
                    }
                });
            }).change();
        });
    $('.up1').change(function() {
        if ($('.up1').val() == '') {
            $('.imp1').attr('disabled', true)
        } else {
            $('.imp1').attr('disabled', false);
        }
    })
    $('.up2').change(function() {
        if ($('.up2').val() == '') {
            $('.imp2').attr('disabled', true)
        } else {
            $('.imp2').attr('disabled', false);
        }
    })
    $('.up3').change(function() {
        if ($('.up3').val() == '') {
            $('.imp3').attr('disabled', true)
        } else {
            $('.imp3').attr('disabled', false);
        }
    })
</script>

<script src="{{ url('assets/table/table-field.js') }}"></script>
   
   <script>

var menu_jdata = document.getElementById("jenis_data");
        menu_jdata.addEventListener("change", generateData);

        function generateData(event) {
                ShowTabelAll(menu_jdata.value, 'tblayer');
                ShowFormTabel(menu_jdata.value, 'tabelForm');
        }

function updateRequiredAttribute() {
    // Get all input elements
    var inputs = document.getElementsByTagName("input");
    var textareas = document.getElementsByTagName("textarea");
    var selects = document.getElementsByTagName("select");


    // Loop through each input element
    for (var i = 0; i < inputs.length; i++) {
        var input = inputs[i];
        
        // Check if the input element has the 'YES' attribute
        if (input.getAttribute("YES") !== null) {
            // If 'YES' attribute is present, set 'required' attribute to 'false'
            input.setAttribute("required", "false");
        } else if (input.getAttribute("NO") !== null) {
            // If 'NO' attribute is present, set 'required' attribute to 'true'
            input.setAttribute("required", "true");
        }
    }

        // Loop through each input element
        for (var i = 0; i < textareas.length; i++) {
        var textarea = textareas[i];
        
        // Check if the input element has the 'YES' attribute
        if (textarea.getAttribute("YES") !== null) {
            // If 'YES' attribute is present, set 'required' attribute to 'false'
            textarea.setAttribute("required", "false");
        } else if (textarea.getAttribute("NO") !== null) {
            // If 'NO' attribute is present, set 'required' attribute to 'true'
            textarea.setAttribute("required", "true");
        }
    }

           // Loop through each input element
           for (var i = 0; i < selects.length; i++) {
        var select = selects[i];
        
        // Check if the input element has the 'YES' attribute
        if (select.getAttribute("YES") !== null) {
            // If 'YES' attribute is present, set 'required' attribute to 'false'
            select.setAttribute("required", "false");
        } else if (select.getAttribute("NO") !== null) {
            // If 'NO' attribute is present, set 'required' attribute to 'true'
            select.setAttribute("required", "true");
        }
    }
}


        function ShowFormTabel(nmTabel, idhtml) {
    $.ajax({
        url: base_url + '/TabelField/' + nmTabel,
        type: "get",
        data: {
            tabel: nmTabel,
        },
        success: function (data) {
            if (data) {
                $('#' + idhtml).empty(); // Clear the content before appending new elements

                $('#' + idhtml).append('<p class="mb-0 titleForm">Form tambah data baru :</p>');
                $('#' + idhtml).append('<form action="{{route('addNewRow')}}" method="post" id="formtbSelect" enctype="multipart/form-data">@csrf</form>');
                $('#formtbSelect').append('<input type="hidden" class="form-control mb-2" name="tabel" id="tabel" value="' + nmTabel + '">');
                $('#formtbSelect').append('<div class="row formtb"></div>');

                $.each(data, function (key, value) {
                    switch (value.data_type) {
                        case "character varying":
                            $('.formtb').append('<div class="col-md-6"><select class="form-control mb-2" name="' + value.column_name + '" id="' + value.column_name + '"></select></div>');
                            // $('.formtb').append('<div class="col-md-6"><input type="text" class="form-control mb-2" name="' + value.column_name + '" id="' + value.column_name + '" placeholder="' + value.column_name + '" ' + value.is_nullable +'></div>');
                            break;
                        case "integer":
                            $('.formtb').append('<div class="col-md-6"><input type="number" class="form-control mb-2" name="' + value.column_name + '" id="' + value.column_name + '" placeholder="' + value.column_name + '" ' + value.is_nullable + '></div>');
                            break;
                        case "text":
                            $('.formtb').append('<div class="col-md-6"><textarea name="' + value.column_name + '" id="' + value.column_name + '" class="form-control mb-2" rows="5" placeholder="' + value.column_name + '" ' + value.is_nullable + '></textarea></div>');
                            break;
                        case "numeric":
                            $('.formtb').append('<div class="col-md-6"><input type="text" name="' + value.column_name + '" id="' + value.column_name + '" class="form-control mb-2" placeholder="' + value.column_name + '" ' + value.is_nullable + '></div>');
                            break;
                            case "date":
                            $('.formtb').append('<div class="col-md-6"><input type="date" name="' + value.column_name + '" id="' + value.column_name + '" class="form-control mb-2" placeholder="' + value.column_name + '" ' + value.is_nullable + '></div>');
                            break;
                        default:
                            break;
                    };
                });

                $('#formtbSelect').append('<button class="btn btn-outline-dark mt-2 mb-2 float-end mx-2" type="reset">Reset</button><button class="btn btn-primary mt-2 mb-2 float-end" type="submit">Save</button>');
            updateRequiredAttribute();
            // getProvinceList();
            populateDropdown();
            } else {
                $('#' + idhtml).empty(); // Clear the content if there is no data
            }
        },
    });
};

function populateDropdown(element, url, paramName) {
        var selectedValue = element.val();

        $.ajax({
            url: base_url + url + selectedValue,
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function (data) {
                if (data) {
                    element.nextAll('select').empty();
                    element.nextAll('select').append('<option hidden value="">Select provinsi</option>');
                    $.each(data, function (key, value) {
                        element.nextAll('select').append('<option value="' + value[wadmpr] + '">' + value[wadmpr] + '</option>');
                    });
                } else {
                    element.nextAll('select').empty();
                }
            }
        });
    }

    $(document).ready(function () {
        // Dropdown chained province
        $('#provinsi').on('change', function () {
            populateDropdown($(this), '/getRegency/', 'wadmkk');
        });

        // Dropdown chained regency
        $('#kabkot').on('change', function () {
            populateDropdown($(this), '/getDistrict/', 'wadmkc');
        });

        // Dropdown chained district
        $('#kecamatan').on('change', function () {
            populateDropdown($(this), '/getSubdistrict/', 'wadmkd');
        });
    });


 // dropdown chained regency
 function getProvinceList() {
              $.ajax({
                  url: base_url + '/getProvince',
                  type: "GET",
                  data: {
                      "_token": "{{ csrf_token() }}"
                  },
                  dataType: "json",
                  success: function(data) {
                      if (data) {
                          $('#provinsi').empty();
                          $('#provinsi').append('<option hidden value="pilihprovinsi" selected>Select Provinsi</option>');
                          $.each(data, function(key, value) {
                              $('select[name="provinsi"]').append('<option value="' + value.wadmpr + '">' + value.wadmpr + '</option>');
                          });
                      } else {
                          $('#provinsi').empty();
                      }
                  }
              });
            };
            
  // dropdown chained regency
  $(document).ready(function() {
      $('#provinsi').on('change', function() {
          var provinsiID = $(this).val();
          if (provinsiID) {
              $.ajax({
                  url: base_url + '/getRegency/' + provinsiID,
                  type: "GET",
                  data: {
                      "_token": "{{ csrf_token() }}"
                  },
                  dataType: "json",
                  success: function(data) {
                      if (data) {
                          $('#kabkot').empty();
                          $('#kabkot').append('<option hidden value="pilihkabkot" selected>Select Kabkot</option>');
                          $.each(data, function(key, value) {
                              $('select[name="kabkot"]').append('<option value="' + value.wadmkk + '">' + value.wadmkk + '</option>');
                          });
                      } else {
                          $('#kabkot').empty();
                      }
                  }
              });
          } else {
              $('#kabkot').empty();
          }
      });
  });

  // dropdown chained district
  $(document).ready(function() {
      $('#kabkot').on('change', function() {
          var kabkotID = $(this).val();
          if (kabkotID) {
              $.ajax({
                  url: base_url + '/getDistrict/' + kabkotID,
                  type: "GET",
                  data: {
                      "_token": "{{ csrf_token() }}"
                  },
                  dataType: "json",
                  success: function(data) {
                      if (data) {
                          $('#kecamatan').empty();
                          $('#kecamatan').append('<option hidden value="pilihkecamatan" selected>Select Kecamatan</option>');
                          $.each(data, function(key, value) {
                              $('select[name="kecamatan"]').append('<option value="' + value.wadmkc + '">' + value.wadmkc + '</option>');
                          });
                      } else {
                          $('#kecamatan').empty();
                      }
                  }
              });
          } else {
              $('#kecamatan').empty();
          }
      });
  });

  // dropdown chained urban village 
  $(document).ready(function() {
      $('#kecamatan').on('change', function() {
          var kecamatanID = $(this).val();
          if (kecamatanID) {
              $.ajax({
                  url: base_url + '/getSubdistrict/' + kecamatanID,
                  type: "GET",
                  data: {
                      "_token": "{{ csrf_token() }}"
                  },
                  dataType: "json",
                  success: function(data) {
                      if (data) {
                          $('#keldes').empty();
                          $('#keldes').append('<option hidden value="pilihkelurahan" selected>Select Village</option>');
                          $.each(data, function(key, value) {
                              $('select[name="keldes"]').append('<option value="' + value.wadmkd + '">' + value.wadmkd + '</option>');
                          });
                      } else {
                          $('#keldes').empty();
                      }
                  }
              });
          } else {
              $('#keldes').empty();
          }
      });
  });

        ShowTabel('dataset-data', 'tabel-dataset');

        function ShowTabel(jenis, idhtml) {
            if (jenis == "dataset-data") {
                var nmfield = nmField_dataset;
                var url = base_url + "/ShowTabelDataset";
                var value = true
            } else {}
            $.ajax({
                type: "get",
                url: url,
                success: function(msg) {
                    $("#" + idhtml).dxDataGrid({
                        dataSource: msg["data"],
                        showRowLines: true,
                        rowAlternationEnabled: true,
                        filterRow: {
                            visible: true,
                        },
                        allowColumnResizing: true,
                        columnResizingMode: "widget",
                        columnMinWidth: 50,
                        columnAutoWidth: true,
                        showBorders: true,
                        //         selection: {
                        //     mode: "multiple"
                        // },
                        scrolling: {
                            columnRenderingMode: 'virtual',
                            rowRenderingMode: 'virtual',
                        },
                        paging: {
                            pageSize: 10
                        },
                        pager: {
                            showInfo: true,
                            showPageSizeSelector: true,
                            infoText: "Page #{0}. Total: {1} ({2})",
                            allowedPageSizes: [5, 10, 20]
                        },
                        remoteOperations: false,
                        searchPanel: {
                            visible: true,
                            highlightCaseSensitive: true
                        },
                        groupPanel: {
                            visible: true
                        },
                        grouping: {
                            autoExpandAll: false
                        },
                        allowColumnReordering: true,
                        rowAlternationEnabled: true,
                        editing: {
                            mode: "form",
                            // mode: 'batch',
                            allowUpdating: true,
                            allowAdding: false,
                            allowDeleting: value,
                            selectTextOnEditStart: false,
                            // startEditAction: 'click',
                        },
                        columns: nmfield,

                        onRowRemoving: function(info) {
                            $.ajax({
                                    type: "POST",
                                    url: base_url + "/deleteDataDataset",
                                    data: {
                                        id: info.data.id,
                                        title: info.data.title,
                                        tabel: 'user_tables'
                                    },
                                    headers: {
                                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                            "content"
                                        ),
                                    },
                                    success: function(msg) {
                                        ShowTabel(jenis);
                                    },
                                },
                                "json"
                            );
                        },

                        onRowUpdating: function(e) {
                            const deferred = $.Deferred();
                            const promptPromise = DevExpress.ui.dialog.confirm(
                                "Apa anda yakin?",
                                "Konfirmasi"
                            );
                            promptPromise.done((dialogResult) => {
                                console.log(e);
                                if (dialogResult) {
                                    $.ajax({
                                        url: base_url + "/updateTabel",
                                        dataType: "json",
                                        method: "POST",
                                        data: {
                                            newData: e.newData,
                                            id: e.oldData.id,
                                            tabel: "user_tables",
                                        },
                                        headers: {
                                            "X-CSRF-TOKEN": $(
                                                'meta[name="csrf-token"]').attr(
                                                "content"
                                            ),
                                        },
                                        success: function(validationResult) {
                                            if (validationResult.errorText) {
                                                deferred.reject(
                                                    validationResult
                                                    .errorText
                                                );
                                            } else {
                                                ShowTabel(jenis);
                                                deferred.resolve(false);
                                            }
                                        },
                                        error: function() {
                                            deferred.reject(
                                                "Data Loading Error");
                                        },
                                        timeout: 5000,
                                    });
                                } else {
                                    deferred.resolve(true);
                                }
                            });
                            e.cancel = deferred.promise();
                        },

                        // onContentReady: function(e) {
                        //     if (!collapsed) {
                        //         collapsed = true;
                        //         e.component.expandRow(["EnviroCare"]);
                        //     }
                        // },

                    });
                }
            });
        };

        var collapsed = false;

        var resizingModes = ["nextColumn", "widget"];

        $("#select-resizing").dxSelectBox({
            items: resizingModes,
            value: resizingModes[0],
            width: 250,
            onValueChanged: function(data) {
                dataGrid.option("columnResizingMode", data.value);
            }
        });
        
    </script>

    <script>
          function ShowTabelAll(nmTabel, idhtml) {
            $.ajax({
                type: "get",
                data: {
                tabel: nmTabel,
            },
                url: base_url + "/ShowTabel/" + nmTabel,
                success: function(msg) {
                    $("#tblayer").dxDataGrid({
                        dataSource: msg["data"],
                        showRowLines: true,
                        rowAlternationEnabled: true,
                        filterRow: {
                            visible: true,
                        },
                        allowColumnResizing: true,
                        columnResizingMode: "widget",
                        columnMinWidth: 50,
                        columnAutoWidth: true,
                        showBorders: true,
                        //         selection: {
                        //     mode: "multiple"
                        // },
                        scrolling: {
                            columnRenderingMode: 'virtual',
                            rowRenderingMode: 'virtual',
                        },
                        paging: {
                            pageSize: 10
                        },
                        pager: {
                            showInfo: true,
                            showPageSizeSelector: true,
                            infoText: "Page #{0}. Total: {1} ({2})",
                            allowedPageSizes: [5, 10, 20]
                        },
                        export: {
                    enabled: true,
                    allowExportSelectedData: true,
                    fileName: "DB Notice & Trilateral",
                },
                        remoteOperations: false,
                        searchPanel: {
                            visible: true,
                            highlightCaseSensitive: true
                        },
                        groupPanel: {
                            visible: true
                        },
                        grouping: {
                            autoExpandAll: false
                        },
                        allowColumnReordering: true,
                        rowAlternationEnabled: true,
                        editing: {
                            mode: "form",
                            // mode: 'batch',
                            allowUpdating: true,
                            allowAdding: false,
                            allowDeleting: true,
                            selectTextOnEditStart: false,
                            // startEditAction: 'click',
                        },
                        columns: msg["]nmfield"],

                        onRowRemoving: function(info) {
                            $.ajax({
                                    type: "POST",
                                    url: base_url + "/deleteDataDataset",
                                    data: {
                                        id: info.data.id,
                                        title: info.data.title,
                                        tabel: 'user_tables'
                                    },
                                    headers: {
                                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                            "content"
                                        ),
                                    },
                                    success: function(msg) {
                                        ShowTabel(jenis);
                                    },
                                },
                                "json"
                            );
                        },

                        onRowUpdating: function(e) {
                            const deferred = $.Deferred();
                            const promptPromise = DevExpress.ui.dialog.confirm(
                                "Apa anda yakin?",
                                "Konfirmasi"
                            );
                            promptPromise.done((dialogResult) => {
                                console.log(e);
                                if (dialogResult) {
                                    $.ajax({
                                        url: base_url + "/updateTabel",
                                        dataType: "json",
                                        method: "POST",
                                        data: {
                                            newData: e.newData,
                                            id: e.oldData.id,
                                            tabel: "user_tables",
                                        },
                                        headers: {
                                            "X-CSRF-TOKEN": $(
                                                'meta[name="csrf-token"]').attr(
                                                "content"
                                            ),
                                        },
                                        success: function(validationResult) {
                                            if (validationResult.errorText) {
                                                deferred.reject(
                                                    validationResult
                                                    .errorText
                                                );
                                            } else {
                                                ShowTabel(jenis);
                                                deferred.resolve(false);
                                            }
                                        },
                                        error: function() {
                                            deferred.reject(
                                                "Data Loading Error");
                                        },
                                        timeout: 5000,
                                    });
                                } else {
                                    deferred.resolve(true);
                                }
                            });
                            e.cancel = deferred.promise();
                        },

                        // onContentReady: function(e) {
                        //     if (!collapsed) {
                        //         collapsed = true;
                        //         e.component.expandRow(["EnviroCare"]);
                        //     }
                        // },

                    });
                }
            });
        };

        var collapsed = false;

        var resizingModes = ["nextColumn", "widget"];

        $("#select-resizing").dxSelectBox({
            items: resizingModes,
            value: resizingModes[0],
            width: 250,
            onValueChanged: function(data) {
                dataGrid.option("columnResizingMode", data.value);
            }
        });
    </script>
@endsection



