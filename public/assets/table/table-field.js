var level_user = [
    {
      ID: 1,
      Name: 'SUPER USER',
    },
    {
      ID: 2,
      Name: 'ADMIN',
    },
    {
      ID: 3,
      Name: 'USER',
    },
  ];


  var roles_table = [
    {
      ID: 1,
      Name: 'Private',
    },
    {
      ID: 2,
      Name: 'Public',
    },
  ];

  var type_count = [
    {
      ID: 1,
      Name: '-',
    },
    {
      ID: 2,
      Name: 'distinct',
    },
    {
      ID: 3,
      Name: 'all',
    },
  ];

  var status_table = [
    {
      ID: 1,
      Name: 'Active',
    },
    {
      ID: 2,
      Name: 'Active Admin Only',
    },
    {
      ID: 3,
      Name: 'Inactive',
    },
  ];

  var type_table = [
    {
      ID: 1,
      Name: 'Spatial',
    },
    {
      ID: 2,
      Name: 'Non Spatial',
    },
  ];

  var color_palette = [
    {
      ID: 1,
      Name: 'Area Brown',
    },
    {
      ID: 2,
      Name: 'Area Green',
    },
    {
      ID: 3,
      Name: 'Area Red',
    },
    {
      ID: 4,
      Name: 'Orange',
    },
    {
      ID: 5,
      Name: 'Red',
    },
    {
      ID: 6,
      Name: 'Blue',
    },
    {
      ID: 7,
      Name: 'Grey',
    },
    {
      ID: 8,
      Name: 'Green',
    },
  ];
  
  var nmField_user = [
    {
      type: 'buttons',
      buttons: ['edit', 'delete'],
    },
    // {
    //   dataField: 'id',
    //   dataType: 'number',
    //   allowEditing: 0,
    // },
    {
      dataField: 'name',
      dataType: 'string',
      // validationRules: [{
      //   type: 'required',
      //   message: 'Name is required',
      // }],
    },
    {
      dataField: 'email',
      dataType: 'string',
      // validationRules: [{
      //   type: 'required',
      //   message: 'Email is required',
      // }, {
      //   type: 'email',
      //   message: 'Email is invalid',
      // }, {
      //   type: 'async',
      //   message: 'Email is already registered',
      //   validationCallback(params) {
      //     return sendRequest(params.value);
      //   },
      // }],
    },
    {
      dataField: 'roles',
      caption: 'level',
      lookup: {
        dataSource: level_user,
        displayExpr: 'Name',
        valueExpr: 'Name',
      },
    },
    {
      dataField: 'created_at',
      caption: 'Tanggal Buat',
      dataType: 'date',
      allowEditing: 0,
    },
    {
      dataField: 'updated_at',
      caption: 'Tanggal Update',
      dataType: 'date',
      allowEditing: 0,
    },
  ];


  var nmField_content = [
    {
      type: 'buttons',
      buttons: ['edit'],
    },
    // {
    //   dataField: 'id',
    //   dataType: 'number',
    //   allowEditing: 0,
    // },
    {
      dataField: 'section',
      dataType: 'string',
            allowEditing: 0,
    },
    {
      dataField: 'title',
      dataType: 'string',
    },
    {
      dataField: 'description',
      dataType: 'string',
    },
    {
      dataField: 'type',
      caption: 'Type Count',
      dataType: 'string',
      lookup: {
        dataSource: type_count,
        displayExpr: 'Name',
        valueExpr: 'Name',
      },
    },
    {
      dataField: 'layer',
      dataType: 'string',
    },
    {
      dataField: 'kolom',
      dataType: 'string',
    },
  ];


