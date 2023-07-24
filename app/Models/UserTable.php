<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTable extends Model
{
    use HasFactory;
       protected $fillable = [
        'id',
        'title',
        'table_size',
        'status',
        'type',
        // 'color_palette',
        'created_at',
        'updated_at',
    ];


public function table(){
    return $this->hasMany(InformationSchemaColumn::class, 'table_name',  'title');
}
    
}