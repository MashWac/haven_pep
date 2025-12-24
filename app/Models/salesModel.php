<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class salesModel extends Model
{
    //
        protected $table = 'sales';
    protected $fillable = [
        'number_of_items',
        'user_id',
        'payment_method',
        'receipt_number',
        'transaction_reference',
        'total_price',
        'payment_id',
        'status_payment',
        'delivery_method',
        'delivery_status',
        'delivery_address',
        'contact_number',
        'created_at',
        'updated_at',
        'status'
    ];
}
