@extends('layouts.admin')

@section('content')
    <div class="card col-md-12">
        <div class="card-body p-5">
            <div class="justify-content-center mb-3">
                <h4 class="mb-0 text-center">CONTENT MANAGEMENT</h4>
<p class="text-justify">Halaman ini dipergunakan Untuk mengganti konten yang terdapat pada halaman depan sebelum login dan layer counter yang di tampilkan pada halaman sesuai section :</p>
<div class="row">
<label for="inputPassword" class="col-sm-2 col-form-label">List Tabel : </label>
<div class="col-sm-10">
<select class="form-control" name="tList" id="tList">
    <option value="noselect">Pilih Tabel</option>
    @foreach ($table_layer as $item)
        <option value="{{$item->title}}">{{$item->title}}</option>
    @endforeach
</select>
<div id="formtitle" class="form-text">Untuk mengisi value pada kolom 'layer', gunakan nama yang tertampilan pada menu ini.
    </div>
</div>
</div>
<div class="row">
    <label for="inputPassword" class="col-sm-2 col-form-label">List Kolom : </label>
    <div class="col-sm-10">
    <select class="form-control" name="kList" id="kList"></select>
    <div id="formtitle" class="form-text">Untuk mengisi value pada kolom 'kolom', gunakan nama yang tertampilan pada menu ini.
        </div>
    </div>
    </div>

<div id="tabel-content"></div>
            </div>
        </div>
    </div>
@endsection



@section('addon-script')
    <script src="{{ url('assets/table/table-field.js') }}"></script>
    <script>
        $(document).ready(function () {
    $('#tList').on('change', function () {
      var tableID = $(this).val();
      if (tableID) {
        $.ajax({
          url: base_url + '/ContentField/' + tableID,
          type: "GET",
          data: {
            "_token": "{{ csrf_token() }}"
          },
          dataType: "json",
          success: function (data) {
            if (data) {
              $('#kList').empty();
              $('#kList').append('<option hidden value="pilihkolom" selected>Piloh Kolom</option>');
              $.each(data, function (key, value) {
                $('select[name="kList"]').append('<option value="' + value.column_name + '">' + value.column_name + '</option>');
              });
            } else {
              $('#kList').empty();
            }
          }
        });
      } else {
        $('#kList').empty();
      }
    });
  });

        ShowTabel('content-data', 'tabel-content');
        // ShowTabel_dua('spd-data-2', 'tabel-spd-2');

        function ShowTabel(jenis, idhtml) {
            if (jenis == "content-data") {
                var nmfield = nmField_content;
                var url = base_url + "/ShowTabelContent";
            } else {}
            $.ajax({
                type: "get",
                url: url,
                success: function(msg) {
                    $("#" + idhtml).dxDataGrid({
                        dataSource: msg["data"],
                        keyExpr: 'id',
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
                            allowDeleting: false,
                        },
                        columns: nmfield,

                        onRowRemoving: function(info) {
                            $.ajax({
                                    type: "POST",
                                    url: base_url + "/deleteData",
                                    data: {
                                        id: info.data.id,
                                        tabel: 'users',
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
                                            tabel: "content",
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
                        onRowInserting: function(e) {
                    $.ajax({
                        url: base_url + "/add-user",
                        dataType: "json",
                        method: "POST",
                        data: {
                            data: e.data,
                        },
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        success: function(msg) {
                            ShowTabel('user-data', 'tabel-user');
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
                },

                        // onRowInserting: function(e) {
                        //     $.ajax({
                        //         url: base_url + "/add-user",
                        //         dataType: "json",
                        //         method: "POST",
                        //         data: {
                        //             newData: e.data,
                        //             tabel: "users",
                        //         },
                        //         headers: {
                        //             "X-CSRF-TOKEN": $(
                        //                 'meta[name="csrf-token"]'
                        //             ).attr("content"),
                        //         },
                        //         success: function() {
                        //             ShowTabel('user-data', 'tabel-user');
                        //         },

                        //     });
                        // },

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
