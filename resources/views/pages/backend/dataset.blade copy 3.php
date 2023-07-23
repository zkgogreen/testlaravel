@extends('layouts.admin')

@section('content')
    <div class="card col-md-12">
        <div class="card-block" style="padding: 1%; padding-top: 1.5%;">
            <!-- <h4 class="card-title">Simple Basic Map</h4> -->
            <ul class="nav nav-tabs float-end" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="masterdata-tab" data-bs-toggle="tab" data-bs-target="#masterdatatab"
                        type="button" role="tab" aria-controls="masterdata" aria-selected="true">Master Data
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="layerdata-tab" data-bs-toggle="tab"
                        data-bs-target="#layerdatatab" type="button" role="tab" aria-controls="layerdata"
                        aria-selected="false">Layer
                    </button>
                </li>
            </ul>

            <div class="tab-content mt-4" id="myTabContent">
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
                                        <th class="text-center">Roles Access</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center" colspan="2">Color Palette</th>
                                    </tr>
                                      <tr class="table-secondary">
                                    <td colspan="2">
                                        <input type="text" name="name_table" class="form-control" placeholder="Enter Table Name" required>
                                      </td>
                                    <td colspan="1">
                                        <select class="select2 form-select" name="roles_table" required>
                                            <option value="Private" selected>Private</option>
                                            <option value="Public">Public</option>
                                          </select>
                                    </td>
                                    <td colspan="1">
                                        <select class="select2 form-select" name="status_table" required>
                                            <option value="ActiveAdmin">Active Admin Only</option>
                                            <option value="Active" selected>Active</option>
                                            <option value="Inactive">Inactive</option>
                                          </select>
                                    </td>
                                    <td colspan="2">
                                        <select class="select2 form-select" name="color_palette" required>
                                            <option value="#" selected>Select Color Palette</option>
                                            @foreach ($color_palette as $item)
                                            <option value="{{$item->title}}">{{$item->title}}</option>
                                            @endforeach
                                          </select>
                                          
                                    </td>
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
                                        <th class="text-center">Roles Access</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center" colspan="2">Color Palette</th>
                                    </tr>
                                      <tr class="table-secondary">
                                    <td colspan="2">
                                        <input type="text" name="name_table" class="form-control" placeholder="Enter Table Name" required>
                                      </td>
                                    <td colspan="1">
                                        <select class="select2 form-select" name="roles_table" required>
                                            <option value="Private" selected>Private</option>
                                            <option value="Public">Public</option>
                                          </select>
                                    </td>
                                    <td colspan="1">
                                        <select class="select2 form-select" name="status_table" required>
                                            <option value="ActiveAdmin">Active Admin Only</option>
                                            <option value="Active" selected>Active</option>
                                            <option value="Inactive">Inactive</option>
                                          </select>
                                    </td>
                                    <td colspan="2">
                                        <select class="select2 form-select" name="color_palette" required>
                                            <option value="#" selected>Select Color Palette</option>
                                            @foreach ($color_palette as $item)
                                            <option value="{{$item->title}}">{{$item->title}}</option>
                                            @endforeach
                                          </select>
                                    </td>
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

                <div class="tab-pane fade" id="layerdatatab" role="tabpanel" aria-labelledby="layerdata-tab">
                <h4>Layer</h4>
                <p>Pilih layer untuk menampilkan tabel atau menambahkan data</p>
                <select class="form-control form-control-sm jtable w-100 mt-2" name="jenis_data" id="jenis_data">
                    <option value="tbnonselect" selected>Select Master Data</option>
                    @foreach ($spatial_layer as $item)
                    <option value="{{$item->title}}">{{$item->name}}</option>  
                    @endforeach
                    <option value="tb_poi">Point Of Interest</option>  
                    <option value="tb_spd">Survey Potensi Desa</option>
                    <option value="tb_kp">Kawasan prioritas</option>
                    <option value="tb_penerima_bantuan">Penerima Bantuan</option>
                </select> 

                <div class="row mb-2 mt-2">
                    <div id="kolomList">
                        <div id="kList"></div>
                    </div>
                </div>

                <div class="row mb-2 mt-2">
                   <div id="tabelForm"></div>  
                </div>
                <div class="row p-3">
                   <div id="tblayer"></div>
                </div>

                </div>
            </div>
        </div>
    </div>
    @endsection


    @section('addon-modal')
    <div class="modal fade" id="help" role="dialog" style="margin-top: 7%;
    padding-right: 0;">
        <div class="modal-dialog modal-centered">
          <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Rules Create Master Data</h5>
          </div>
          <div class="modal-body" style='padding:15px; height: 400px;
          overflow-y: auto;'>
            <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Form</th>
                    <th>Notes</th>
                    <th>Description</th>
                </tr>
                <tr>
                    <th>Table Name</th>
                    <td>Nama tabel master</td>
                    <td>Penulisan harus kecil semua dan tidak boleh ada spasial, untuk memisahkan kata gunakan tanda underscore "_", contoh : <strong>data_contoh</strong></td>
                </tr>
                <tr>
                    <th>Roles Access</th>
                    <td>Hak akses data</td>
                    <td>Pilihan "private" hanya jika akses informasi tersedia untuk internal kominfo saja dalam bentuk map density dan map marker, pilihan "public" untuk data dapat di akses di halaman depan sistem, dengan tampilan berupa map density. </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>Status Tabel</td>
                    <td>Terdapat 3 active, active in admin, inactive</td>
                </tr>
                <tr>
                    <th>Color Palette</th>
                    <td>Pilihan warna map density</td>
                    <td>
                       <table class="table table-striped">
                        @foreach ($color_palette as $item)
                        <tr style="width: 50%">  
                          <th>{{$item->title}}</th>
                            @foreach ($item->color as $items)
                            <td class="p-0">
                                <div style="height: 20px; width:20px; background-color:{{$items->color}};" class="p-0"></div>
                            </td>
                                @endforeach
                        </tr>
                        @endforeach
                        </table> 

                    </td>
                </tr>
                <tr>
                    <th>Column Name</th>
                    <td>Nama kolom tabel</td>
                    <td>Penulisan harus kecil semua dan tidak boleh ada spasial, untuk memisahkan kata gunakan tanda underscore "_", contoh : <strong>data_contoh</strong></td>
                </tr>
                <tr>
                    <th>Data Type</th>
                    <td>Type data kolom</td>
                    <td>
