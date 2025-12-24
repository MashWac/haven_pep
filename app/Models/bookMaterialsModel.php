<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bookMaterialsModel extends Model
{
    //
    protected $table = 'book_material';
    protected $fillable = [
        'book_url',
        'document_type',
        'book_id',
        'created_at',
        'updated_at',
        'status'    
    ];
}
