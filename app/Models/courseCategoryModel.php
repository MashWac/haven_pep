<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class courseCategoryModel extends Model
{
    //
    protected $table = 'course_categories';
    protected $fillable = [
        'category_name',
        'description',
        'created_at',
        'updated_at',
        'status'    
    ];
}
