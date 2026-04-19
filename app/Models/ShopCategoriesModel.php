<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopCategoriesModel extends Model
{
    protected $table = 'shop_categories';
    protected $fillable = [
        'name',
        'description'
    ];

    public function items()
    {
        return $this->hasMany(ShopItemsModel::class, 'category_id');
    }
}

