<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class courseProgressModel extends Model
{
    //
    protected $table = 'user_course_progress';
    protected $fillable = [
        'user_id',
        'course_id',
        'lesson_number',
        'created_at',
        'updated_at',
        'status'
    ];
}
