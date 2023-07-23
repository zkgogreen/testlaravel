@extends('layouts.admin')

@push('addon-modal')
    <!-- modal import excel -->
    <div class="modal" id="addPengguna" tabindex="-1" role="dialog" aria-labelledby="Add Pengguna Baru" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="width: 25%;">
            <div class="modal-content">
                <div class="modal-header p-1 col-md-12">
                    <div class="col-md-2">
                        <span class="iconify" data-icon="akar-icons:arrow-left" data-width="19" data-dismiss="modal"
                            data-height="19"></span>
                    </div>
                    <div class="col-md-8 text-center">
                        <h4 class="modal-title mb-0" id="addPenggunaTitle" style="margin-left: 3%;">Tambah Pengguna
                        </h4>
                    </div>
                    <div class="col-md-2">
                    </div>
                </div>
                <div class="modal-body text-center">
                    {{-- <span class="iconify" data-icon="lucide:import" data-width="100" data-height="100"
                data-flip="horizontal"></span> --}}
                    <form action="{{ route('add-pengguna') }}" method="POST">
                        @csrf
                        <!-- name -->
                        <div class="mb-3">
                            <input id="name" type="text"
                                class="form-control form-style-custom2 @error('name') is-invalid @enderror" name="name"
                                placeholder="Nama Lengkap" value="{{ old('name') }}" required autocomplete="name"
                                autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- Email -->
                        <div class="mb-3">
                            <input type="email"
                                class="form-control form-style-custom  @error('email') is-invalid @enderror" name="email"
                                placeholder="Email" required autocomplete="email" autofocus value="{{ old('email') }}">
                            <span class="iconify icon-style-custom" data-icon="gridicons:user" data-width="29"
                                data-height="29"></span>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- Password -->
                        <div class="mb-3">
                            <input type="password"
                                class="form-control form-style-custom @error('password') is-invalid @enderror"
                                placeholder="Password" aria-label="Password" aria-describedby="password-addon"
                                name="password" required autocomplete="new-password">
                            <span class="iconify icon-style-custom" data-icon="dashicons:lock" data-width="29"
                                data-height="29"></span>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- confirmation Password -->
                        <div class="mb-3">
                            <input type="password" class="form-control form-style-custom" placeholder="Confirm Password"
                                aria-label="Password" aria-describedby="password-addon" name="password_confirmation"
                                required autocomplete="new-password">
                            <span class="iconify icon-style-custom" data-icon="dashicons:lock" data-width="29"
                                data-height="29"></span>
                        </div>
                        <div class="mb-3">
                            <select class="form-control form-style-custom2" name="roles">
                                <option value="">Pilih Level</option>
                                <option value="SUPER USER">SUPER USER</option>
                                <option value="ADMIN">ADMIN</option>
                                <option value="USER">USER</option>
                            </select>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-sm bg-primary text-white mb-0 text-center"
                                style=" border-radius: 4px; width: 30%; text-transform: none;">Simpan</span></button>
                            <button type="reset" class="btn btn-sm btn-secondary  mb-0 text-center"
                                style="border-radius: 4px;width: 30%;text-transform: none; border:1px solid #dfe0e1"
                                data-bs-dismiss="modal">Batal</span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal import excel -->


    <!-- modal import excel -->
    <div class="modal" id="deleteConfirm" tabindex="-1" role="dialog" aria-labelledby="Delete Confirm"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="width: 25%;">
            <div class="modal-content">
                <div class="modal-body text-center">
                    {{-- <span class="iconify" data-icon="lucide:import" data-width="100" data-height="100"
              data-flip="horizontal"></span> --}}
                    <!-- name -->
                    <div>
                        <h4 class="text-center">Yakin akan menghapus data ?</h4>
                        <p class="text-center">data yang telah di hapus tidak akan bisa dikembalikan</p>
                    </div>

                    <div class="text-center">
                        <button type="submit" id="modalDelete" class="btn btn-sm bg-primary text-white mb-0 text-center"
                            style=" border-radius: 4px; width: 30%; text-transform: none;">Hapus</span></button>
                        <button type="reset" class="btn btn-sm btn-secondary  mb-0 text-center"
                            style="border-radius: 4px;width: 30%;text-transform: none; border:1px solid #dfe0e1"
                            data-bs-dismiss="modal">Batal</span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal import excel -->

@endpush

@section('content')
    <div class="card col-md-12">
        <!-- <div class="card-block" style="padding: 1%; padding-top: 1.5%;"> -->
        <div class="card-body" style="padding:2%;">
            <!-- <h4 class="card-title">Simple Basic Map</h4> -->
            <div class="justify-content-center mb-3">
                {{-- <h4 class="mb-0">Daftar Pengguna & Hak Akses</h4> --}}
                {{-- <a href="#"><small>Show All</small></a> --}}
                <h4>User & Roles Access</h4>
                <p>Management daftar user yang dapat mengakases sistem SIGAP-FBB:</p>
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
                                url: base_url + "/addData",
                                dataType: "json",
                                method: "POST",
                                data: {
                                    newData: e.data,
                                    tabel: "users",
                                },
                                headers: {
                                    "X-CSRF-TOKEN": $(
                                        'meta[name="csrf-token"]'
                                    ).attr("content"),
                                },
                                success: function() {
                                    ShowTabel('user-data', 'tabel-user');
                                },

                            });
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
