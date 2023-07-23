<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbKp extends Model
{
    protected $table = 'tb_kp';
    use HasFactory;
    protected $fillable = [
        'kode_bps', 
        'keldes', 
        'kecamatan',
        'kabkot', 
        'provinsi', 
        'jenis_kawasan', 
        'status_3t', 
        'lokpri', 
        'keterangan', 
        'created_at',
        'updated_at',
    ];

    protected $hidden = [

    ];
}
