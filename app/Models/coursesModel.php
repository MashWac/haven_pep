<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class coursesModel extends Model
{
    //
    protected $table = 'courses';
    protected $fillable = [
        'course_name','course_duration','duration_unit','course_description','no_of_lessons','category_id','cover_image','pricing','discount','created_at','updated_at','status'    
    ];

    }
