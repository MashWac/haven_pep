<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CombosModel extends Model
{
    //
    protected $table = 'combos';
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'items_included',
        'discount_percentage',
        'created_at',
        'updated_at',
        'status'
    ];
}
