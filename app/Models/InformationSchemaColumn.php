<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformationSchemaColumn extends Model
{
    use HasFactory;
    protected $table = 'information_schema.columns';
    

    protected $fillable = [ 
        'column_name',
        'table_name', 
        'data_type', 
        'is_nullable',
        'created_at',
        'updated_at',
    ];

    public function tableName(){
        return $this->belongsTo(ColorPalette::class, 'table_name',  'title');
    }
}