<table class="table  table-striped">
    <tr>
        <th>Date</th>
        <td>Untuk kolom dengan tipe data berisikan tanggal, format penulisan YYYY-MM-DD </td>
    </tr>
    <tr>
        <th>DateTime</th>
        <td>Untuk kolom dengan tipe data berupa tanggal dan waktu, format penulisan YYYY-MM-DD HH:MM:SS</td>
    </tr>
    <tr>
        <th>Decimal</th>
        <td>Untuk kolom dengan tipe data berupa angka desimal</td>
    </tr>
    <tr>
        <th>Integer</th>
        <td>Untuk kolom dengan tipe data berupa bilangan bulat negatif ataupun positif</td>
    </tr>
    <tr>
        <th>String</th>
        <td>Untuk kolom berisikan karakter, spesial karakter, number dan spasi dengan maksimal panjang karakter 255</td>
    </tr>
    <tr>
        <th>Text</th>
        <td>Untuk kolom berisikan karakter, spesial karakter, number dan spasi dengan panjang karakter tidak terbatas</td>
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
                    <td>Mewajibkan kolom harus di isi saat input data</td>
                </tr> 
                <tr>
                    <th>Unique</th>
                    <td>Mewajibkan kolom berisikan data unik berbeda dari data lainnya, umumnya berupa id</td>
                </tr> 
                <tr>
                    <th>Null</th>
                    <td>Mengijinkan kolom untuk di biarkan kosong saat input data</td>
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
                    <td>Form Berisikan pilihan data yang sudah ditentukan sebelumnya (saat memilih ini, wajib mengisi pada form <strong>Value List</strong>)</td>
                </tr> 
                <tr>
                    <th>Input</th>
                    <td>Form kosong yang bisa di isi sesuai dengan <strong>Data Type</strong></td>
                </tr> 
                <tr>
                    <th>File</th>
                    <td>Form input untuk data berupa file (pdf, doc, png, jpg), <i>Untuk Form Type ini pastikan menggunakan <strong>Text</strong> pada pilihan Data Type</i></td>
                </tr> 
            </table>
        </td>
    </tr>
    <tr>
        <th>Value List</th>
        <td>Pilihan Isian Default</td>
        <td>Form ini hanya di isi jika pilihan Form Type adalah <strong>Select</strong>, dengan format penulisan dipisah dengan tanda koma "," antar pilihan. Contoh penulisan pilihan Jenis Kelamin : <strong>Laki-laki, Perempuan, Lainnya</strong></td>
    </tr>
    <tr>
        <th>Action / Notes</th>
        <td>Tombol add atau delete</td>
        <td>Jika akan menambahkan kolom baru tekan tombol <strong>ADD</strong>, dan jika ingin menghapus kolom tekan tombol <strong>DELETE</strong></td>
    </tr>
            </table>
            </div>
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

<script src="{{ url('assets/table/table-field.js') }}"></script> 
   <script>

        var menu_jdata = document.getElementById("jenis_data");
        var menu_kList = document.getElementById("kList");

        menu_jdata.addEventListener("change", generateData);

        function generateData(event) {
            ShowTabelAll(menu_jdata.value, 'tblayer');
            ShowFormTabel(menu_jdata.value, 'tabelForm');
            showKolomList(menu_jdata.value);
        }

        menu_kList.addEventListener("change", generateKolomlist);

        function generateKolomlist(event) {
            showListSelect(menu_jdata.value, menu_kList.value);
        }

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

