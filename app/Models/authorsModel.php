<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class authorsModel extends Model
{
    //
    protected $table = 'authors';
    protected $fillable = [
        'full_name',
        'biography',
        'created_at',
        'updated_at',
        'image',
        'status'
    ];
}
