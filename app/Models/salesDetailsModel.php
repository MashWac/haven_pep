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
    public function book()
    {
        return $this->belongsTo(BooksModel::class, 'item_id');
    }

    public function course()
    {
        return $this->belongsTo(coursesModel::class, 'item_id');
    }
    public function sale()
    {
        return $this->belongsTo(salesModel::class, 'sale_id', 'id');
    }
}
