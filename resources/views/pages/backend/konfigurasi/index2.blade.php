@extends('layouts.admin')

@section('content')
    <div class="card col-md-12">
        <div class="card-block" style="padding: 1%; padding-top: 1.5%;">
            <!-- <h4 class="card-title">Simple Basic Map</h4> -->
            <div class="tabs">
                <div class="tab-2">
                    <label for="tab2-1">Basemap & Layer</label>
                    <input id="tab2-1" name="tabs-two" type="radio" checked="checked">
                    <div>
                        <br />
                        <h4 class="text-center">LIST BASEMAP.</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" style="text-align:center;">#</th>
                                        <th scope="col" style="text-align:center;">Basemap</th>
                                        <th scope="col" colspan="2" style="text-align:center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row" style="text-align:center;">1</th>
                                        <td style="text-align:center;">Esri World Imagery</td>
                                        <td style="text-align:center;"><input type="checkbox" checked data-toggle="toggle">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="text-align:center;">2</th>
                                        <td style="text-align:center;">Open Street Map</td>
                                        <td style="text-align:center;"><input type="checkbox" checked data-toggle="toggle">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="text-align:center;">3</th>
                                        <td style="text-align:center;">CartoDB Dark Matter</td>
                                        <td style="text-align:center;"><input type="checkbox" checked data-toggle="toggle">
                                        </td>
                                    </tr>

                                    <!--      <tr>
                                                        <th scope="row" style="text-align:center;">4</th>
                                                        <td style="text-align:center;">Calon Penerima Bantuan</td>
                                                        <td style="text-align:center;"><a href="http://localhost:8080/geoserver/kominfo/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=kominfo:calon_penerima_bantuan&outputFormat=SHAPE-ZIP">SHP</a></td>
                                                        <td style="text-align:center;"><a href="http://localhost:8080/geoserver/kominfo/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=kominfo:calon_penerima_bantuan&outputFormat=excel2007">XLSX</a></td>
                                                        </tr> -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-2">
                    <label for="tab2-2">Legenda</label>
                    <input id="tab2-2" name="tabs-two" type="radio">
                    <div>
                        <br />
                        <p>Layar yang terceklis akan muncul pada list layer di peta.</p>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" style="text-align:center;">#</th>
                                        <th scope="col" style="text-align:center;">Layer</th>
                                        <th scope="col" colspan="2" style="text-align:center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row" style="text-align:center;">1</th>
                                        <td style="text-align:center;">Kawasan Prioritas</td>
                                        <td style="text-align:center;"><input type="checkbox" checked data-toggle="toggle">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="text-align:center;">2</th>
                                        <td style="text-align:center;">Penerima Bantuan</td>
                                        <td style="text-align:center;"><input type="checkbox" checked data-toggle="toggle">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="text-align:center;">3</th>
                                        <td style="text-align:center;">Podes BPS 2018 </td>
                                        <td style="text-align:center;"><input type="checkbox" data-toggle="toggle"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="text-align:center;">4</th>
                                        <td style="text-align:center;">Podes BPS 2020 </td>
                                        <td style="text-align:center;"><input type="checkbox" checked data-toggle="toggle">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="text-align:center;">5</th>
                                        <td style="text-align:center;">Point of Interest</td>
                                        <td style="text-align:center;"><input type="checkbox" checked data-toggle="toggle">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="text-align:center;">6</th>
                                        <td style="text-align:center;">Survey Potensi Desa</td>
                                        <td style="text-align:center;"><input type="checkbox" checked data-toggle="toggle">
                                        </td>
                                    </tr>

                                    <!--      <tr>
                                                        <th scope="row" style="text-align:center;">4</th>
                                                        <td style="text-align:center;">Calon Penerima Bantuan</td>
                                                        <td style="text-align:center;"><a href="http://localhost:8080/geoserver/kominfo/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=kominfo:calon_penerima_bantuan&outputFormat=SHAPE-ZIP">SHP</a></td>
                                                        <td style="text-align:center;"><a href="http://localhost:8080/geoserver/kominfo/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=kominfo:calon_penerima_bantuan&outputFormat=excel2007">XLSX</a></td>
                                                        </tr> -->
                                </tbody>
                            </table>
                        </div>
                        <br />
                        <h4 class="text-center">LIST LAYER</h4>
                        <p class="text-center">Layer yang terceklis akan muncul pada list layer di peta.</p>
                        <div class="table-responsive">
                            <form action="{{ route('updateLayer', $layer->id) }}" method="post" style="padding:5%;">
                                @method('PUT')
                                @csrf
                                <table class="table">
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
                                                <th scope="row" style="text-align:center;"><input type="text" name="id"
                                                        class="form-control" value="{{ $layer->id }}" disabled></th>
                                                <td style="text-align:center;"><input type="text" name="layername"
                                                        class="form-control" value="{{ $layer->layername }}"></td>
                                                <td style="text-align:center;"><input type="text" class="form-control"
                                                        value="{{ $layer->layertype }}" disabled>
                                                </td>
                                                <td style="text-align:center;">
                                                    <select name="status" class="form-control">
                                                        <option value="" selected>--Pilih Level--</option>
                                                        <option value="Active"
                                                            {{ $layer->status == 'Active' ? 'selected' : '' }}>Active
                                                        </option>
                                                        <option value="Inactive"
                                                            {{ $layer->status == 'Inactive' ? 'selected' : '' }}>Inactive
                                                        </option>
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-sm bg-primary text-white mb-0 text-center"
                                        style=" border-radius: 4px; width: 30%; text-transform: none;">Simpan</span></button>
                                    <button type="reset" class="btn btn-sm btn-secondary  mb-0 text-center"
                                        style="border-radius: 4px;width: 30%;text-transform: none; border:1px solid #dfe0e1"
                                        data-bs-dismiss="modal">Batal</span></button>
                                </div>
                            </form>
                        </div>
                        <br />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
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
    </script>

    <script>
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var user_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/statusLayer',
                    data: {
                        'status': status,
                        'id': user_id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            })
        })
    </script>

@endsection
