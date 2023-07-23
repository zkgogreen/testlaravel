<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorPalette extends Model
{
    use HasFactory;
    protected $table = 'color_palettes';

protected $fillable = [ 
    'id',
    'title', 
    'description', 
    'created_at',
    'updated_at',
];

protected $hidden = [

];


public function color(){
    return $this->hasMany(ColorList::class, 'id_palette',  'id');
}
}