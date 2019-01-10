<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'location_name',
        'location_province',
        'location_address',
        'location_photo'
    ];
}
