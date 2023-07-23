<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basemap extends Model
{
    protected $table = 'basemap';
    use HasFactory;
    protected $fillable = [
        'id', 
        'variant', 
        'varname',
        'attribution', 
        'status', 
        'created_at',
        'updated_at',
    ];

    protected $hidden = [

    ];
}
