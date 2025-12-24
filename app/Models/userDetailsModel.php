<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class userDetailsModel extends Model
{
    //
    protected $table = 'users_details';
    protected $fillable = ['full_name', 'email_address', 'country_code', 'phone_number','token_created_at'];
}
