<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopItemsModel extends Model
{
    //
    protected $table = 'shop_items';
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'image',
        'discount_percentage',
        'created_at',
        'updated_at',
        'status'
    ];
}
