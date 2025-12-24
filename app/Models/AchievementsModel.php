<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AchievementsModel extends Model
{
    //
    protected $table = 'achievements';
    protected $fillable = [
        'instructor_id',
        'achievement',
        'icon',
        'created_at',
        'updated_at',
        'status'
    ];
}
