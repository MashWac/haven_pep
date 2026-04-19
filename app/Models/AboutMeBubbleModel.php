<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutMeBubbleModel extends Model
{
    //
    protected $table = 'about_me_bubble';
    protected $primaryKey = 'id';
    protected $fillable = [
        'rank_position',
        'text',
        'created_at',
        'updated_at',
        'status'
    ];
}
