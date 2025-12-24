<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class salesDetailsModel extends Model
{
    //
    protected $table = 'sales_details';
    protected $fillable = [
        'sale_id',
        'item_id',
        'item_type',
        'quantity',
        'price',
        'created_at',
        'updated_at',
        'status'
    ];
}