var nmField_spd = [
    {
      type: 'buttons',
      buttons: ['edit', 'delete'],
    },
    // {
    //   dataField: 'id',
    //   dataType: 'number',
    //   allowEditing: 0,
    // },
    {
      dataField: 'kode_bps',
      caption: 'Id Desa',
      dataType: 'number',
    },
    {
      dataField: 'r104n',
      caption: 'Desa / Kelurahan',
      dataType: 'string',
    },
    {
        dataField: 'r103n',
        caption: 'Kecamatan',
        dataType: 'string',
      },
      {
        dataField: 'r102n',
        caption: 'Kab / Kota',
        dataType: 'string',
      },
      {
        dataField: 'r101n',
        caption: 'Provinsi',
        dataType: 'string',
      },

      {
        dataField: 'spd_seluler',
        caption: 'Seluler',
        dataType: 'string',
      },
      {
        dataField: 'spd_elektrifikasi',
        caption: 'Elektrifikasi',
        dataType: 'string',
      },
      {
        dataField: 'spd_akses_jalan',
        caption: 'Akses Jalan',
        dataType: 'string',
      },
      {
        dataField:'spd_jumlah_penduduk',
        caption: 'Jumlah Penduduk',
        dataType: 'string',
      },
      {
        dataField:'spd_jumlah_kk',
        caption: 'Jumlah KK',
        dataType: 'string',
      },
      {
        dataField: 'spd_pendapatan',
        caption: 'Pendapatan Penduduk',
        dataType: 'string',
      },
      {
        dataField: 'spd_jumlah_umkm',
        caption: 'Jumlah Penduduk',
        dataType: 'string',
      },
      {
        dataField:'spd_komunitas',
        caption: 'Komunitas',
        dataType: 'string',
      },
      {
        dataField:'spd_dana_desa',
        caption: 'Dana Desa',
        dataType: 'string',
      },
      {
        dataField:'spd_pemerintah_desa',
        caption: 'Pemerintahan Desa',
        dataType: 'string',
      },
      {
        dataField:'spd_bumdes',
        caption: 'BUMDES',
        dataType: 'string',
      },
      {
        dataField:'spd_pencaharian',
        caption: 'Mata Pencaharian Penduduk',
        dataType: 'string',
      },
      {
        dataField:'spd_jenis_umkm',
        caption: 'Jenis UMKM',
        dataType: 'string',
      },
      {
        dataField:'spd_pic',
        caption: 'Kontak PIC',
        dataType: 'string',
      },
      {
        dataField:'spd_keterangan',
        caption: 'Kontak PIC',
        dataType: 'string',
      },
      {
        dataField:'spd_thn_survey',
        caption: 'Tahun Survey',
        dataType: 'string',
      },
      {
        dataField:'spd_potensi',
        caption: 'Pontensi',
        dataType: 'string',
      },
  ];


  var nmField_spd_2 = [
    // {
    //   dataField: 'id',
    //   dataType: 'number',
    //   allowEditing: 0,
    // },
    {
      dataField: 'kode_bps',
      caption: 'Id Desa',
      dataType: 'number',
    },
    {
      dataField: 'r104n',
      caption: 'Desa / Kelurahan',
      dataType: 'string',
    },
    {
        dataField: 'r103n',
        caption: 'Kecamatan',
        dataType: 'string',
      },
      {
        dataField: 'r102n',
        caption: 'Kab / Kota',
        dataType: 'string',
      },
      {
        dataField: 'r101n',
        caption: 'Provinsi',
        dataType: 'string',
      },

      {
        dataField: 'spd_seluler',
        caption: 'Seluler',
        dataType: 'string',
      },
      {
        dataField: 'spd_elektrifikasi',
        caption: 'Elektrifikasi',
        dataType: 'string',
      },
      {
        dataField: 'spd_akses_jalan',
        caption: 'Akses Jalan',
        dataType: 'string',
      },
      {
        dataField:'spd_jumlah_penduduk',
        caption: 'Jumlah Penduduk',
        dataType: 'string',
      },
      {
        dataField:'spd_jumlah_kk',
        caption: 'Jumlah KK',
        dataType: 'string',
      },
      {
        dataField: 'spd_pendapatan',
        caption: 'Pendapatan Penduduk',
        dataType: 'string',
      },
      {
        dataField: 'spd_jumlah_umkm',
        caption: 'Jumlah Penduduk',
        dataType: 'string',
      },
      {
        dataField:'spd_komunitas',
        caption: 'Komunitas',
        dataType: 'string',
      },
      {
        dataField:'spd_dana_desa',
        caption: 'Dana Desa',
        dataType: 'string',
      },
      {
        dataField:'spd_pemerintah_desa',
        caption: 'Pemerintahan Desa',
        dataType: 'string',
      },
      {
        dataField:'spd_bumdes',
        caption: 'BUMDES',
        dataType: 'string',
      },
      {
        dataField:'spd_pencaharian',
        caption: 'Mata Pencaharian Penduduk',
        dataType: 'string',
      },
      {
        dataField:'spd_jenis_umkm',
        caption: 'Jenis UMKM',
        dataType: 'string',
      },
      {
        dataField:'spd_pic',
        caption: 'Kontak PIC',
        dataType: 'string',
      },
      {
        dataField:'spd_keterangan',
        caption: 'Kontak PIC',
        dataType: 'string',
      },
      {
        dataField:'spd_thn_survey',
        caption: 'Tahun Survey',
        dataType: 'string',
      },
      {
        dataField:'spd_potensi',
        caption: 'Pontensi',
        dataType: 'string',
      },
  ];

  var nmField_spd_3 = [
    // {
    //   dataField: 'id',
    //   dataType: 'number',
    //   allowEditing: 0,
    // },
    {
      dataField: 'kode_bps',
      caption: 'Id Desa',
      dataType: 'number',
    },
    {
      dataField: 'r104n',
      caption: 'Desa / Kelurahan',
      dataType: 'string',
    },
    {
        dataField: 'r103n',
        caption: 'Kecamatan',
        dataType: 'string',
      },
      {
        dataField: 'r102n',
        caption: 'Kab / Kota',
        dataType: 'string',
      },
      {
        dataField: 'r101n',
        caption: 'Provinsi',
        dataType: 'string',
      },
      {
        dataField:'spd_keterangan',
        caption: 'Kontak PIC',
        dataType: 'string',
      },
      {
        dataField:'spd_thn_survey',
        caption: 'Tahun Survey',
        dataType: 'string',
      },
      {
        dataField:'spd_potensi',
        caption: 'Pontensi',
        dataType: 'string',
      },
  ];


  var nmField_pb = [
    {
      dataField: 'id',
      caption: '',
      cellTemplate(container, options) {
          $("<a>").attr('href', base_url + "/listdata/pbtable/" +  options.value)
              .append("<span style='color: #337ab7;'>Edit</span>")
              .appendTo(container);
      },
    },

    {
      type: 'buttons',
      buttons: ['edit', 'delete'],
    },
    // {
    //   dataField: 'id',
    //   dataType: 'number',
    //   allowEditing: 0,
    // },
    {
      dataField: 'nama',
      caption: 'Nama Lengkap',
      dataType: 'string',
    },
    {
        dataField: 'telepon',
        caption: 'Telepon',
        dataType: 'string',
      },
      {
        dataField: 'email',
        caption: 'email',
        dataType: 'string',
      },
    {
        dataField: 'jenis_usaha',
        caption: 'Jenis Usaha',
        dataType: 'string',
      },
      {
        dataField: 'produk',
        caption: 'Produk',
        dataType: 'string',
      },
    {
        dataField: 'alamat',
        caption: 'Alamat',
        dataType: 'string',
      },
      {
        dataField: 'desa',
        caption: 'Desa / Kelurahan',
        dataType: 'string',
      },
      {
        dataField: 'kecamatan',
        caption: 'Kecamatan',
        dataType: 'string',
      },
      {
        dataField: 'kab_kota',
        caption: 'Kab / Kota',
        dataType: 'string',
      },
      {
        dataField: 'provinsi',
        caption: 'provinsi',
        dataType: 'string',
      },
      {
        dataField:  'longitude',
      caption: 'Longitude',
      dataType: 'string',
    },
    {
    dataField:  'latitude',
    caption: 'Latitude',
    dataType: 'string',
    },


    {
    dataField: 'nama_pic',
    caption: 'Nama PIC',
    dataType: 'string',
    },
    {
    dataField: 'kontak_pic',
    caption: 'Kontak PIC',
    dataType: 'string',
    },
    {
    dataField: 'pengusul',
    caption: 'Pengusul',
    dataType: 'string',
    },
      {
        dataField: 'keterangan',
        caption: 'Keterangan',
        dataType: 'string',
      },
      {
        dataField: 'thn_bantuan',
        caption: 'Tahun Bantuan',
        dataType: 'number',
      },
  ];


  var nmField_pb_2 = [

    // {
    //   dataField: 'id',
    //   dataType: 'number',
    //   allowEditing: 0,
    // },
    {
      dataField: 'nama',
      caption: 'Nama Lengkap',
      dataType: 'string',
    },
    {
        dataField: 'telepon',
        caption: 'Telepon',
        dataType: 'string',
      },
      {
        dataField: 'email',
        caption: 'email',
        dataType: 'string',
      },
    {
        dataField: 'jenis_usaha',
        caption: 'Jenis Usaha',
        dataType: 'string',
      },
      {
        dataField: 'produk',
        caption: 'Produk',
        dataType: 'string',
      },
    {
        dataField: 'alamat',
        caption: 'Alamat',
        dataType: 'string',
      },
      {
        dataField: 'desa',
        caption: 'Desa / Kelurahan',
        dataType: 'string',
      },
      {
        dataField: 'kecamatan',
        caption: 'Kecamatan',
        dataType: 'string',
      },
      {
        dataField: 'kab_kota',
        caption: 'Kab / Kota',
        dataType: 'string',
      },
      {
        dataField: 'provinsi',
        caption: 'provinsi',
        dataType: 'string',
      },
      {
        dataField:  'longitude',
      caption: 'Longitude',
      dataType: 'string',
    },
    {
    dataField:  'latitude',
    caption: 'Latitude',
    dataType: 'string',
    },


    {
    dataField: 'nama_pic',
    caption: 'Nama PIC',
    dataType: 'string',
    },
    {
    dataField: 'kontak_pic',
    caption: 'Kontak PIC',
    dataType: 'string',
    },
    {
    dataField: 'pengusul',
    caption: 'Pengusul',
    dataType: 'string',
    },
      {
        dataField: 'keterangan',
        caption: 'Keterangan',
        dataType: 'string',
      },
      {
        dataField: 'thn_bantuan',
        caption: 'Tahun Bantuan',
        dataType: 'number',
      },
  ];

  var nmField_pb_3 = [
    // {
    //   dataField: 'id',
    //   dataType: 'number',
    //   allowEditing: 0,
    // },
    {
      dataField: 'nama',
      caption: 'Nama Lengkap',
      dataType: 'string',
    },
    {
        dataField: 'jenis_usaha',
        caption: 'Jenis Usaha',
        dataType: 'string',
      },
      {
        dataField: 'produk',
        caption: 'Produk',
        dataType: 'string',
      },

      {
        dataField: 'desa',
        caption: 'Desa / Kelurahan',
        dataType: 'string',
      },
      {
        dataField: 'kecamatan',
        caption: 'Kecamatan',
        dataType: 'string',
      },
      {
        dataField: 'kab_kota',
        caption: 'Kab / Kota',
        dataType: 'string',
      },
      {
        dataField: 'provinsi',
        caption: 'provinsi',
        dataType: 'string',
      },
      {
        dataField: 'keterangan',
        caption: 'Keterangan',
        dataType: 'string',
      },
      {
        dataField: 'thn_bantuan',
        caption: 'Tahun Bantuan',
        dataType: 'number',
      },
  ];


  var nmField_poi = [
    // {
    //   type: 'buttons',
    //   buttons: ['edit', 'delete'],
    // },
    // {
    //   dataField: 'id',
    //   dataType: 'number',
    //   allowEditing: 0,
    // },
    {
      dataField: 'namobj',
      caption: 'Nama Objek',
      dataType: 'string',
    },
    {
      dataField: 'remark',
      caption: 'Keterangan',
      dataType: 'string',
    },
    {
        dataField: 'jenis_poi',
        caption: 'Jenis POI',
        dataType: 'string',
      },
     
  ];


  var nmField_kp = [
    {
      type: 'buttons',
      buttons: ['edit', 'delete'],
    },
    // {
    //   dataField: 'id',
    //   dataType: 'number',
    //   allowEditing: 0,
    // },
    {
      dataField: 'kode_bps',
      caption: 'ID Desa',
      dataType: 'number',
    },
    {
      dataField: 'r104n',
      caption: 'Desa / Kelurahan',
      dataType: 'string',
    },
    {
        dataField: 'r103n',
        caption: 'Kecamatan',
        dataType: 'string',
      },
      {
        dataField: 'r102n',
        caption: 'Kab / Kota',
        dataType: 'string',
      },
      {
        dataField: 'r101n',
        caption: 'Provinsi',
        dataType: 'string',
      },

      {
        dataField: 'kp_jenis_kawasan',
        caption: 'Jenis Kawasan',
        dataType: 'string',
      },


      {
        dataField: 'kp_3t',
        caption: '3T',
        dataType: 'string',
      },


      {
        dataField: 'kp_lokpri',
        caption: 'Lokasi Prioritas',
        dataType: 'string',
      },
     
  ];


  var nmField_kp_2 = [
    // {
    //   type: 'buttons',
    //   buttons: ['edit', 'delete'],
    // },
    // {
    //   dataField: 'id',
    //   dataType: 'number',
    //   allowEditing: 0,
    // },
    {
      dataField: 'kode_bps',
      caption: 'ID Desa',
      dataType: 'number',
    },
    {
      dataField: 'r104n',
      caption: 'Desa / Kelurahan',
      dataType: 'string',
    },
    {
        dataField: 'r103n',
        caption: 'Kecamatan',
        dataType: 'string',
      },
      {
        dataField: 'r102n',
        caption: 'Kab / Kota',
        dataType: 'string',
      },
      {
        dataField: 'r101n',
        caption: 'Provinsi',
        dataType: 'string',
      },

      {
        dataField: 'kp_jenis_kawasan',
        caption: 'Jenis Kawasan',
        dataType: 'string',
      },


      {
        dataField: 'kp_3t',
        caption: '3T',
        dataType: 'string',
      },


      {
        dataField: 'kp_lokpri',
        caption: 'Lokasi Prioritas',
        dataType: 'string',
      },
     
  ];


  var nmField_kp_3 = [
    // {
    //   dataField: 'id',
    //   dataType: 'number',
    //   allowEditing: 0,
    // },
    {
      dataField: 'kode_bps',
      caption: 'ID Desa',
      dataType: 'number',
    },
    {
      dataField: 'r104n',
      caption: 'Desa / Kelurahan',
      dataType: 'string',
    },
    {
        dataField: 'r103n',
        caption: 'Kecamatan',
        dataType: 'string',
      },
      {
        dataField: 'r102n',
        caption: 'Kab / Kota',
        dataType: 'string',
      },
      {
        dataField: 'r101n',
        caption: 'Provinsi',
        dataType: 'string',
      },

      {
        dataField: 'kp_jenis_kawasan',
        caption: 'Jenis Kawasan',
        dataType: 'string',
      },


      {
        dataField: 'kp_3t',
        caption: '3T',
        dataType: 'string',
      },


      {
        dataField: 'kp_lokpri',
        caption: 'Lokasi Prioritas',
        dataType: 'string',
      },
     
  ];

  var nmField_podes20 = [
    // {
    //   type: 'buttons',
    //   buttons: ['edit', 'delete'],
    // },
    // {
    //   dataField: 'id',
    //   dataType: 'number',
    //   allowEditing: 0,
    // },
    {
      dataField: 'kode_bps',
      caption: 'ID Desa',
      dataType: 'number',
    },
    {
      dataField: 'r104n',
      caption: 'Desa / Kelurahan',
      dataType: 'string',
    },
    {
        dataField: 'r103n',
        caption: 'Kecamatan',
        dataType: 'string',
      },
      {
        dataField: 'r102n',
        caption: 'Kab / Kota',
        dataType: 'string',
      },
      {
        dataField: 'r101n',
        caption: 'Provinsi',
        dataType: 'string',
      },
     
  ];


  var nmField_stb = [
    // {
    //   type: 'buttons',
    //   buttons: ['edit', 'delete'],
    // },
    // {
    //   dataField: 'id',
    //   dataType: 'number',
    //   allowEditing: 0,
    // },
    {
      dataField: 'nama',
      caption: 'Nama Lengkap',
      dataType: 'string',
    },
    {
      dataField: 'nik',
      caption: 'NIK',
      dataType: 'number',
    },
    {
        dataField: 'alamat',
        caption: 'Alamat',
        dataType: 'string',
      },
      {
        dataField: 'desa',
        caption: 'Desa / Kelurahan',
        dataType: 'string',
      },
      {
        dataField: 'kecamatan',
        caption: 'Kecamatan',
        dataType: 'string',
      },
      {
        dataField: 'kab_kota',
        caption: 'Kab / Kota',
        dataType: 'string',
      },
      {
        dataField: 'provinsi',
        caption: 'provinsi',
        dataType: 'string',
      },
      {
        dataField: 'status_bantuan',
        caption: 'Status Bantuan',
        dataType: 'string',
      },
      {
        dataField: 'thn_bantuan',
        caption: 'Tahun Bantuan',
        dataType: 'number',
      },
  ];


  var nmField_dataset = [
    {
      type: 'buttons',
      buttons: ['edit', 'delete'],
    },
    {
      dataField: 'id',
      dataType: 'number',
      allowEditing: 0,
    },
    {
      dataField: 'name',
      caption: 'Name',
      dataType: 'string',
    },
    {
      dataField: 'status',
      caption: 'Status',
      lookup: {
        dataSource: status_table,
        displayExpr: 'Name',
        valueExpr: 'Name',
      },
    },
    {
      dataField: 'type',
      caption: 'Type',
      dataType: 'string',
      allowEditing: 0,
    },
    // {
    //   dataField: 'color_palette',
    //   caption: 'Color Palette',
    //   lookup: {
    //     dataSource: color_palette,
    //     displayExpr: 'Name',
    //     valueExpr: 'Name',
    //   },
    // },
    {
        dataField: 'roles',
        caption: 'Roles',
        lookup: {
          dataSource: roles_table,
          displayExpr: 'Name',
          valueExpr: 'Name',
        },
      },
     
  ];

