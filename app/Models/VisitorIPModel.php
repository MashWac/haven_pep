<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorIPModel extends Model
{
    //
    protected $table = 'visitor_ips';
    protected $primaryKey = 'id';
    protected $fillable = ['ip', 'location', 'user_id', 'updated_at', 'created_at', 'is_deleted'];
}
