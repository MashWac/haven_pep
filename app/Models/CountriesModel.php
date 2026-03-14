<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountriesModel extends Model
{
    use HasFactory;
    protected $table='countries';
    protected $primaryKey='id';
    protected $fillable=['iso','name', 'nicename','sub_continent','continent','iso3','numcode','phone_code','flag','currency','updated_at'];
}
