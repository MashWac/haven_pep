<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonsModel extends Model
{
    //
    protected $table = 'lessons';
    protected $fillable = [
        'description',
        'lesson_number',
        'lesson_title',
        'course_id',
        'created_at',
        'updated_at',
        'status'
    ];
        public function courseMaterials()
    {
        return $this->hasMany(courseMaterialsModel::class, 'lesson_number', 'lesson_number');
    }
}
