<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbPb extends Model
{
    use HasFactory;

    protected $table = 'tb_pb';
    protected $fillable = [
        'id',
        'id_desa',
        'alamat',
        'desa',
        'kecamatan',
        'kab_kota',
        'provinsi',
        'longitude',
        'latitude',
        'nama',
        'alamat',
        'telepon',
        'email',
        'jenis_usaha',
        'produk',
        'nama_pic',
        'kontak_pic',
        'pengusul',
        'keterangan',
        'thn_bantuan',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [];
}
