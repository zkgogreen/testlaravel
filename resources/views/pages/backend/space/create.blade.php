@extends('layouts.admin')

@section('addon-style')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        #map {
            height: 500px;
        }
    </style>
@endsection


{{-- Pada view create.blade space ini kita kan menginput beberapa data yaitu 
nama space (tempat), deskripsi, gambar jika di perlukan, dan titik koordinat lokasi
Untuk cdn yang kita muat disini hampir sama dengan form create pada file view create centrepoint --}}

@section('content')
    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card rounded">
                    <div class="card-header">Tambah Space</div>
                    <div class="card-body"> --}}

    <div class="card col-md-12">
        <!-- <div class="card-block" style="padding: 1%; padding-top: 1.5%;"> -->
        <div class="card-body" style="padding:2%;">

            <div class="d-flex col-md-12">
                <div class="col-md-2 text-left" style="padding-left: 4%;">
                    <a class="btn btn-sm btn-primary" href="{{ route('PbTable') }}" style="border-radius: 8px;">
                        <span class="text-white" style="font-size: 13px;">Kembali</span></a>
                </div>
                <div class="col-md-8 text-center">
                    <h4 class="mt-2">TAMBAH PENERIMA BANTUAN</h4>
                </div>
                <div class="col-md-2 text-center"></div>
                {{-- <a href="#"><small>Show All</small></a> --}}

            </div>
            {{-- action form yang mengarah ke route space.store untuk proses penyimpanan data --}}
            <form action="{{ route('space.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="table-responsive p-3">
                    <table class="table align-items-center mb-0">
                        <tr>
                            <td>
                            <th class="text-uppercase align-middle">Nama</th>
                            <td>: <input type="text" name="nama" class="form-control" placeholder="Name" id="nama"
                                    @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror>
                            </td>
                            </td>
                            <td>
                            <th class="text-uppercase align-middle">Telepon</th>
                            <td>: <input type="text" name="telepon" class="form-control" placeholder="Telepon"
                                    id="telepon"
                                    @error('telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror>
                            </td>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <th class="text-uppercase align-middle">Email</th>
                            <td>: <input type="email" name="email" class="form-control" placeholder="Email" id="email"
                                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror>
                            </td>
                            </td>
                            <td>
                            <th class="text-uppercase align-middle">Jenis Usaha</th>
                            <td>: <input type="text" name="jenis_usaha" class="form-control" placeholder="Jenis Usaha"
                                    id="jenis_usaha"
                                    @error('jenis_usaha') <div class="invalid-feedback">{{ $message }}</div> @enderror>
                            </td>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <th class="text-uppercase align-middle">Produk</th>
                            <td>: <input type="text" name="produk" class="form-control" placeholder="Produk" id="produk"
                                    @error('produk') <div class="invalid-feedback">{{ $message }}</div> @enderror>
                            </td>
                            </td>
                            <td>
                            <th class="text-uppercase align-middle">Nama PIC</th>
                            <td>: <input type="text" name="nama_pic" class="form-control" placeholder="Nama PIC"
                                    id="nama_pic"
                                    @error('nama_pic') <div class="invalid-feedback">{{ $message }}</div> @enderror>
                            </td>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <th class="text-uppercase align-middle">Kontak PIC</th>
                            <td>: <input type="text" name="kontak_pic" class="form-control" placeholder="Kontak PIC"
                                    id="kontak_pic"
                                    @error('kontak_pic') <div class="invalid-feedback">{{ $message }}</div> @enderror>
                            </td>
                            </td>
                            <td>
                            <th class="text-uppercase align-middle">Pengusul</th>
                            <td>: <input type="text" name="pengusul" class="form-control" placeholder="Pengusul"
                                    id="pengusul"
                                    @error('pengusul') <div class="invalid-feedback">{{ $message }}</div> @enderror>
                            </td>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <th class="text-uppercase align-middle">Keterangan</th>
                            <td>: <input type="text" name="keterangan" class="form-control" placeholder="Keterangan"
                                    id="keterangan"
                                    @error('keterangan') <div class="invalid-feedback">{{ $message }}</div> @enderror>
                            </td>
                            </td>
                            <td>
                            <th class="text-uppercase align-middle">Tahun Bantuan</th>
                            <td>: <input type="text" name="thn_bantuan" class="form-control" placeholder="Tahun Bantuan"
                                    id="thn_bantuan"
                                    @error('thn_bantuan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </td>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="8" class="text-center">Informasi Lokasi</th>
                        </tr>
                        <tr>
                            <td>
                            <th class="text-uppercase align-middle">Id Desa</th>
                            <td>: <input type="text" name="id_desa" class="form-control" placeholder="Id Desa"
                                    id="id_desa">
                                @error('id_desa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            </td>
                            <td>
                            <th class="text-uppercase align-middle">Desa / Kelurahan</th>
                            <td>: <input type="text" name="desa" class="form-control" placeholder="Desa / Kelurahan"
                                    id="desa">
                                @error('desa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            </td>

                        </tr>
                        <tr>
                            <td>
                            <th class="text-uppercase align-middle">Kecamatan</th>
                            <td>: <input type="text" name="kecamatan" class="form-control" placeholder="Kecamatan"
                                    id="kecamatan">
                                @error('kecamatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            </td>
                            <td>
                            <th class="text-uppercase align-middle">Kabupaten / Kota</th>
                            <td>: <input type="text" name="kab_kota" class="form-control" placeholder="Kabupaten / Kota"
                                    id="kab_kota">
                                @error('kab_kota')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            </td>

                        </tr>
                        <tr>
                            <td>
                            <th class="text-uppercase align-middle">Provinsi</th>
                            <td>: <input type="text" name="provinsi" class="form-control" placeholder="Provinsi"
                                    id="provinsi">
                                @error('provinsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            </td>
                            <td>
                            <th class="text-uppercase align-middle">Longitude / Latitude</th>
                            <td>:
                                <input type="text" name="location"
                                    class="form-control @error('location') is-invalid @enderror"
                                    placeholder="geser marker peta" readonly id="location">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </td>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="map"></div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@section('addon-script')
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> --}}
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script>
        // fungsi ini akan berjalan ketika akan menambahkan gambar dimana fungsi ini
        // akan membuat preview image sebelum kita simpan gambar tersebut.      
        // function readURL(input) {
        //     if (input.files && input.files[0]) {
        //         var reader = new FileReader();

        //         reader.onload = function(e) {
        //             $('#previewImage').attr('src', e.target.result);
        //         }

        //         reader.readAsDataURL(input.files[0]);
        //     }
        // }

        // Ketika tag input file denghan class image di klik akan menjalankan fungsi di atas
        // $("#image").change(function() {
        //     readURL(this);
        // });

        var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            mbUrl =
            'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';

        var satellite = L.tileLayer(mbUrl, {
                id: 'mapbox/satellite-v9',
                tileSize: 512,
                zoomOffset: -1,
                attribution: mbAttr
            }),
            dark = L.tileLayer(mbUrl, {
                id: 'mapbox/dark-v10',
                tileSize: 512,
                zoomOffset: -1,
                attribution: mbAttr
            }),
            streets = L.tileLayer(mbUrl, {
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                attribution: mbAttr
            });


        var map = L.map('map', {
            // titik koordinat disini kita dapatkan dari tabel centrepoint tepatnya dari field location
            // yang sebelumnya sudah kita tambahkan jadi lokasi map yang akan muncul  sesuai dengan tabel
            // centrepoint
            center: [{{ $centrepoint->location }}],
            zoom: 14,
            layers: [streets]
        });

        var baseLayers = {
            //"Grayscale": grayscale,
            "Streets": streets,
            "Satellite": satellite
        };

        var overlays = {
            "Streets": streets,
            "Satellite": satellite,
        };

        L.control.layers(baseLayers, overlays).addTo(map);

        // Begitu juga dengan curLocation titik koordinatnya dari tabel centrepoint
        // lalu kita masukkan curLocation tersebut ke dalam variabel marker untuk menampilkan marker
        // pada peta.

        var curLocation = [{{ $centrepoint->location }}];
        map.attributionControl.setPrefix(false);

        var marker = new L.marker(curLocation, {
            draggable: 'true',
        });
        map.addLayer(marker);

        marker.on('dragend', function(event) {
            var location = marker.getLatLng();
            marker.setLatLng(location, {
                draggable: 'true',
            }).bindPopup(location).update();

            $('#location').val(location.lat + "," + location.lng).keyup()
        });

        var loc = document.querySelector("[name=location]");
        map.on("click", function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            if (!marker) {
                marker = L.marker(e.latlng).addTo(map);
            } else {
                marker.setLatLng(e.latlng);
            }
            loc.value = lat + "," + lng;
        });
    </script>
@endsection
