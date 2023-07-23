@extends('layouts.admin')

@section('content')
    <div class="card col-md-12">
        <!-- <div class="card-block" style="padding: 1%; padding-top: 1.5%;"> -->
        <div class="card-body" style="padding:2%;">
            <h4 class="text-center">LIST BASEMAP</h4>
            <p class="text-center">List yang aktif akan muncul pada list basemap di peta.</p>
            <div class="table-responsive p-3">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th scope="col" style="text-align:center;">#</th>
                            <th scope="col" style="text-align:center;">Attribution</th>
                            <th scope="col" style="text-align:center;">Variant</th>
                            <th scope="col" style="text-align:center;">Status</th>
                            <th scope="col" colspan="2" style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($basemaps as $basemap)
                            <tr>
                                <th scope="row" style="text-align:center;">{{ $basemap->id }}</th>
                                <td style="text-align:center;">{{ $basemap->attribution }}</td>
                                <td style="text-align:center;">{{ $basemap->variant }}
                                </td>
                                <td style="text-align:center;">
                                    <select name="status" class="form-control" disabled>
                                        <option value="" selected>--Pilih Level--</option>
                                        <option value="Active" {{ $basemap->status == 'Active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="Inactive" {{ $basemap->status == 'Inactive' ? 'selected' : '' }}>
                                            Inactive
                                        </option>
                                    </select>
                                </td>
                                <td style="text-align:center;">
                                    <a href="{{ route('editBase', $basemap->id) }}"
                                        class="btn btn-link text-dark px-3 mb-0" data-toggle="tooltip"
                                        data-original-title="Edit item">
                                        <span class="iconify" data-icon="ci:edit" data-width="19"
                                            data-height="19"></span> Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <h4 class="text-center">LIST LAYER</h4>
            <p class="text-center">List yang aktif akan muncul pada list layer di peta & list data (tabel).</p>
            <div class="table-responsive p-3">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th scope="col" style="text-align:center;">#</th>
                            <th scope="col" style="text-align:center;">Layer</th>
                            <th scope="col" style="text-align:center;">Tipe Data</th>
                            <th scope="col" style="text-align:center;">Status</th>
                            <th scope="col" colspan="2" style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($layers as $layer)
                            <tr>
                                <th scope="row" style="text-align:center;">{{ $layer->id }}</th>
                                <td style="text-align:center;">{{ $layer->layername }}</td>
                                <td style="text-align:center;">{{ $layer->layertype }}
                                </td>
                                <td style="text-align:center;">
                                    <select name="status" class="form-control" disabled>
                                        <option value="" selected>--Pilih Level--</option>
                                        <option value="Active" {{ $layer->status == 'Active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="Inactive" {{ $layer->status == 'Inactive' ? 'selected' : '' }}>
                                            Inactive
                                        </option>
                                    </select>
                                </td>
                                <td style="text-align:center;">
                                    <a href="{{ route('editLayer', $layer->id) }}"
                                        class="btn btn-link text-dark px-3 mb-0" data-toggle="tooltip"
                                        data-original-title="Edit item">
                                        <span class="iconify" data-icon="ci:edit" data-width="19"
                                            data-height="19"></span> Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
