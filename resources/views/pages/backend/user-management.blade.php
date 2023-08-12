@extends('layouts.admin')

@section('content')
    <div class="card col-md-12">
        <!-- <div class="card-block" style="padding: 1%; padding-top: 1.5%;"> -->
        <div class="card-body" style="padding:2%;">
            <!-- <h4 class="card-title">Simple Basic Map</h4> -->
            <div class="justify-content-center mb-3">
                {{-- <h4 class="mb-0">Daftar Pengguna & Hak Akses</h4> --}}
                {{-- <a href="#"><small>Show All</small></a> --}}
                <h4>User & Roles Access</h4>
                <p>Management daftar user yang dapat mengakases sistem SIGAP-FBB: <br>
                Password default untuk seluruh user baru : <strong>login1243_abc</strong></p>
            </div>

            <div id="tabel-user"></div>

        </div>
    </div>
@endsection

@section('addon-script')
    <script src="{{ url('assets/table/table-field.js') }}"></script>
    <script>
        ShowTabel('user-data', 'tabel-user');
        // ShowTabel_dua('spd-data-2', 'tabel-spd-2');

        function ShowTabel(jenis, idhtml) {
            if (jenis == "user-data") {
                var nmfield = nmField_user;
                var url = base_url + "/ShowTabelUser";
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
                            allowAdding: true,
                            allowDeleting: true,
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
                                            tabel: "users",
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
                            refreshLayer(jenis);
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
