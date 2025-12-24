<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class courseMaterialsModel extends Model
{
    //
    protected $table = 'course_material';
    protected $fillable = [
        'course_url',
        'document_type',
        'course_id',
        'created_at',
        'updated_at',
        'status'    
    ];
}
