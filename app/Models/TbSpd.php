<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbSpd extends Model
{
    use HasFactory;
    protected $table = 'tb_spd';
    protected $fillable = [
        'id',
        'kode_bps', 
        'keldes', 
        'kecamatan',
        'kabkot', 
        'provinsi', 
        'nama', 
        'seluler',
        'elektrifikasi',
        'akses_jalan',
        'jumlah_penduduk',
        'jumlah_kk',
        'pendapatan',
        'jumlah_umkm',
        'komunitas',
        'dana_desa',
        'pemerintah_desa',
        'bumdes',
        'pencaharian',
        'jenis_umkm',
        'pic',
        'keterangan',
        'thn_survey',
        'potensi',
        'foto1',
        'foto2',
        'foto3',
        'foto4',
        'foto5',                        
        'created_at',
        'updated_at',
    ];

    protected $hidden = [

    ];
}
