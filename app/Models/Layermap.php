<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layermap extends Model
{
    protected $table = 'layermap';
    use HasFactory;
    protected $fillable = [
        'id',
        'layername',
        'varname',
        'layertype',
        'filename',
        'menutype',
        'table_link',
        'status',
        'status2',
        'visibility',
        'checked',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [];
}
