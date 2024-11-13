<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeatherCache extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'city',
        'temp_c',
        'feelslike_c',
        'wind_kph',
        'pressure_mb',
        'humidity',
        'precip_mm',
    ];
}
