@extends('layouts.admin')

@section('content')
    <div class="card col-md-12">
        <div class="card-block" style="padding: 1%; padding-top: 1.5%;">
            <ul class="nav nav-tabs float-end" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="layerdata-tab" data-bs-toggle="tab"
                        data-bs-target="#layerdatatab" type="button" role="tab" aria-controls="layerdata"
                        aria-selected="true">Table
                    </button>
                </li>
            </ul>

            <div class="tab-content mt-4" id="myTabContent">
                <div class="tab-pane fade show active" id="layerdatatab" role="tabpanel" aria-labelledby="layerdata-tab">
                    <div class="row p-3">
                        <h4>Table</h4>
                        <p>Pilih layer untuk menampilkan tabel :</p>
                        <select class="form-control form-control-sm w-100 mt-2" name="table_data" id="table_data">
                            <option value="noselect" selected>Select Table</option>
                            @foreach ($spatial_layer as $item)
                            <option value="{{$item->title}}">{{$item->name}}</option>  
                            @endforeach
                            <option value="tb_poi">Point Of Interest</option>  
                            <option value="tb_spd">Survey Potensi Desa</option>
                            <option value="tb_kp">Kawasan prioritas</option>
                            <option value="tb_penerima_bantuan">Penerima Bantuan</option>
                        </select> 
                        <div id="tblayer"></div>
                     </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection


    @section('addon-modal')

                <div id="ImageView" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document" style="width: 50%;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title mb-0 text-white" id="feature-title">
                                </h6>
                            </div>
                            <div class="modal-body text-center" id="feature-info">
                            </div>
                            <div class="modal-footer" id="feature-footer">
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
    @endsection



    @section('addon-script')
   
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
// showListSelect();
        var menu_tdata = document.getElementById("table_data");
        menu_tdata.addEventListener("change", generateData);
        function generateData(event) {
            ShowTabelAll(menu_tdata.value, 'tblayer');
        }

        function ShowTabelAll(nmTabel, idhtml) {
    $.ajax({
        type: "get",
        data: {
            tabel: nmTabel,
        },
        url: base_url + "/ShowTabel/" + nmTabel,
        success: function (msg) {
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
                selection: {
                    mode: "multiple",
                },
                scrolling: {
                    rowRenderingMode: "virtual",
                },
                paging: {
                    pageSize: 10,
                },
                pager: {
                    showInfo: true,
                    showPageSizeSelector: true,
                    infoText: "Page #{0}. Total: {1} ({2})",
                    allowedPageSizes: [5, 10, 20],
                },
                export: {
                    enabled: true,
                    allowExportSelectedData: true,
                    fileName: "Master Excel " + nmTabel,
                },
                remoteOperations: false,
                searchPanel: {
                    visible: true,
                    highlightSearchText: true,
                },
                groupPanel: {
                    visible: true,
                },
                grouping: {
                    autoExpandAll: false,
                },
                allowColumnReordering: true,
                editing: {
                    mode: "form",
                    allowUpdating: false,
                    allowAdding: false,
                    allowDeleting: false,
                    selectTextOnEditStart: false,
                },
                  // Column-specific cell template for columns with the word "lampiran"
                     // columns: msg["nmfield"],
                     columns: msg["nmfield"].map(function (field) {
    if (field.dataField.includes("lampiran")) { // Menggunakan includes() untuk mencari kata 'lampiran'
        return {
            dataField: field.dataField, // Gunakan nama kolom yang sesuai dengan dataField
            caption: "Lampiran",
            cellTemplate: function (container, options) {
                // var content =
                //     "<object data='https://sigap-fbb.kominfo.go.id/storage/lampiran/" +
                //     options.value +
                //     "' frameborder='0' style='width:100%; height:400px; overflow-y:auto;'>";
                var content =
                    "<embed src='https://sigap-fbb.kominfo.go.id/storage/lampiran/" +
                    options.value +
                    "' frameborder='0' style='width:100%; height:400px; overflow-y:auto;'>";
                var footer =
                    "<a href='https://sigap-fbb.kominfo.go.id/storage/lampiran/" +
                    options.value +
                    "' download='Dokumen Lampiran' class='btn btn-sm btn-primary mb-0 text-center'>Download</a>" +
                    "<button type='button' class='btn btn-sm btn-outline-dark mb-0 text-center' data-bs-dismiss='modal'>Close</button>";

                container.on("click", function (e) {
                    $("#feature-title").html("Dokumen Lampiran");
                    $("#feature-info").html(content);
                    $("#feature-footer").html(footer);
                });

                $("<a>")
                    .attr("data-bs-toggle", "modal")
                    .attr("data-bs-target", "#ImageView")
                    .append(
                        "<span class='iconify' data-icon='bi:eye-fill' style='color: #1ca8dd; text-align: center;'></span> <span style='color: #1ca8dd;'>view</span>"
                    )
                    .appendTo(container);
            },
        };
    } else {
        // Return other columns as-is
        return field;
    }
}),

                // onContentReady: function(e) {
                //     if (!collapsed) {
                //         collapsed = true;
                //         e.component.expandRow(["EnviroCare"]);
                //     }
                // },
            });
        },
    });
}
</script>
@endsection



