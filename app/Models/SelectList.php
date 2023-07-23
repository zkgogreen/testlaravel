<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectList extends Model
{
    use HasFactory;
    protected $table = 'select_list';
    protected $fillable = [ 
        'id',
        'table', 
        'column', 
        'form_type',
        'value_list',
        'created_at',
        'updated_at',
    ];
}
