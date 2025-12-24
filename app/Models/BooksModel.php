<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BooksModel extends Model
{
    //
    protected $table = 'books';
    protected $fillable = [
        'book_name',
        'sub_title',
        'isbn',
        'description',
        'author',
        'pricing',
        'discount',
        'category_id',
        'image',
        'created_at',
        'updated_at',
        'status'
    ];
}
