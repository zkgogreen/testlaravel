<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorList extends Model
{
    use HasFactory;
    protected $table = 'color_list';

    protected $fillable = [ 
        'id',
        'id_palette', 
        'color', 
        'created_at',
        'updated_at',
    ];

    public function palette(){
        return $this->belongsTo(ColorPalette::class, 'id_palette',  'id');
    }
}
