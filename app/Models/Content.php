<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'id',
        'section', 
        'title',
        'description', 
        'type',
        'layer',
        'icon',
        'created_at',
        'updated_at',
    ];
}
