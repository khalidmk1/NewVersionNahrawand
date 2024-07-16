<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapCities extends Model
{
    use HasFactory;

    protected $fillable = [
        'city',
        'lat',
        'lng',
        'country',
        'iso2',
        'admin_name',
        'capital',
        'population',
        'population_proper'
    ];

}
