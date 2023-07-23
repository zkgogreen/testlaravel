@extends('layouts.admin')

@section('content')
    <div class="card col-md-12">
        <!-- <div class="card-block" style="padding: 1%; padding-top: 1.5%;"> -->
        <div class="card-body" style="padding:2%;">
            @if (Auth::user()->roles == 'ADMIN')
                <div class="d-flex justify-content-between mb-3">
                    <a class="btn btn-sm btn-primary" href="{{ route('pbCreate') }}" style="border-radius: 8px;">
                        <span class="text-white" style="font-size: 13px;">Tambah Data</span></a>
                    <h4 class="mb-0">Penerima Bantuan Pelatihan</h4>
                    <h5></h5>
                </div>
            @else
                <div class="d-flex justify-content-center mb-3">
                    <h4 class="mb-0">Penerima Bantuan Pelatihan</h4>
                    {{-- <a href="#"><small>Show All</small></a> --}}
                </div>
            @endif
            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est quod cupiditate esse fuga</p> --}}

            @if (Auth::user()->roles == 'ADMIN')
                <div id="tabel-pb"></div>
            @elseif (Auth::user()->roles == 'SUPER USER')
                <div id="tabel-pb-2"></div>
            @elseif (Auth::user()->roles == 'USER')
                <div id="tabel-pb-3"></div>
            @else
            @endif
        </div>
    </div>
@endsection

@section('addon-script')
    <script src="{{ url('assets/table/table-field.js') }}"></script>
    <script>
        ShowTabel('pb-data', 'tabel-pb');
        ShowTabel('pb-data-2', 'tabel-pb-2');
        ShowTabel('pb-data-3', 'tabel-pb-3');

        function ShowTabel(jenis, idhtml) {
            if (jenis == "pb-data") {
                var nmfield = nmField_pb;
                var url = base_url + "/ShowTabelPB";
                var value = true
            } else if (jenis == "pb-data-2") {
                var nmfield = nmField_pb_2;
                var url = base_url + "/ShowTabelPB";
                var value = false
            } else if (jenis == "pb-data-3") {
                var nmfield = nmField_pb_3;
                var url = base_url + "/ShowTabelPB";
                var value = false
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
                            allowUpdating: false,
                            allowAdding: false,
                            allowDeleting: value,
                            selectTextOnEditStart: false,
                            // startEditAction: 'click',
                        },
                        columns: nmfield,

                        onRowRemoving: function(info) {
                            $.ajax({
                                    type: "POST",
                                    url: base_url + "/deleteData",
                                    data: {
                                        id: info.data.id,
                                        tabel: 'pb_maps'
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
                                            tabel: "pb_maps",
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
