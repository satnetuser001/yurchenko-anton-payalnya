<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\WeatherCache;
use Carbon\Carbon;

class WeatherWithCacheService
{
    protected $objectWeather = null;
    /**
     * Get current weather from cache or API or false.
     */
    public function get($city)
    {
        //look at the cache
        $this->objectWeather = $this->cacheGet($city);

        //if there is a non-expired cache - return
        if (
            $this->objectWeather
            //if less than a minute has passed since the last data update
            && (Carbon::parse($this->objectWeather->updated_at)->diffInMinutes(Carbon::now()) < 1)
        ) {
            return $this->objectWeather;
        }

        //if it is not in the cache or expired - take it from the API
        $apiWeather = $this->api($city);

        //if there is success with the API - cache and return
        if (array_key_exists('current', $apiWeather)) {
            $this->cachePut($city, $apiWeather['current']);
            return $this->objectWeather;
        }

        //if there is a failure with the API, return the old data or null
        return $this->objectWeather;
    }

    /**
     * Get cache from database.
     */
    protected function cacheGet($city)
    {
        return WeatherCache::where('city', $city)->first();

    }

    /**
     * Put the cache in the database and update the object.
     */
    protected function cachePut($city, $apiWeather)
    {
        //update existing tuple
        if ($this->objectWeather) {
            $this->objectWeather->fill([
                'temp_c'=>$apiWeather['temp_c'],
                'feelslike_c'=>$apiWeather['feelslike_c'],
                'wind_kph'=>$apiWeather['wind_kph'],
                'pressure_mb'=>$apiWeather['pressure_mb'],
                'humidity'=>$apiWeather['humidity'],
                'precip_mm'=>$apiWeather['precip_mm'],
                'updated_at' => now(),
            ]);

            //if the data has not changed but need to update the date
            if (!$this->objectWeather->isDirty()) {
                $this->objectWeather->touch();
            //if the data has changed
            } else {
                $this->objectWeather->save();
            }

        //create a new tuple
        } else {
            $this->objectWeather = WeatherCache::create([
                'city'=>$city,
                'temp_c'=>$apiWeather['temp_c'],
                'feelslike_c'=>$apiWeather['feelslike_c'],
                'wind_kph'=>$apiWeather['wind_kph'],
                'pressure_mb'=>$apiWeather['pressure_mb'],
                'humidity'=>$apiWeather['humidity'],
                'precip_mm'=>$apiWeather['precip_mm'],
            ]);
        }
        
    }

    /**
     * Get weather data from API.
     */
    protected function api($city)
    {
        $transliteratedCity = $this->transliterateUkrainianCity($city);

        $apiRequestPrefix = 'http://api.weatherapi.com/v1/current.json?key=ed6cd218108345baae2143436241211&q=';
        $apiRequestSuffix = '&aqi=no';
        $apiResponse = Http::get($apiRequestPrefix . $transliteratedCity . $apiRequestSuffix);

        return $apiResponse->json();
    }

    /**
     * Transliterate Ukrainian city to English language.
     */
    protected function transliterateUkrainianCity($city)
    {
        //convert to lower case
        $city = mb_strtolower($city);

        //transliteration rules
        $cyr = ['а', 'б', 'в', 'г', 'ґ', 'д', 'е', 'є', 'ж', 'з', 'и', 'і', 'ї', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ь', 'ю', 'я'];
        $lat = ['a', 'b', 'v', 'h', 'g', 'd', 'e', 'ie', 'zh', 'z', 'y', 'i', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'kh', 'ts', 'ch', 'sh', 'shch', '', 'iu', 'ia'];

        //replacing letters according to the rules
        $transliteratedCity = strtr($city, array_combine($cyr, $lat));

        return $transliteratedCity;
    }
}
