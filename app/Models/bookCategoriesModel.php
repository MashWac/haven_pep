<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bookCategoriesModel extends Model
{
    //
    protected $table = 'book_categories';
    protected $fillable = [
        'category_name',
        'created_at',
        'updated_at',
        'status'
    ];
}
