@extends('layouts.admin')

@section('content')
    <div class="card col-md-12">
        <div class="card-block" style="padding: 1%; padding-top: 1.5%;">
            <!-- <h4 class="card-title">Simple Basic Map</h4> -->
            <div class="tabs">
                <div class="tab-2">
                    <label for="tab2-1">Import Excel</label>
                    <input id="tab2-1" name="tabs-two" type="radio" checked="checked">
                    <div>
                        <br />
                        <h4>Import Kawasan Prioritas</h4>
                        <p>Mempersiapkan data dengan bentuk excel untuk Import ke dalam database GIS-DEMAND :</p>
                        <ol type='1' style="margin-left: -2%;">
                            <li>1. Pastikan format data yang akan diImport sudah sesuai dengan aturan Import data :</li>
                            <ul>
                                <li style="list-style-type: circle;">Gunakan contoh format kolom excel berikut : (<a
                                        href="{{ url('sample/MASTER KAWASAN PRIORITAS.xlsx') }}" target="_blank">FORMAT
                                        DATA EXCEL KAWASAN PRIORITAS</a>),</li>
                                <li style="list-style-type: circle;">Kolom <i>ID Desa, Desa/Kelurahan, Kecamatan,
                                        Kabupaten/kota, Provinsi, Jenis Kawasan, 3T</i> <strong>harus diisi</strong>.</li>
                            </ul>
                            <li>2. Simpan (Save) file Excel dengan format .xlsx (excel 2007), jika format.xls lakukan save
                                as menjadi format .xlsx</li>
                        </ol>
                        <hr>
                        <p>Proses import akan membutuhkan waktu beberapa menit (tergantung ukuran file), dan menyesuaikan
                            dengan spesifikasi komputer server dan sambungan internet yang tersedia.
                            Dengan batas maksimal pengunggahan berkas <strong>20 MB</strong>.</p>
                        <!-- Buat sebuah tag form dan arahkan action nya ke controller ini lagi -->
                        <form action="{{ route('import-kp') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group"
                                style="border: 1px solid rgba(0,0,0,.07);line-height: 3;border-radius: 2px;padding: 7px; display: -webkit-box;">
                                <span><input type="file" name="file" class="btn btn-lg up1">
                                    <button type="submit" class="btn btn-success btn-sm imp1" disabled>Import</button>
                                    <!--   <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-spin fa-refresh"></i> Import</button></span> -->
                                    <!-- <input type="submit" name="import" value="Import" class="btn btn-block btn-success btn-sm" data-target="#loading"> -->
                                    <button type="reset" class="btn btn-default btn-sm imp1" disabled>Cancel</button>
                            </div>
                        </form>
                        <br />
                        <h4>Import Survey Potensi Desa</h4>
                        <ol type='1' style="margin-left: -2%;">
                            <li>1. Pastikan format data yang akan diImport sudah sesuai dengan aturan Import data :</li>
                            <ul>
                                <li style="list-style-type: circle;">Gunakan contoh format kolom excel berikut : (<a
                                        href="{{ url('sample/MASTER SURVEY POTENSI DESA.xlsx') }}" target="_blank">FORMAT
                                        DATA EXCEL SURVEY POTENSI DESA</a>),</li>
                                <li style="list-style-type: circle;">Kolom <i>ID Desa, Desa/Kelurahan, Kecamatan,
                                        Kabupaten/kota, Provinsi, Jumlah Penduduk, Jumlah KK, Pendapatan, Pencaharian,
                                        Potensi, Tahun Survey</i> <strong>harus diisi</strong>.</li>
                            </ul>
                            <li>2. Simpan (Save) file Excel dengan format .xlsx (excel 2007), jika format.xls lakukan save
                                as menjadi format .xlsx</li>
                        </ol>
                        <hr>
                        <p>Proses import akan membutuhkan waktu beberapa menit (tergantung ukuran file), dan menyesuaikan
                            dengan spesifikasi komputer server dan sambungan internet yang tersedia.
                            Dengan batas maksimal pengunggahan berkas <strong>20 MB</strong>.</p>
                        <!-- Buat sebuah tag form dan arahkan action nya ke controller ini lagi -->
                        <form action="{{ route('import-spd') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group"
                                style="border: 1px solid rgba(0,0,0,.07);line-height: 3;border-radius: 2px;padding: 7px;display: -webkit-box;">
                                <span><input type="file" name="file" class="btn btn-lg up2">
                                    {{-- <input name="import" type="submit" class="btn btn-success btn-sm imp1" value="Import" disabled> --}}
                                    <button type="submit" class="btn btn-success btn-sm imp2" disabled>Import</button>
                                    <!--   <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-spin fa-refresh"></i> Import</button></span> -->
                                    <!-- <input type="submit" name="import" value="Import" class="btn btn-block btn-success btn-sm" data-target="#loading"> -->
                                    {{-- <a href='' class='btn btn-default btn-sm'>Cancel</a> --}}
                                    <button type="reset" class="btn btn-default btn-sm imp2" disabled>Cancel</button>
                            </div>
                        </form>
                        <br />
                        <hr>
                        <h4>Impor Penerima Bantuan</h4>
                        <ol type='1' style="margin-left: -2%;">
                            <li>Pastikan format data yang akan diImpor sudah sesuai dengan aturan Impor data :</li>
                            <ul>
                                <li style="list-style-type: circle;">Gunakan contoh format kolom excel berikut : (<a
                                        href="{{ url('sample/MASTER PENERIMA BANTUAN.xlsx') }}" target="_blank">FORMAT
                                        DATA EXCEL PENERIMA BANTUAN</a>),</li>
                                <li style="list-style-type: circle;">Kolom <i>ID Desa, Desa/Kelurahan, Kecamatan,
                                        Kabupaten/kota, Provinsi, Nama, Jenis Usaha, Tahun Bantuan, Longitude, Latitude</i>
                                    <strong>harus diisi</strong>.
                                </li>
                                <li style="list-style-type: circle;">Khusus Kolom <i>koordinat Longitude & Latitude</i>
                                    harus di isi dengan derajat desimal, gunakan tanda stip '-' pada nilai derajat minus /
                                    berada pada posisi lintang selatan,</li>
                                <li style="list-style-type: circle;">Gunakan tanah titik '.' di antara pemisah nilai derajat
                                    ke desimal (contoh : <strong>-6.951807, 107.657874</strong>).</li>
                            </ul>
                        </ol>
                        <p>Proses import akan membutuhkan waktu beberapa menit (tergantung ukuran file), dan menyesuaikan
                            dengan spesifikasi komputer server dan sambungan internet yang tersedia.
                            Dengan batas maksimal pengunggahan berkas <strong>20 MB</strong>.</p>
                        <form action="{{ route('import-pb') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group"
                                style="border: 1px solid rgba(0,0,0,.07);line-height: 3;border-radius: 2px;padding: 7px;display: -webkit-box;">
                                <span><input type="file" name="file" class="btn btn-lg up3">
                                    <button type="submit" class="btn btn-success btn-sm imp3" disabled>Import</button>
                                    <!--   <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-spin fa-refresh"></i> Import</button></span> -->
                                    <!-- <input type="submit" name="import" value="Import" class="btn btn-block btn-success btn-sm" data-target="#loading"> -->
                                    {{-- <a href='' class='btn btn-default btn-sm'>Cancel</a> --}}
                                    <button type="reset" class="btn btn-default btn-sm imp3" disabled>Cancel</button>
                            </div>
                        </form>
                        <br />
                    </div>
                </div>
                <div class="tab-2">
                    <label for="tab2-2">Data Access</label>
                    <input id="tab2-2" name="tabs-two" type="radio">
                    <div>
                        <br />
                        <h4>Unduh Data</h4>
                        <p>Terdapat dua format data yang dapat diunduh pada list data diantaranya, SHP berisikan informasi
                            dalam bentuk objek dan dapat dibukan/diolah di aplikasi GIS, XLSX berisikan informasi dalam
                            bentuk tabular dan dapat dibukan/diolah dengan aplikasi MS Excel atau aplikasi sejenisnya.</p>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" style="text-align:center;">#</th>
                                        <th scope="col" style="text-align:center;">Data</th>
                                        <th scope="col" style="text-align:center;">Link</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row" style="text-align:center;">1</th>
                                        <td style="text-align:center;">WMS</td>
                                        <td style="text-align:center;"><a
                                                href="http://172.30.102.158:8080/geoserver/kominfo2/wms"
                                                target="_blank">http://172.30.102.158:8080/geoserver/kominfo2/wms</a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="text-align:center;">2</th>
                                        <td style="text-align:center;">WFS</td>
                                        <td style="text-align:center;"><a
                                                href="http://172.30.102.158:8080/geoserver/kominfo2/ows"
                                                target="_blank">http://172.30.102.158:8080/geoserver/kominfo2/ows</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" style="text-align:center;">#</th>
                                        <th scope="col" style="text-align:center;">Data</th>
                                        <th scope="col" colspan="2" style="text-align:center;">Link Unduh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row" style="text-align:center;">1</th>
                                        <td style="text-align:center;">Kawasan Prioritas</td>
                                        <td style="text-align:center;"><a
                                                href="http://172.30.102.158:8080/geoserver/kominfo2/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=kominfo2%3Apodes20_spd_kp_dukcapil_vektor&CQL_FILTER=kp_3t%20IS%20NOT%20NULL&outputFormat=SHAPE-ZIP">SHP</a>
                                        </td>
                                        <td style="text-align:center;"><a href="{{ route('export-kp') }}">XLSX</a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="text-align:center;">2</th>
                                        <td style="text-align:center;">Survey Potensi Desa</td>
                                        <td style="text-align:center;"><a
                                                href="http://172.30.102.158:8080/geoserver/kominfo2/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=kominfo2%3Apodes20_spd_kp_dukcapil_vektor&CQL_FILTER=spd_thn_survey%20IS%20NOT%20NULL&outputFormat=SHAPE-ZIP">SHP</a>
                                        </td>
                                        <td style="text-align:center;"><a href="{{ route('export-spd') }}">XLSX</a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" style="text-align:center;">3</th>
                                        <td style="text-align:center;">Penerima Bantuan</td>
                                        <td style="text-align:center;">-</td>
                                        <td style="text-align:center;"><a href="{{ route('export-pb') }}">XLSX</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
        $('.up3').change(function() {
            if ($('.up3').val() == '') {
                $('.imp3').attr('disabled', true)
            } else {
                $('.imp3').attr('disabled', false);
            }
        })
    </script>
@endsection
