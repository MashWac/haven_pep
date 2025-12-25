<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class systemSettingsModel extends Model
{
    //
            protected $table = 'system_settings';
    protected $fillable = [
        'setting_name',
        'setting_value',
        'editable',
        'setting_type',
        'created_at',
        'updated_at',
        'status'
    ];
}
