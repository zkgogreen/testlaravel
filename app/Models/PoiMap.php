<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoiMap extends Model
{
    use HasFactory;
    protected $table = 'tb_poi';
    protected $fillable = [
        'id', 
        'namobj', 
        'remark', 
        'jenis_poi',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [

    ];
}
