<?php

namespace App\Actions;

use App\Actions\Traits\AsObject;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Stevebauman\Location\Facades\Location;

class GetForecastAction
{
    use AsObject;

    /**
     * Get weather's forecast within the week.
     * 
     * @param string $city
     * @return array
     */
    public function handle($city = '')
    {
        $default_city = $this->defaultCity();

        $data = filled($city) ? $city : $default_city;
        $location = json_decode($this->getGeoLocation($data));
        $forecast = '';

        if(filled($location))
        {
            $url = "https://api.openweathermap.org/data/2.5/forecast";
            $params = $this->setApiRequest($location[0]);
    
            try
            {
                $response = $this->connect($url, $params);
                
                if($response->successful())
                {
                    $forecast = json_decode($response);
                }
            }
            catch(Exception $e)
            {
                throw($e);
            }
        }

        return [
            'forecast' => $forecast,
            'city' => $data
        ];
    }

    /**
     * Get city name.
     * 
     * Default will only be used if
     * location cannot be pin point
     * via ip address provided.
     * 
     * @return string
     */
    protected function defaultCity(): string
    {
        $city = 'Manila';
        $ip = GetIpAddressAction::run();
        $ip_data = Location::get($ip);

        if($ip_data)
        {
            $city = $ip_data->cityName;
        }

        return $city;
    }

    /**
     * Set api request.
     * 
     * @param mixed $location
     * @return array
     */
    protected function setApiRequest($location): array
    {
        return [
            'lat' => $location->lat,
            'lon' => $location->lon,
            'units' => 'metric',
            'appid' => config('weather.app_key')
        ];
    }

    /**
     * Connect to api.
     * 
     * @param string $url
     * @param array $params
     */
    protected function connect($url, $params)
    {
        return Http::asForm()->get($url, $params);
    }

    /**
     * Coordinates by location name
     * 
     * @param string $city
     */
    protected function getGeoLocation($city)
    {
        return Http::get("http://api.openweathermap.org/geo/1.0/direct", $this->setGeoLocationApiRequest($city));
    }

    /**
     * Set geo location api request.
     * 
     * @param string $city
     * @return array
     */
    protected function setGeoLocationApiRequest($city): array
    {
        return [
            'q' => $city,
            'limit' => 1,
            'appid' => config('weather.app_key')
        ];
    }
}