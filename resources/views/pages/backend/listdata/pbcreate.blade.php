@extends('layouts.admin')

@section('addon-style')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />
    <link rel="stylesheet" href="{{ url('assets/leaflet/leaflet-locatecontrol-gh-pages/dist/L.Control.Locate.min.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('assets/leaflet/defaultextent/dist/leaflet.defaultextent.css') }}" />
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

            <div class="d-flex col-md-12 mb-5">
                <div class="col-md-2 text-left" style="padding-left: 4%;">
                    <a class="btn btn-sm btn-primary" href="{{ route('PbTable') }}" style="border-radius: 8px;">
                        <span class="text-white" style="font-size: 13px;">Kembali</span></a>
                </div>
                <div class="col-md-8 text-center">
                    <h4 class="mt-2">PENERIMA BANTUAN PELATIHAN</h4>
                </div>
                <div class="col-md-2 text-center"></div>
                {{-- <a href="#"><small>Show All</small></a> --}}

            </div>
            {{-- action form yang mengarah ke route space.store untuk proses penyimpanan data --}}
            <form action="{{ route('pbStore') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama" id="nama"
                            required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="telepon">Telepon</label>
                        <input type="text" name="telepon" class="form-control" placeholder="Telepon" id="telepon"
                            required>
                        @error('telepon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" id="email">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="telepon">Jenis Usaha</label>
                        <input type="text" name="jenis_usaha" class="form-control" placeholder="Jenis Usaha"
                            id="jenis_usaha" required>
                        @error('jenis_usaha')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="produk">Produk</label>
                        <input type="text" name="produk" class="form-control" placeholder="Produk" id="produk">
                        @error('produk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nama_pic">Nama PIC</label>
                        <input type="text" name="nama_pic" class="form-control" placeholder="Nama PIC" id="nama_pic">
                        @error('nama_pic')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="kontak_pic">Kontak PIC</label>
                        <input type="text" name="kontak_pic" class="form-control" placeholder="Kontak PIC"
                            id="kontak_pic">
                        @error('kontak_pic')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="pengusul">Pengusul</label>
                        <input type="text" name="pengusul" class="form-control" placeholder="Pengusul" id="pengusul">
                        @error('pengusul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" placeholder="Keterangan"
                            id="keterangan">
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="thn_bantuan">Tahun Bantuan</label>
                        <input type="number" name="thn_bantuan" class="form-control" placeholder="Tahun Bantuan"
                            id="thn_bantuan" required>
                        @error('thn_bantuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr>
                <h5 class="text-center">Informasi Lokasi</h5>

                <hr>
                <div class="form-group">
                    <label for="alamat">Alamat Lengkap</label>
                    <textarea name="alamat" id="alamat" class="form-control" placeholder="Alamat Lengkap"></textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="desa">Desa / Kelurahan</label>
                        <input type="text" name="desa" class="form-control" placeholder="Desa / Kelurahan"
                            id="desa" required>
                        @error('desa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="kecamatan">Kecamatan</label>
                        <input type="text" name="kecamatan" class="form-control" placeholder="Kecamatan"
                            id="kecamatan" required>
                        @error('kecamatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="kab_kota">Kabupaten / Kota</label>
                        <input type="text" name="kab_kota" class="form-control" placeholder="Kabupaten / Kota"
                            id="kab_kota" required>
                        @error('kab_kota')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="provinsi">Provinsi</label>
                        <input type="text" name="provinsi" class="form-control" placeholder="Provinsi"
                            id="provinsi" required>
                        @error('provinsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>



                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="longitude">Longitude</label>
                        <input type="text" name="longitude"
                            class="form-control @error('longitude') is-invalid @enderror"
                            placeholder="tambah koordinat atau geser marker peta" id="longitude" required>
                        @error('longitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="latitude">Latitude</label>
                        <input type="text" name="latitude"
                            class="form-control @error('lotitude') is-invalid @enderror"
                            placeholder="tambah koordinat atau geser marker peta" id="latitude" required>
                        @error('latitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div id="map"></div>
                <div class="form-group mt-3 text-center">
                    <button type="submit" class="btn btn-sm bg-primary text-white mb-0 text-center"
                        style=" border-radius: 4px; width: 30%; text-transform: none;">Simpan</span></button>
                    <button type="reset" class="btn btn-sm btn-secondary  mb-0 text-center"
                        style="border-radius: 4px;width: 30%;text-transform: none; border:1px solid #dfe0e1"
                        data-bs-dismiss="modal">Batal</span></button>
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
    <script src="{{ url('assets/leaflet/leaflet-locatecontrol-gh-pages/src/L.Control.Locate.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ url('assets/leaflet/defaultextent/dist/leaflet.defaultextent.js') }}"></script>
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
            zoom: 4,
            layers: [streets]
        });

        // DEFAULT EXTENT
        L.control.defaultExtent().addTo(map);

        lc = L.control.locate({
            strings: {
                title: "Show me where I am, yo!"
            }
        }).addTo(map);

        //     var url2 = 'http://172.30.102.158:8080/geoserver/kominfo2/wms';

        //     var layer_podes20 = L.tileLayer.betterWmsPodes20(url2, {
        //       layers: 'kominfo2:podes20_spd_kp_dukcapil',
        //       format: 'image/png',
        //       transparent: true,
        //       tiled: true,
        //       zIndex: 1000
        //   });

        var baseLayers = {
            //"Grayscale": grayscale,
            "Streets": streets,
            "Satellite": satellite
        };

        // var overlays = {
        //     "Streets": streets,
        //     "Satellite": satellite,
        // };

        L.control.layers(baseLayers).addTo(map);

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

            // $('#location').val(location.lat + "," + location.lng).keyup()
            $('#longitude').val(location.lng).keyup()
            $('#latitude').val(location.lat).keyup()
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
