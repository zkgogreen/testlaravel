@extends('layouts.admin')

@section('content')
    <div class="card col-md-12">
        <div class="card-block" style="padding: 1%; padding-top: 1.5%;">
            <ul class="nav nav-tabs float-end" id="myTab" role="tablist">
                @if (Auth::user()->roles == 'ADMIN')
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="masterdata-tab" data-bs-toggle="tab" data-bs-target="#masterdatatab"
                        type="button" role="tab" aria-controls="masterdata" aria-selected="true">Master Data
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="inputdata-tab" data-bs-toggle="tab"
                        data-bs-target="#inputdatatab" type="button" role="tab" aria-controls="inputdata"
                        aria-selected="false">Input Data
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="importdata-tab" data-bs-toggle="tab"
                        data-bs-target="#importdatatab" type="button" role="tab" aria-controls="importdata"
                        aria-selected="false">Import Excel
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="layerdata-tab" data-bs-toggle="tab"
                        data-bs-target="#layerdatatab" type="button" role="tab" aria-controls="layerdata"
                        aria-selected="true">Table
                    </button>
                </li>
                @elseif (Auth::user()->roles == 'USER')
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="inputdata-tab" data-bs-toggle="tab"
                        data-bs-target="#inputdatatab" type="button" role="tab" aria-controls="inputdata"
                        aria-selected="false">Input Data
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="importdata-tab" data-bs-toggle="tab"
                        data-bs-target="#importdatatab" type="button" role="tab" aria-controls="importdata"
                        aria-selected="false">Import Excel
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="layerdata-tab" data-bs-toggle="tab"
                        data-bs-target="#layerdatatab" type="button" role="tab" aria-controls="layerdata"
                        aria-selected="true">Table
                    </button>
                </li>
                @else
                @endif
            </ul>

            <div class="tab-content mt-4" id="myTabContent">
                @if (Auth::user()->roles == 'ADMIN')
                <div class="tab-pane fade show active" id="masterdatatab" role="tabpanel"
                aria-labelledby="masterdata-tab">
                <h4>Master Data</h4>
                <p>Pembuatan format table yang dipergunakan untuk input data survey / density</p>

                <select class="form-control form-control-sm jtable w-100 mt-2" name="jenis_db" id="jenis_db">
                    <option value="tbnonselect" selected>Select Table Type</option>
                    <option value="tbspatial">Spatial</option>
                    <option value="tbnonspatial">Non Spatial</option>
                </select>

                <div class="row tbnonselect box2 mt-2">
                </div>

                <div class="row tbspatial box2 mt-2 mb-2">
                <form action="{{ route('createTB') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                              <table class="table table-bordered" id="dynamicAddRemove">
                                      <input type="hidden" name="type_table" class="form-control" value="Spatial" required>
                                      <tr class="table-secondary">
                                        <th class="text-center" colspan="2">Table Name</th>
                                        <th class="text-center" colspan="2">Roles Access</th>
                                        <th class="text-center" colspan="2">Status</th>
                                        {{-- <th class="text-center" colspan="2">Color Palette</th> --}}
                                    </tr>
                                      <tr class="table-secondary">
                                    <td colspan="2">
                                        <input type="text" name="name_table" class="form-control" placeholder="Enter Table Name" required>
                                      </td>
                                    <td colspan="2">
                                        <select class="select2 form-select" name="roles_table" required>
                                            <option value="Private" selected>Private</option>
                                            <option value="Public">Public</option>
                                          </select>
                                    </td>
                                    <td colspan="2">
                                        <select class="select2 form-select" name="status_table" required>
                                            <option value="ActiveAdmin">Active Admin Only</option>
                                            <option value="Active" selected>Active</option>
                                            <option value="Inactive">Inactive</option>
                                          </select>
                                    </td>
                                    {{-- <td colspan="2">
                                        <select class="select2 form-select" name="color_palette" required>
                                            <option value="#" selected>Select Color Palette</option>
                                            @foreach ($color_palette as $item)
                                            <option value="{{$item->title}}">{{$item->title}}</option>
                                            @endforeach
                                          </select>
                                          
                                    </td> --}}
                                </tr>
                        <tr>
                            <th class="text-center">Column Name</th>
                            <th class="text-center">Data Type</th>
                            <th class="text-center">Option</th>
                            <th class="text-center">Form Type</th>
                            <th class="text-center">value List</th>
                            <th class="text-center">Action / Notes</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="addMoreInputFields[0][kolom]" value="provinsi" class="form-control" readonly/>
                            </td>
                            <td>
                                <select class="select2 form-select" name="addMoreInputFields[0][type]">
                              <option value="string" selected>string</option>
                            </select>
                            </td>
                            <td><select class="select2 form-select" name="addMoreInputFields[0][more]">
                                <option value="mandatory" selected>Mandatory</option>
                              </select>
                            </td>
                            <td><select class="select2 form-select" name="addMoreInputFields[0][typeform]">
                                <option value="select" selected>Select</option>
                              </select>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="addMoreInputFields[0][valuelist]" readonly>
                            </td>
                            
                            <td class="text-center">
                                DEFAULT
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="addMoreInputFields[1][kolom]" value="kabkot" class="form-control" readonly/>
                            </td>
                            <td>
                                <select class="select2 form-select" name="addMoreInputFields[1][type]">
                              <option value="string" selected>string</option>
                            </select>
                            </td>
                            <td><select class="select2 form-select" name="addMoreInputFields[1][more]">
                                <option value="mandatory" selected>Mandatory</option>
                              </select>
                            </td>
                            <td><select class="select2 form-select" name="addMoreInputFields[1][typeform]">
                                <option value="select" selected>Select</option>
                              </select>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="addMoreInputFields[1][valuelist]" readonly>
                            </td>
                            <td class="text-center">
                                DEFAULT
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="addMoreInputFields[2][kolom]" value="kecamatan" class="form-control" readonly/>
                            </td>
                            <td>
                                <select class="select2 form-select" name="addMoreInputFields[2][type]">
                              <option value="string" selected>string</option>
                            </select>
                            </td>
                            <td><select class="select2 form-select" name="addMoreInputFields[2][more]">
                                <option value="mandatory" selected>Mandatory</option>
                              </select>
                            </td>
                            <td><select class="select2 form-select" name="addMoreInputFields[2][typeform]">
                                <option value="select" selected>Select</option>
                              </select>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="addMoreInputFields[2][valuelist]" readonly>
                            </td>
                            <td class="text-center">
                                DEFAULT
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="addMoreInputFields[3][kolom]" value="keldes" class="form-control" readonly/>
                            </td>
                            <td>
                                <select class="select2 form-select" name="addMoreInputFields[3][type]">
                              <option value="string" selected>string</option>
                            </select>
                            </td>
                            <td><select class="select2 form-select" name="addMoreInputFields[3][more]">
                                <option value="mandatory" selected>Mandatory</option>
                              </select>
                            </td>
                            <td><select class="select2 form-select" name="addMoreInputFields[3][typeform]">
                                <option value="select" selected>Select</option>
                              </select>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="addMoreInputFields[3][valuelist]" readonly>
                            </td>
                            <td class="text-center">
                                DEFAULT
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="addMoreInputFields[4][kolom]" value="longitude" class="form-control" readonly/>
                            </td>
                            <td>
                                <select class="select2 form-select" name="addMoreInputFields[4][type]">
                              <option value="decimal" selected>decimal</option>
                            </select>
                            </td>
                            <td><select class="select2 form-select" name="addMoreInputFields[4][more]">
                                <option value="mandatory" selected>Mandatory</option>
                              </select>
                            </td>
                            <td><select class="select2 form-select" name="addMoreInputFields[4][typeform]">
                                <option value="input" selected>Input</option>
                              </select>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="addMoreInputFields[4][valuelist]" readonly>
                            </td>
                            <td class="text-center">
                                DEFAULT
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="addMoreInputFields[5][kolom]" value="latitude" class="form-control" readonly/>
                            </td>
                            <td>
                                <select class="select2 form-select" name="addMoreInputFields[5][type]">
                              <option value="decimal" selected>decimal</option>
                            </select>
                            </td>
                            <td><select class="select2 form-select" name="addMoreInputFields[5][more]">
                                <option value="mandatory" selected>Mandatory</option>
                              </select>
                            </td>
                            <td><select class="select2 form-select" name="addMoreInputFields[5][typeform]">
                                <option value="input" selected>Input</option>
                              </select>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="addMoreInputFields[5][valuelist]" readonly>
                            </td>
                            <td class="text-center">
                                DEFAULT | <button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add</button>
                            </td>
                        </tr>
                    </table>
                    <button type="reset" class="btn btn-outline-dark btn-sm float-end mt-2">Reset</button><button type="submit" class="btn btn-primary btn-sm float-end mt-2 mx-2">Save</button><button type="button" class="btn btn-secondary btn-sm float-start mt-2" data-bs-toggle="modal" data-bs-target="#help">Help</button>
                              </form>
                </div>
                <div class="row tbnonspatial box2 mt-2 mb-2">
                    <form action="{{ route('createTB') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                                  <table class="table table-bordered" id="dynamicAddRemove2">
                                    <input type="hidden" name="type_table" class="form-control" value="Non Spatial" required>
                                    <tr class="table-secondary">
                                        <th class="text-center" colspan="2">Table Name</th>
                                        <th class="text-center" colspan="2">Roles Access</th>
                                        <th class="text-center" colspan="2">Status</th>
                                        {{-- <th class="text-center" colspan="2">Color Palette</th> --}}
                                    </tr>
                                      <tr class="table-secondary">
                                    <td colspan="2">
                                        <input type="text" name="name_table" class="form-control" placeholder="Enter Table Name" required>
                                      </td>
                                    <td colspan="2">
                                        <select class="select2 form-select" name="roles_table" required>
                                            <option value="Private" selected>Private</option>
                                            <option value="Public">Public</option>
                                          </select>
                                    </td>
                                    <td colspan="2">
                                        <select class="select2 form-select" name="status_table" required>
                                            <option value="ActiveAdmin">Active Admin Only</option>
                                            <option value="Active" selected>Active</option>
                                            <option value="Inactive">Inactive</option>
                                          </select>
                                    </td>
                                    {{-- <td colspan="2">
                                        <select class="select2 form-select" name="color_palette" required>
                                            <option value="#" selected>Select Color Palette</option>
                                            @foreach ($color_palette as $item)
                                            <option value="{{$item->title}}">{{$item->title}}</option>
                                            @endforeach
                                          </select>
                                    </td> --}}
                                </tr>
                            <tr>
                                <th class="text-center">Column Name</th>
                                <th class="text-center">Data Type</th>
                                <th class="text-center">Option</th>
                                <th class="text-center">Form Type</th>
                                <th class="text-center">value List</th>
                                <th class="text-center">Action / Notes</th>

                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="addMoreInputFields[0][kolom]" value="provinsi" class="form-control" readonly/>
                                </td>
                                <td>
                                    <select class="select2 form-select" name="addMoreInputFields[0][type]">
                                  <option value="string" selected>string</option>
                                </select>
                                </td>
                                <td><select class="select2 form-select" name="addMoreInputFields[0][more]">
                                    <option value="mandatory" selected>Mandatory</option>
                                  </select>
                                </td>
                                <td><select class="select2 form-select" name="addMoreInputFields[0][typeform]">
                                    <option value="select" selected>Select</option>
                                  </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="addMoreInputFields[0][valuelist]" readonly>
                                </td>
                                
                                <td class="text-center">
                                    DEFAULT
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="addMoreInputFields[1][kolom]" value="kabkot" class="form-control" readonly/>
                                </td>
                                <td>
                                    <select class="select2 form-select" name="addMoreInputFields[1][type]">
                                  <option value="string" selected>string</option>
                                </select>
                                </td>
                                <td><select class="select2 form-select" name="addMoreInputFields[1][more]">
                                    <option value="mandatory" selected>Mandatory</option>
                                  </select>
                                </td>
                                <td><select class="select2 form-select" name="addMoreInputFields[1][typeform]">
                                    <option value="select" selected>Select</option>
                                  </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="addMoreInputFields[1][valuelist]" readonly>
                                </td>
                                <td class="text-center">
                                    DEFAULT
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="addMoreInputFields[2][kolom]" value="kecamatan" class="form-control" readonly/>
                                </td>
                                <td>
                                    <select class="select2 form-select" name="addMoreInputFields[2][type]">
                                  <option value="string" selected>string</option>
                                </select>
                                </td>
                                <td><select class="select2 form-select" name="addMoreInputFields[2][more]">
                                    <option value="mandatory" selected>Mandatory</option>
                                  </select>
                                </td>
                                <td><select class="select2 form-select" name="addMoreInputFields[2][typeform]">
                                    <option value="select" selected>select</option>
                                  </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="addMoreInputFields[2][valuelist]" readonly>
                                </td>
                                <td class="text-center">
                                    DEFAULT
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="addMoreInputFields[3][kolom]" value="keldes" class="form-control" readonly/>
                                </td>
                                <td>
                                    <select class="select2 form-select" name="addMoreInputFields[3][type]">
                                  <option value="string" selected>string</option>
                                </select>
                                </td>
                                <td><select class="select2 form-select" name="addMoreInputFields[3][more]">
                                    <option value="mandatory" selected>Mandatory</option>
                                  </select>
                                </td>
                                <td><select class="select2 form-select" name="addMoreInputFields[3][typeform]">
                                    <option value="select" selected>Select</option>
                                  </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="addMoreInputFields[3][valuelist]" readonly>
                                </td>
                                <td class="text-center">
                                    DEFAULT | <button type="button" name="add" id="dynamic-ar2" class="btn btn-outline-primary">Add</button>
                                </td>
                            </tr>
                        </table>
                        <button type="reset" class="btn btn-outline-dark btn-sm float-end mt-2">Reset</button><button type="submit" class="btn btn-primary btn-sm float-end mt-2 mx-2">Save</button><button type="button" class="btn btn-secondary btn-sm float-start mt-2"  data-bs-toggle="modal" data-bs-target="#help">Help</button>
                                  </form>
                </div>
                             <div class="row p-3">
                                <div id="tabel-dataset"></div>
                             </div>
                </div>
                <div class="tab-pane fade" id="inputdatatab" role="tabpanel" aria-labelledby="inputdata-tab">
                    <h4>Layer</h4>
                    <p>Pilih layer untuk memunculkan form tambah data :</p>
                    <select class="form-control form-control-sm w-100 mt-2" name="jenis_data" id="jenis_data">
                        <option value="#" selected>Select Master Data</option>
                        @foreach ($spatial_layer as $item)
                        <option value="{{$item->title}}">{{$item->name}}</option>  
                        @endforeach
                        <option value="tb_poi">Point Of Interest</option>  
                        <option value="tb_spd">Survey Potensi Desa</option>
                        <option value="tb_kp">Kawasan prioritas</option>
                        <option value="tb_penerima_bantuan">Penerima Bantuan</option>
                    </select> 

                    <div class="row mb-2 mt-2">
                <form action="{{route('addNewRow')}}" method="post" id="formtbSelect" enctype="multipart/form-data">
                    @csrf
                    <div class="row showFm" id="admlist">
                    <div class="col-md-6"><div><label for="exampleFormControlInput1" class="form-label">provinsi :</label><select class="form-control mb-2" name="provinsi" id="provinsi"><option value="#" selected>Select Provinsi</option></select></div></div>
                    <div class="col-md-6"><div><label for="exampleFormControlInput1" class="form-label">kabkot :</label><select class="form-control mb-2" name="kabkot" id="kabkot"><option value="#" selected>Select Kabkot</option></select></div></div>
                    <div class="col-md-6"><div><label for="exampleFormControlInput1" class="form-label">kecamatan :</label><select class="form-control mb-2" name="kecamatan" id="kecamatan"><option value="#" selected>Select Kecamatan</option></select></div></div>
                    <div class="col-md-6"><div><label for="exampleFormControlInput1" class="form-label">kelurahan / Desa :</label><select class="form-control mb-2" name="keldes" id="keldes"><option value="#" selected>Select Kelurahan / Desa</option></select></div></div>
                </div>
                    <div id="tabelForm">
                    </div>
                </form>

                     </div>  
                     <div class="row mb-2">
                        <div id="peta"></div>
                     </div>
                </div>
                <div class="tab-pane fade" id="importdatatab" role="tabpanel" aria-labelledby="importdata-tab">
                    <div class="row p-3">
                        <h4>Import Excel</h4>
                        <p>Fitur tambah data dalam jumlah banyak dengan menggunakan file excel :</p>
                        <ol type='1'>
                            <li>Pastikan format data yang akan di Import sudah sesuai dengan aturan import data :</li>
                            <ul>
                                <li style="list-style-type: circle;">Gunakan format kolom excel yang bisa di unduh di dalam menu Table, dengan cara tampilkan tabel kemudia klik tombol Export pada tabel yang muncul</li>
                                <li style="list-style-type: circle;">Pastikan hapus kolom "id" di file excel hasil export dari menu Table</li>
                                <li style="list-style-type: circle;">Kolom dasar seperti <i>ID Desa, Desa/Kelurahan, Kecamatan,
                                        Kabupaten/kota, Provinsi, Longitude, Latitude</i> <strong>harus diisi</strong>.</li>
                                        <li style="list-style-type: circle;">Khusus Kolom <i>koordinat Longitude & Latitude</i>
                                            harus di isi dengan derajat desimal, gunakan tanda strip '-' pada nilai derajat minus /
                                            berada pada posisi lintang selatan,</li>
                                        <li style="list-style-type: circle;">Gunakan tanah titik '.' di antara pemisah nilai derajat
                                            ke desimal (contoh : <strong>-6.951807, 107.657874</strong>).</li>
                                            <li style="list-style-type: circle;">Jika terdapat kolom berisikan date (tanggal) pada file excel, buat 2 kolom baru di samping kolom asal. Kemudian tulisakan rumus <strong>=text(kolom_asal;"yyyy-mm-dd")</strong> pada kolom baru, lalu copy value dari kolom baru ke dalam kolom hasil (hapus kolom asal dan kolom baru jika sudah selesai)</li>
                                            <li style="list-style-type: circle;"><strong>Untuk lebih jelas, ikuti panduan detail pada User Guide masing-masing hak akses.</strong></li>
                            </ul>
                            <li>File Excel harus berektensi <strong>.xlsx</strong> (excel 2007), jika ektensi <strong>.xls</strong> lakukan save as menjadi format <strong>.xlsx</strong></li>
                        </ol>
                        <select class="form-control form-control-sm w-100 mt-2" name="table_import" id="table_import">
                            <option value="noselect" selected>Select Table Import</option>
                            @foreach ($spatial_layer as $item)
                            <option value="{{$item->title}}">{{$item->name}}</option>  
                            @endforeach
                            <option value="tb_poi">Point Of Interest</option>  
                            <option value="tb_spd">Survey Potensi Desa</option>
                            <option value="tb_kp">Kawasan prioritas</option>
                            <option value="tb_penerima_bantuan">Penerima Bantuan</option>
                        </select> 
                        <div id="FormImportExcel"></div>
    
                     </div>
                    </div>
                    <div class="tab-pane fade" id="layerdatatab" role="tabpanel" aria-labelledby="layerdata-tab">
                        <div class="row p-3">
                            <h4>Table</h4>
                            <p>Struktur Tabel yang muncul di halaman ini terintegrasi untuk di pergunakan sebagai format Import Excel sesuai dengan nama tabel yang di pilih. Pilih list tabel untuk memunculkan tabel, dan klik menu export untuk mengunduh file excel.
                                <strong>(pastikan hapus kolom "id" di file excel hasil export bilamana format excel akan dipergunakan sebagai import)</strong></p>
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
                @elseif (Auth::user()->roles == 'USER')
                <div class="tab-pane fade show active" id="inputdatatab" role="tabpanel" aria-labelledby="inputdata-tab">
                    <h4>Layer</h4>
                    <p>Pilih layer untuk memunculkan form tambah data :</p>
                    <select class="form-control form-control-sm w-100 mt-2" name="jenis_data" id="jenis_data">
                        <option value="#" selected>Select Master Data</option>
                        @foreach ($spatial_layer as $item)
                        <option value="{{$item->title}}">{{$item->name}}</option>  
                        @endforeach
                        <option value="tb_poi">Point Of Interest</option>  
                        <option value="tb_spd">Survey Potensi Desa</option>
                        <option value="tb_kp">Kawasan prioritas</option>
                        <option value="tb_penerima_bantuan">Penerima Bantuan</option>
                    </select> 

                    {{-- <div class="row mb-2 mt-2">
                        <div id="kolomList">
                            <div id="kList"></div>
                        </div>
                    </div>
                    <div class="row mb-2 mt-2">
                        <div id="tabelForm">
                        </div>
                     </div>  
                     <div class="row mb-2">
                        <div id="peta"></div>
                     </div> --}}

                     <div class="row mb-2 mt-2">
                        <form action="{{route('addNewRow')}}" method="post" id="formtbSelect" enctype="multipart/form-data">
                            @csrf
                            <div class="row showFm" id="admlist">
                            <div class="col-md-6"><div><label for="exampleFormControlInput1" class="form-label">provinsi :</label><select class="form-control mb-2" name="provinsi" id="provinsi"><option value="#" selected>Select Provinsi</option></select></div></div>
                            <div class="col-md-6"><div><label for="exampleFormControlInput1" class="form-label">kabkot :</label><select class="form-control mb-2" name="kabkot" id="kabkot"><option value="#" selected>Select Kabkot</option></select></div></div>
                            <div class="col-md-6"><div><label for="exampleFormControlInput1" class="form-label">kecamatan :</label><select class="form-control mb-2" name="kecamatan" id="kecamatan"><option value="#" selected>Select Kecamatan</option></select></div></div>
                            <div class="col-md-6"><div><label for="exampleFormControlInput1" class="form-label">kelurahan / Desa :</label><select class="form-control mb-2" name="keldes" id="keldes"><option value="#" selected>Select Kelurahan / Desa</option></select></div></div>
                        </div>
                            <div id="tabelForm">
                            </div>
                        </form>
        
                             </div>  
                             <div class="row mb-2">
                                <div id="peta"></div>
                             </div>
                </div>

                <div class="tab-pane fade" id="importdatatab" role="tabpanel" aria-labelledby="importdata-tab">
                    <div class="row p-3">
                        <h4>Import Excel</h4>
                        <p>Fitur tambah data dalam jumlah banyak dengan menggunakan file excel :</p>
                        <ol type='1'>
                            <li>Pastikan format data yang akan di Import sudah sesuai dengan aturan import data :</li>
                            <ul>
                                <li style="list-style-type: circle;">Gunakan format kolom excel yang bisa di unduh di dalam menu Table, dengan cara tampilkan tabel kemudia klik tombol Export pada tabel yang muncul</li>
                                <li style="list-style-type: circle;">Pastikan hapus kolom "id" di file excel hasil export dari menu Table</li>
                                <li style="list-style-type: circle;">Kolom dasar seperti <i>ID Desa, Desa/Kelurahan, Kecamatan,
                                        Kabupaten/kota, Provinsi, Longitude, Latitude</i> <strong>harus diisi</strong>.</li>
                                        <li style="list-style-type: circle;">Khusus Kolom <i>koordinat Longitude & Latitude</i>
                                            harus di isi dengan derajat desimal, gunakan tanda strip '-' pada nilai derajat minus /
                                            berada pada posisi lintang selatan,</li>
                                        <li style="list-style-type: circle;">Gunakan tanah titik '.' di antara pemisah nilai derajat
                                            ke desimal (contoh : <strong>-6.951807, 107.657874</strong>).</li>
                                            <li style="list-style-type: circle;">Jika terdapat kolom berisikan date (tanggal) pada file excel, buat 2 kolom baru di samping kolom asal. Kemudian tulisakan rumus <strong>=text(kolom_asal;"yyyy-mm-dd")</strong> pada kolom baru, lalu copy value dari kolom baru ke dalam kolom hasil (hapus kolom asal dan kolom baru jika sudah selesai)</li>
                                            <li style="list-style-type: circle;"><strong>Untuk lebih jelas, ikuti panduan detail pada User Guide masing-masing hak akses.</strong></li>
                            </ul>
                            <li>File Excel harus berektensi <strong>.xlsx</strong> (excel 2007), jika ektensi <strong>.xls</strong> lakukan save as menjadi format <strong>.xlsx</strong></li>
                        </ol>
                        <select class="form-control form-control-sm w-100 mt-2" name="table_import" id="table_import">
                            <option value="noselect" selected>Select Table Import</option>
                            @foreach ($spatial_layer as $item)
                            <option value="{{$item->title}}">{{$item->name}}</option>  
                            @endforeach
                            <option value="tb_poi">Point Of Interest</option>  
                            <option value="tb_spd">Survey Potensi Desa</option>
                            <option value="tb_kp">Kawasan prioritas</option>
                            <option value="tb_penerima_bantuan">Penerima Bantuan</option>
                        </select> 
                        <div id="FormImportExcel"></div>
    
                     </div>
                    </div>
                    <div class="tab-pane fade" id="layerdatatab" role="tabpanel" aria-labelledby="layerdata-tab">
                <div class="row p-3">
                    <h4>Table</h4>
                    <p>Struktur Tabel yang muncul di halaman ini terintegrasi untuk di pergunakan sebagai format Import Excel sesuai dengan nama tabel yang di pilih. Pilih list tabel untuk memunculkan tabel, dan klik menu export untuk mengunduh file excel.
                        <strong>(pastikan hapus kolom "id" di file excel hasil export bilamana format excel akan dipergunakan sebagai import)</strong></p>
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
                    @else
                    @endif
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
                                {{-- <button type="button" class="btn btn-sm bg-gray-custom text-white mb-0 text-center" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-sm bg-danger text-white mb-0 text-center">Unduh</button> --}}
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

    <div class="modal fade" id="help" role="dialog" style="margin-top: 7%;
    padding-right: 0;">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Rules Create Master Data</h5>
          </div>
          <div class="modal-body" style='padding:15px; height: 400px;
          overflow-y: auto;'>
            {{-- <div class="table-responsive"> --}}
            <table class="table table-bordered">
                <tr>
                    <th>Form</th>
                    <th>Notes</th>
                    <th>Description</th>
                </tr>
                <tr>
                    <th>Table Name</th>
                    <td>Nama tabel master</td>
                    <td style="word-wrap: break-word;">Penulisan harus kecil semua dan tidak boleh ada spasial, untuk memisahkan kata gunakan tanda underscore "_", contoh : <strong>data_contoh</strong></td>
                </tr>
                <tr>
                    <th>Roles Access</th>
                    <td>Hak akses data</td>
                    <td style="word-wrap: break-word;">Pilihan "private" hanya jika akses informasi tersedia untuk internal kominfo saja dalam bentuk map density dan map marker, pilihan "public" untuk data dapat di akses di halaman depan sistem, dengan tampilan berupa map density. </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>Status Tabel</td>
                    <td style="word-wrap: break-word;">Terdapat 3 active, active in admin, inactive</td>
                </tr>
                <tr>
                    <th>Column Name</th>
                    <td>Nama kolom tabel</td>
                    <td style="word-wrap: break-word;">Penulisan harus kecil semua dan tidak boleh ada spasial, untuk memisahkan kata gunakan tanda underscore "_", contoh : <strong>data_contoh</strong></td>
                </tr>
                <tr>
                    <th>Data Type</th>
                    <td>Type data kolom</td>
                    <td>
<table class="table  table-striped">
    <tr>
        <th>Date</th>
        <td style="word-wrap: break-word;">Untuk kolom dengan tipe data berisikan tanggal, format penulisan YYYY-MM-DD </td>
    </tr>
    <tr>
        <th>DateTime</th>
        <td style="word-wrap: break-word;">Untuk kolom dengan tipe data berupa tanggal dan waktu, format penulisan YYYY-MM-DD HH:MM:SS</td>
    </tr>
    <tr>
        <th>Decimal</th>
        <td style="word-wrap: break-word;">Untuk kolom dengan tipe data berupa angka desimal</td>
    </tr>
    <tr>
        <th>Integer</th>
        <td style="word-wrap: break-word;">Untuk kolom dengan tipe data berupa bilangan bulat negatif ataupun positif dengan range -2147483648 hingga +2147483647</td>
    </tr>
    <tr>
        <th>String</th>
        <td style="word-wrap: break-word;">Untuk kolom berisikan karakter, spesial karakter, number dan spasi dengan maksimal panjang karakter 255</td>
    </tr>
    <tr>
        <th>Text</th>
        <td style="word-wrap: break-word;">Untuk kolom berisikan karakter, spesial karakter, number dan spasi dengan panjang karakter tidak terbatas</td>
    </tr>
</table>
    </td>
      </tr>
      <tr>
        <th>Option</th>
        <td>Option kolom</td>
        <td>
            <table class="table table-striped">
                <tr>
                    <th>Mandatory</th>
                    <td style="word-wrap: break-word;">Mewajibkan kolom harus di isi saat input data</td>
                </tr> 
                <tr>
                    <th>Unique</th>
                    <td style="word-wrap: break-word;">Mewajibkan kolom berisikan data unik berbeda dari data lainnya, umumnya berupa id</td>
                </tr> 
                <tr>
                    <th>Null</th>
                    <td style="word-wrap: break-word;">Mengijinkan kolom untuk di biarkan kosong saat input data</td>
                </tr> 
            </table>
        </td>
    </tr>
    <tr>
        <th>Form Type</th>
        <td>Jenis tampilan isian kolom</td>
        <td>
            <table class="table table-striped">
                <tr>
                    <th>Select</th>
                    <td style="word-wrap: break-word;">Form Berisikan pilihan data yang sudah ditentukan sebelumnya (saat memilih ini, wajib mengisi pada form <strong>Value List</strong>, kecuali untuk Data Type 'date' dengan Form Type 'Select', bagian ini bisa di kosongkan)</td>
                </tr> 
                <tr>
                    <th>Input</th>
                    <td style="word-wrap: break-word;">Form kosong yang bisa di isi sesuai dengan <strong>Data Type</strong></td>
                </tr> 
                <tr>
                    <th>File</th>
                    <td style="word-wrap: break-word;">Form input untuk data berupa file (pdf, doc, png, jpg), <i>Untuk Form Type ini pastikan kolom di beri nama <strong>lampiran</strong> dan menggunakan <strong>Text</strong> pada pilihan Data Type</i></td>
                </tr> 
            </table>
        </td>
    </tr>
    <tr>
        <th>Value List</th>
        <td>Pilihan Isian Default</td>
        <td style="word-wrap: break-word;">Form ini hanya di isi jika pilihan Form Type adalah <strong>Select</strong>, dengan format penulisan dipisah dengan tanda koma "," antar pilihan. Contoh penulisan pilihan Jenis Kelamin : <strong>Laki-laki, Perempuan, Lainnya</strong></td>
    </tr>
    <tr>
        <th>Action / Notes</th>
        <td>Tombol add atau delete</td>
        <td style="word-wrap: break-word;">Jika akan menambahkan kolom baru tekan tombol <strong>ADD</strong>, dan jika ingin menghapus kolom tekan tombol <strong>DELETE</strong></td>
    </tr>
            </table>
            {{-- </div> --}}
        </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
    </div>



    <div class="modal fade" id="help2" role="dialog" style="margin-top: 7%;
    padding-right: 0;">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Rules Input Data</h5>
          </div>
          <div class="modal-body" style='padding:15px; height: 300px;
          overflow-y: auto;'>
            {{-- <div class="table-responsive"> --}}
            <table class="table table-bordered">
                <tr>
                    <th>Form</th>
                    <th>Form Type</th>
                    <th style="word-wrap: break-word;">Description</th>
                </tr>
                <tr>
                    <th>Provinsi</th>
                    <td>Select</td>
                    <td style="word-wrap: break-word;">Pilih nama Provinsi sesuai dengan list yang muncul.</td>
                </tr>
                <tr>
                    <th>Kabkot</th>
                    <td>Select</td>
                    <td style="word-wrap: break-word;">Pilih nama Kabupaten / Kota sesuai dengan list yang muncul berdasarkan pilihan Provinsi</td>
                </tr>
                <tr>
                    <th>Kecamatan</th>
                    <td>Select</td>
                    <td style="word-wrap: break-word;">Pilih nama Kecamatan sesuai dengan list yang muncul berdarkan pilihan Kabupaten / Kota</td>
                </tr>
                <tr>
                    <th>Keldes</th>
                    <td>Select</td>
                    <td style="word-wrap: break-word;">Pilih nama Kelurahan / Desa sesuai dengan list yang muncul berdasarkan pilihan Kecamatan</td>
                </tr>
    <tr>
        <th>Longitude / Latitude</th>
        <td>Input / Set Map</td>
        <td style="word-wrap: break-word;">Jika value di isi manual maka harus di isi dengan derajat desimal, gunakan tanda strip '-' pada nilai derajat minus /
        berada pada posisi lintang selatan,dan gunakan tanah titik '.' di antara pemisah nilai derajat ke desimal (contoh : <strong>-6.951807, 107.657874</strong>), atau untuk mengisi secara otomatis gunakan cara dengan menempakan marker pada jendela peta ke lokasi yang di maksud.</td>
    </tr>
            </table>
            {{-- </div> --}}
        </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
    </div>
    @endsection



    @section('addon-script')
    <script type="text/javascript">
    var a = 6;
    $("#dynamic-ar").click(function () {
        ++a;
        $("#dynamicAddRemove").append('<tr><td><input type="text" name="addMoreInputFields[' + a +
            '][kolom]" placeholder="Enter Column" class="form-control" required/></td><td><select class="select2 form-select" name="addMoreInputFields[' + a +'][type]"><option value="date">date</option><option value="dateTime">dateTime</option><option value="decimal">decimal</option><option value="integer">integer</option><option value="string">string</option><option value="text">text</option></select></td><td><select class="select2 form-select" name="addMoreInputFields[' + a +'][more]"><option value="mandatory">Mandatory</option><option value="unique">Unique</option><option value="nullable">Null</option></select></td><td><select class="select2 form-select" name="addMoreInputFields[' + a +'][typeform]"><option value="select">Select</option><option value="input" selected>Input</option><option value="file">File</option></select></td><td><input type="text" class="form-control" name="addMoreInputFields[' + a +'][valuelist]"></td><td class="text-center"><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>');
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
    var b = 4;
    $("#dynamic-ar2").click(function () {
        ++b;
        $("#dynamicAddRemove2").append('<tr><td><input type="text" name="addMoreInputFields[' + b +
            '][kolom]" placeholder="Enter Column" class="form-control" required/></td><td><select class="select2 form-select" name="addMoreInputFields[' + b +'][type]"><option value="date">date</option><option value="dateTime">dateTime</option><option value="decimal">decimal</option><option value="integer">integer</option><option value="string">string</option><option value="text">text</option></select></td><td><select class="select2 form-select" name="addMoreInputFields[' + b +'][more]"><option value="mandatory">Mandatory</option><option value="unique">Unique</option><option value="nullable">Null</option></select></td><td><select class="select2 form-select" name="addMoreInputFields[' + b +'][typeform]"><option value="select">Select</option><option value="input" selected>Input</option><option value="file">File</option></select></td><td><input type="text" class="form-control" name="addMoreInputFields[' + b +'][valuelist]"></td><td class="text-center"><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>');
    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
</script>

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
        var menu_jdata = document.getElementById("jenis_data");
        var menu_tdata = document.getElementById("table_data");
        var menu_import = document.getElementById("table_import");

        menu_import.addEventListener("change", generateData);
        menu_jdata.addEventListener("change", generateData);
        menu_tdata.addEventListener("change", generateData);

        function generateData(event) {
            ShowTabelAll(menu_tdata.value, 'tblayer');
            ShowFormTabel(menu_jdata.value, 'tabelForm');
            ShowFormImport(menu_import.value);
        }


$(document).ready(function () {
    $('#jenis_data').on('change', function () {
        var jData = $(this).val();
        if (jData == 'noselect') {
            $("#admlist").addClass("showFm");
        } else {
            $("#admlist").removeClass("showFm");
        }
    });
});




function updateRequiredAttribute() {
    // Get all input elements
    var inputs = document.getElementsByTagName("input");
    var textareas = document.getElementsByTagName("textarea");
    var selects = document.getElementsByTagName("select");


    // Loop through each input element
    for (var i = 0; i < inputs.length; i++) {
        var input = inputs[i];
        
        // Check if the input element has the 'YES' attribute
        if (input.getAttribute("YES") !== null) {
            // If 'YES' attribute is present, set 'required' attribute to 'false'
            input.setAttribute("required", "false");
        } else if (input.getAttribute("NO") !== null) {
            // If 'NO' attribute is present, set 'required' attribute to 'true'
            input.setAttribute("required", "true");
        }
    }

        // Loop through each input element
        for (var i = 0; i < textareas.length; i++) {
        var textarea = textareas[i];
        
        // Check if the input element has the 'YES' attribute
        if (textarea.getAttribute("YES") !== null) {
            // If 'YES' attribute is present, set 'required' attribute to 'false'
            textarea.setAttribute("required", "false");
        } else if (textarea.getAttribute("NO") !== null) {
            // If 'NO' attribute is present, set 'required' attribute to 'true'
            textarea.setAttribute("required", "true");
        }
    }

           // Loop through each input element
           for (var i = 0; i < selects.length; i++) {
        var select = selects[i];
        
        // Check if the input element has the 'YES' attribute
        if (select.getAttribute("YES") !== null) {
            // If 'YES' attribute is present, set 'required' attribute to 'false'
            select.setAttribute("required", "false");
        } else if (select.getAttribute("NO") !== null) {
            // If 'NO' attribute is present, set 'required' attribute to 'true'
            select.setAttribute("required", "true");
        }
    }
}


function showListSelect(nmTabel, nmField) {
    $.ajax({
        url: base_url + '/valueList/' + nmTabel + '/' + nmField,
        type: "get",
        data: {
            tabel: nmTabel,
            kolom: nmField,
        },
        success: function(data) {
            if (data) {
                $('#' + nmField).empty();
                $('#' + nmField).append('<option value="#" selected>Select</option>');
                $.each(data, function(key, value) {
                    list = value.value_list.split(",");
                    for (var i = 0; i < list.length; i++) {
                        $('select[name="'+ nmField +'"]').append('<option value="' + list[i] + '">' + list[i] + '</option>');
                    }
                });
            } else {
                $('#' + nmField).empty();
            }
        }
    });
}


function showMap(nmTabel) {
    var mapshow = document.getElementById("peta");
  $.ajax({
    url: base_url + '/TabelSpasial/' + nmTabel,
    type: "get",
    data: {
      tabel: nmTabel,
    },
    success: function (data) {
      if (data) {
        mapshow.style.display = "none";
        $.each(data, function (key, value) {
            mapshow.style.display = "block";
            resizeMap();
              });
            } else {
            mapshow.style.display = "none";
            }
    }
  });
}


function ShowFormImport(nmTabel) {
    if (nmTabel == "noselect") {
             $('#FormImportExcel').empty(); // Clear the content before appending new elements 
    } else {
        $('#FormImportExcel').empty(); // Clear the content before appending new elements
        $('#FormImportExcel').append('<p class="mt-2 mb-2"><strong>Import '+ nmTabel +',</strong> Proses import bisa memakan waktu beberapa menit tergantung besaran file dan spesifikasi komputer server dan sambungan internet yang tersedia. (Jika proses import memakan waktu terlalu lama, disarankan untuk membagi ukuran file menjadi beberapa file dengan ukuran yang lebih kecil).</p>');
        $('#FormImportExcel').append('<form action="{{ route('ImportData')}}" class="mt-3" method="post" id="formImport" enctype="multipart/form-data">@csrf</form>');
        $('#formImport').append('<div class="form-group importForm"></div>');
        $('.importForm').append('<input type="hidden" name="table" value="'+ nmTabel +'"class="form-control">');
        $('.importForm').append('<div class="input-group grup-form"></div>');
        $('.grup-form').append('<input type="file" name="file" class="form-control up3" aria-label="Upload">');
        $('.grup-form').append('<button type="submit" class="btn btn-primary mx-2 imp3">Import</button><button type="reset" class="btn btn-outline-dark imp3">Reset</button>');
    }
}


function ShowFormTabel(nmTabel, idhtml) {
  $.ajax({
    url: base_url + '/TabelField/' + nmTabel,
    type: "get",
    data: {
      tabel: nmTabel,
    },
    success: function (data) {
      if (data) {
        $('#' + idhtml).empty(); // Clear the content before appending new elements
        // $('#' + idhtml).append('<form action="{{route('addNewRow')}}" method="post" id="formtbSelect" enctype="multipart/form-data">@csrf</form>');
        // $('#formtbSelect').append('<input type="hidden" class="form-control mb-2" name="tabel" id="tabel" value="' + nmTabel + '">');
        $('#' + idhtml).append('<div class="row formtb"></div>');
        $('.formtb').append('<input type="hidden" class="form-control mb-2" name="tabel" id="tabel" value="' + nmTabel + '">');
        $.each(data, function (key, value) {
          // Separate the conditions for data_type and form_type
          switch (value.data_type) {
            case "character varying":
              switch (value.form_type) {
                case "select":
                  $('.formtb').append('<div class="col-md-6"><div><label for="exampleFormControlInput1" class="form-label">' + value.column_name + ' :</label><select class="form-control mb-2" name="' + value.column_name + '" id="' + value.column_name + '"><option value="#" selected>Select ' + value.column_name +'</option></select></div></div>');
                  break;
                case "file":
                  $('.formtb').append('<div class="col-md-6"><div><label for="exampleFormControlInput1" class="form-label">' + value.column_name + ' :</label><input type="file" class="form-control mb-2" name="' + value.column_name + '" id="' + value.column_name + '" placeholder="' + value.column_name + '" ' + value.is_nullable + '></div></div>');
                  break;
                  case "input":
                  $('.formtb').append('<div class="col-md-6"><div><label for="exampleFormControlInput1" class="form-label">' + value.column_name + ' :</label><input type="text" class="form-control mb-2" name="' + value.column_name + '" id="' + value.column_name + '" placeholder="' + value.column_name + '" ' + value.is_nullable + '></div></div>');
                  break;
                default:
                // $('.formtb').append('<div class="col-md-6"><input type="text" class="form-control mb-2" name="' + value.column_name + '" id="' + value.column_name + '" placeholder="' + value.column_name + '" ' + value.is_nullable +'></div>');
                  break;
              }
              break;
            case "integer":
              if (value.form_type === "input") {
                $('.formtb').append('<div class="col-md-6"><div><label for="exampleFormControlInput1" class="form-label">' + value.column_name + ' :</label><input type="number" class="form-control mb-2" name="' + value.column_name + '" id="' + value.column_name + '" placeholder="' + value.column_name + '" ' + value.is_nullable + '></div></div>');
              }
              break;
            case "text":
              if (value.form_type === "input") {
                $('.formtb').append('<div class="col-md-6"><div><label for="exampleFormControlInput1" class="form-label">' + value.column_name + ' :</label><textarea name="' + value.column_name + '" id="' + value.column_name + '" class="form-control mb-2" rows="5" placeholder="' + value.column_name + '" ' + value.is_nullable + '></textarea></div></div>');
              } else if (value.form_type === "file") {
                $('.formtb').append('<div class="col-md-6"><div><label for="exampleFormControlInput1" class="form-label">' + value.column_name + ' :</label><input type="file" class="form-control mb-2" name="' + value.column_name + '" id="' + value.column_name + '" placeholder="' + value.column_name + '" ' + value.is_nullable + '></div></div>');
              }
              break;
            case "numeric":
              if (value.form_type === "input") {
                $('.formtb').append('<div class="col-md-6"><div><label for="exampleFormControlInput1" class="form-label">' + value.column_name + ' :</label><input type="text" name="' + value.column_name + '" id="' + value.column_name + '" class="form-control mb-2" placeholder="' + value.column_name + '" ' + value.is_nullable + '></div></div>');
              }
              break;
            case "date":
              if (value.form_type === "select") {
                $('.formtb').append('<div class="col-md-6"><div><label for="exampleFormControlInput1" class="form-label">' + value.column_name + ' :</label><input type="date" name="' + value.column_name + '" id="' + value.column_name + '" class="form-control mb-2" placeholder="' + value.column_name + '" ' + value.is_nullable + '></div></div>');
              }
              break;
            default:
              break;
          }
        });
            $('#' + idhtml).append('<button class="btn btn-outline-dark mt-2 mb-2 float-end mx-2" type="reset">Reset</button><button class="btn btn-primary mt-2 mb-2 float-end" type="submit">Save</button><button type="button" class="btn btn-secondary btn-sm float-start mt-2"  data-bs-toggle="modal" data-bs-target="#help2">Help</button>');
            updateRequiredAttribute();
            getProvinsiList();
            $.each(data, function (key, value) {
                switch (value.data_type) {
                    case "character varying":
              switch (value.form_type) {
                case "select":
                showListSelect(nmTabel, value.column_name);
                  break;
                  default:
                  break;
              }
            }
            });
            // showListSelect(nmTabel, value.column_name);
            // getKabkotList();
            showMap(nmTabel);
            } else {
                $('#' + idhtml).empty(); // Clear the content if there is no data
            }
    }
  });
}

  function getProvinsiList() {
  $.ajax({
    url: base_url + '/getProvinsi',
    type: "GET",
    data: {
      "_token": "{{ csrf_token() }}"
    },
    dataType: "json",
    success: function (data) {
      if (data) {
        $('#provinsi').empty();
        $('#provinsi').append('<option value="pilihprovinsi" selected>Select Provinsi</option>');
        $.each(data, function (key, value) {
          $('select[name="provinsi"]').append('<option value="' + value.provinsi + '">' + value.provinsi + '</option>');
        });
      } else {
        $('#provinsi').empty();
      }
    }
  });
}



$(document).ready(function () {
    $('#provinsi').on('change', function () {
        var provinsiID = $(this).val();
        if (provinsiID) {
            $.ajax({
                url: base_url + '/getKabkot/' + provinsiID,
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function (data) {
                    if (data) {
                        $('#kabkot').empty();
                        $('#kecamatan').empty();
                        $('#keldes').empty();
                        $('#kabkot').append('<option hidden value="pilihkabkot" selected>Select Kabkot</option>');
                        $.each(data, function (key, value) {
                            $('#kabkot').append('<option value="' + value.kabkot + '">' + value.kabkot + '</option>');
                        });
                    } else {
                        $('#kabkot').empty();
                        $('#kecamatan').empty();
                        $('#keldes').empty();
                    }
                }
            });
        } else {
            $('#kabkot').empty();
            $('#kecamatan').empty();
            $('#keldes').empty();
        }
    });
});

  // dropdown chained district
  $(document).ready(function () {
    $('#kabkot').on('change', function () {
      var kabkotID = $(this).val();
      if (kabkotID) {
        $.ajax({
          url: base_url + '/getKecamatan/' + kabkotID,
          type: "GET",
          data: {
            "_token": "{{ csrf_token() }}"
          },
          dataType: "json",
          success: function (data) {
            if (data) {
              $('#kecamatan').empty();
              $('#kecamatan').append('<option hidden value="pilihkecamatan" selected>Select Kecamatan</option>');
              $.each(data, function (key, value) {
                $('select[name="kecamatan"]').append('<option value="' + value.kecamatan + '">' + value.kecamatan + '</option>');
              });
            } else {
              $('#kecamatan').empty();
            }
          }
        });
      } else {
        $('#kecamatan').empty();
      }
    });
  });

  // dropdown chained urban village 
  $(document).ready(function () {
    $('#kecamatan').on('change', function () {
      var kecamatanID = $(this).val();
      if (kecamatanID) {
        $.ajax({
          url: base_url + '/getKeldes/' + kecamatanID,
          type: "GET",
          data: {
            "_token": "{{ csrf_token() }}"
          },
          dataType: "json",
          success: function (data) {
            if (data) {
              $('#keldes').empty();
              $('#keldes').append('<option hidden value="pilihkelurahan" selected>Select Kelurahan / desa</option>');
              $.each(data, function (key, value) {
                $('select[name="keldes"]').append('<option value="' + value.keldes + '">' + value.keldes + '</option>');
              });
            } else {
              $('#keldes').empty();
            }
          }
        });
      } else {
        $('#keldes').empty();
      }
    });
  });

        ShowTabel('dataset-data', 'tabel-dataset');

        function ShowTabel(jenis, idhtml) {
            if (jenis == "dataset-data") {
                var nmfield = nmField_dataset;
                var url = base_url + "/ShowTabelDataset";
                var value = true
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
                            allowUpdating: true,
                            allowAdding: false,
                            allowDeleting: value,
                            selectTextOnEditStart: false,
                            // startEditAction: 'click',
                        },
                        columns: nmfield,

                        onRowRemoving: function(info) {
                            $.ajax({
                                    type: "POST",
                                    url: base_url + "/deleteDataDataset",
                                    data: {
                                        id: info.data.id,
                                        title: info.data.title,
                                        tabel: 'user_tables'
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
                                            tabel: "user_tables",
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

    <script>
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
                    allowUpdating: true,
                    allowAdding: false,
                    allowDeleting: true,
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
                    "' download='Dokumen Lampiran' class='btn btn-sm btn-primary mb-0 text-center'>Unduh</a>" +
                    "<button type='button' class='btn btn-sm btn-outline-dark mb-0 text-center' data-bs-dismiss='modal'>Batal</button>";

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

                
                onRowRemoving: function(info) {
                    $.ajax({
                            type: "POST",
                            url: base_url + "/deleteDataDataset",
                            data: {
                                id: info.data.id,
                                title: info.data.title,
                                tabel: nmTabel,
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
                                            tabel: nmTabel,
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
                                                ShowTabelAll(nmTabel);
                                                deferred.resolve(true);
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
        },
    });
}
</script>
    <script>


        var map = L.map('peta', {
            // titik koordinat disini kita dapatkan dari tabel centrepoint tepatnya dari field location
            // yang sebelumnya sudah kita tambahkan jadi lokasi map yang akan muncul  sesuai dengan tabel
            // centrepoint
            center: [0.539731,118.7240573],
            zoom: 4
        });

        // DEFAULT EXTENT
        L.control.defaultExtent().addTo(map);

        lc = L.control.locate({
            strings: {
                title: "Show me where I am, yo!"
            }
        }).addTo(map);

        var baseEsri = L.tileLayer.provider('Esri.WorldImagery');
            var baseOsm = L.tileLayer.provider('OpenStreetMap');
            var baseCarto1 = L.tileLayer.provider('CartoDB.Positron');
        var baseCarto2 = L.tileLayer.provider('CartoDB.DarkMatter').addTo(map);

        var baseLayers = {
            //"Grayscale": grayscale,
            "Esri World Imagery": baseEsri,
            "Open Street Map": baseOsm,
            "Stadia Grey": baseCarto1,
            "Stadia Dark": baseCarto2

        };

        L.control.layers(baseLayers).addTo(map);

        // Begitu juga dengan curLocation titik koordinatnya dari tabel centrepoint
        // lalu kita masukkan curLocation tersebut ke dalam variabel marker untuk menampilkan marker
        // pada peta.

        var curLocation = [0.539731,118.7240573];
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

        // setTimeout(function() { map.invalidateSize(true) }, 300);
        function resizeMap(){
map.invalidateSize();
}

    </script>
@endsection



