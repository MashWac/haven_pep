<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstructorModel extends Model
{
    //
    protected $table = 'instructors';
    protected $fillable = [
        'full_name',
        'email_address',
        'phone_number',
        'job_title',
        'about_me',
        'image',
        'created_at',
        'updated_at',
        'status'
    ];
    
}