function showKolomList(nmTabel) {
            $.ajax({
                url: base_url + '/valueKolomList/' + nmTabel,
                type: "get",
                data: {
                    tabel: nmTabel,
                },
                success: function(data) {
                    if (data) {
                        $('#kolomList').empty();
                        $('#kolomList').append('<p class="mb-0 titleForm">Form tambah data baru :</p>');
                        $('#kolomList').append('<div class="row"><label for="inputPassword" class="col-sm-2 col-form-label">Pilih Kolom Select : </label><div class="col-sm-10"><select class="form-control" name="kList" id="kList"></select><div id="formtitle" class="form-text">Untuk menampilkan pilihan value pada form type select</div></div></div>');
                        $('#kList').append('<option value="#" selected>Select Kolom List</option>');
                        $.each(data, function(key, value) {
                            $('#kList').append('<option value="' + value.column + '">' + value.column + '</option>');
                        });
                    } else {
                        $('#kolomList').empty();
                    }
                }
            });
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
                                $('select[name="' + nmField + '"]').append('<option value="' + list[i] + '">' + list[i] + '</option>');
                            }
                        });
                    } else {
                        $('#' + nmField).empty();
                    }
                }
            });
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
                $('#' + idhtml).append('<form action="{{route('addNewRow')}}" method="post" id="formtbSelect" enctype="multipart/form-data">@csrf</form>');
                $('#formtbSelect').append('<input type="hidden" class="form-control mb-2" name="tabel" id="tabel" value="' + nmTabel + '">');
                $('#formtbSelect').append('<div class="row formtb"></div>');

                $.each(data, function (key, value) {
                    switch (value.data_type) {
                        case "character varying":
                            $('.formtb').append('<div class="col-md-6"><select class="form-control mb-2" name="' + value.column_name + '" id="' + value.column_name + '"></select></div>');
                            // $('.formtb').append('<div class="col-md-6"><input type="text" class="form-control mb-2" name="' + value.column_name + '" id="' + value.column_name + '" placeholder="' + value.column_name + '" ' + value.is_nullable +'></div>');
                            break;
                        case "integer":
                            $('.formtb').append('<div class="col-md-6"><input type="number" class="form-control mb-2" name="' + value.column_name + '" id="' + value.column_name + '" placeholder="' + value.column_name + '" ' + value.is_nullable + '></div>');
                            break;
                        case "text":
                            $('.formtb').append('<div class="col-md-6"><textarea name="' + value.column_name + '" id="' + value.column_name + '" class="form-control mb-2" rows="5" placeholder="' + value.column_name + '" ' + value.is_nullable + '></textarea></div>');
                            break;
                        case "numeric":
                            $('.formtb').append('<div class="col-md-6"><input type="text" name="' + value.column_name + '" id="' + value.column_name + '" class="form-control mb-2" placeholder="' + value.column_name + '" ' + value.is_nullable + '></div>');
                            break;
                            case "date":
                            $('.formtb').append('<div class="col-md-6"><input type="date" name="' + value.column_name + '" id="' + value.column_name + '" class="form-control mb-2" placeholder="' + value.column_name + '" ' + value.is_nullable + '></div>');
                            break;
                        default:
                            break;
                    };
                });

                $('#formtbSelect').append('<button class="btn btn-outline-dark mt-2 mb-2 float-end mx-2" type="reset">Reset</button><button class="btn btn-primary mt-2 mb-2 float-end" type="submit">Save</button>');
            updateRequiredAttribute();
            getProvinceList();
            // populateDropdown();
            // getDataAndPopulate();
            } else {
                $('#' + idhtml).empty(); // Clear the content if there is no data
            }
        },
    });
};


 // dropdown chained regency
 function getProvinceList() {
              $.ajax({
                  url: base_url + '/getProvince',
                  type: "GET",
                  data: {
                      "_token": "{{ csrf_token() }}"
                  },
                  dataType: "json",
                  success: function(data) {
                      if (data) {
                          $('#provinsi').empty();
                          $('#provinsi').append('<option hidden value="pilihprovinsi" selected>Select Provinsi</option>');
                          $.each(data, function(key, value) {
                              $('select[name="provinsi"]').append('<option value="' + value.wadmpr + '">' + value.wadmpr + '</option>');
                          });
                      } else {
                          $('#provinsi').empty();
                      }
                  }
              });
            };
            
  // dropdown chained regency
  $(document).ready(function() {
      $('#provinsi').on('change', function() {
          var provinsiID = $(this).val();
          if (provinsiID) {
              $.ajax({
                  url: base_url + '/getRegency/' + provinsiID,
                  type: "GET",
                  data: {
                      "_token": "{{ csrf_token() }}"
                  },
                  dataType: "json",
                  success: function(data) {
                      if (data) {
                          $('#kabkot').empty();
                          $('#kabkot').append('<option hidden value="pilihkabkot" selected>Select Kabkot</option>');
                          $.each(data, function(key, value) {
                              $('select[name="kabkot"]').append('<option value="' + value.wadmkk + '">' + value.wadmkk + '</option>');
                          });
                      } else {
                          $('#kabkot').empty();
                      }
                  }
              });
          } else {
              $('#kabkot').empty();
          }
      });
  });

  // dropdown chained district
  $(document).ready(function() {
      $('#kabkot').on('change', function() {
          var kabkotID = $(this).val();
          if (kabkotID) {
              $.ajax({
                  url: base_url + '/getDistrict/' + kabkotID,
                  type: "GET",
                  data: {
                      "_token": "{{ csrf_token() }}"
                  },
                  dataType: "json",
                  success: function(data) {
                      if (data) {
                          $('#kecamatan').empty();
                          $('#kecamatan').append('<option hidden value="pilihkecamatan" selected>Select Kecamatan</option>');
                          $.each(data, function(key, value) {
                              $('select[name="kecamatan"]').append('<option value="' + value.wadmkc + '">' + value.wadmkc + '</option>');
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
  $(document).ready(function() {
      $('#kecamatan').on('change', function() {
          var kecamatanID = $(this).val();
          if (kecamatanID) {
              $.ajax({
                  url: base_url + '/getSubdistrict/' + kecamatanID,
                  type: "GET",
                  data: {
                      "_token": "{{ csrf_token() }}"
                  },
                  dataType: "json",
                  success: function(data) {
                      if (data) {
                          $('#keldes').empty();
                          $('#keldes').append('<option hidden value="pilihkelurahan" selected>Select Village</option>');
                          $.each(data, function(key, value) {
                              $('select[name="keldes"]').append('<option value="' + value.wadmkd + '">' + value.wadmkd + '</option>');
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

//  // Fungsi reusable untuk mengisi dropdown berdasarkan data
//  function populateDropdown(targetDropdown, data) {
//     //   targetDropdown.empty();
//       targetDropdown.append('<option hidden value="pilih' + targetDropdown.attr('id') + '" selected>Select ' + targetDropdown.attr('id') + '</option>');
//       $.each(data, function(key, value) {
//         targetDropdown.append('<option value="' + value.wadmpr + '">' + value.wadmpr + '</option>');
//       });
//     }

//     $(document).ready(function() {
//       // Fungsi untuk mendapatkan data dari server dan mengisi dropdown
//       function getDataAndPopulate(targetDropdown, url, id) {
//         $.ajax({
//           url: base_url + url + id,
//           type: "GET",
//           data: {
//             "_token": "{{ csrf_token() }}"
//           },
//           dataType: "json",
//           success: function(data) {
//             if (data) {
//               populateDropdown(targetDropdown, data);
//             } else {
//               targetDropdown.empty();
//             }
//           }
//         });
//       }

//       // Event listener untuk perubahan pilihan pada dropdown provinsi
//       $("#provinsi").on("change", function() {
//         var provinsiID = $(this).val();
//         if (provinsiID) {
//           getDataAndPopulate($("#kabkot"), '/getRegency/', provinsiID);
//         } else {
//           $("#kabkot").empty();
//           $("#kecamatan").empty();
//           $("#keldes").empty();
//         }
//       });

//       // Event listener untuk perubahan pilihan pada dropdown kabupaten/kota
//       $("#kabkot").on("change", function() {
//         var kabkotID = $(this).val();
//         if (kabkotID) {
//           getDataAndPopulate($("#kecamatan"), '/getDistrict/', kabkotID);
//         } else {
//           $("#kecamatan").empty();
//           $("#keldes").empty();
//         }
//       });

//       // Event listener untuk perubahan pilihan pada dropdown kecamatan
//       $("#kecamatan").on("change", function() {
//         var kecamatanID = $(this).val();
//         if (kecamatanID) {
//           getDataAndPopulate($("#keldes"), '/getSubdistrict/', kecamatanID);
//         } else {
//           $("#keldes").empty();
//         }
//       });

//       // Panggil fungsi untuk mengisi dropdown provinsi pertama kali saat halaman dimuat
//       getDataAndPopulate($("#provinsi"), '/getProvince', '');
//     });


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
                success: function(msg) {
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
                        export: {
                    enabled: true,
                    allowExportSelectedData: true,
                    fileName: "DB Notice & Trilateral",
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
                            allowDeleting: true,
                            selectTextOnEditStart: false,
                            // startEditAction: 'click',
                        },
                        columns: msg["]nmfield"],

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
@endsection



