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

        $url = "https://weather.cc.api.here.com/weather/1.0/report.json";
        $params = $this->setApiRequest($data);
        $forecast = '';

        try
        {
            $response = $this->connect($url, $params);
            
            if($response->successful())
            {
                $object = json_decode($response->getBody());
                $forecast = $object->dailyForecasts->forecastLocation;
            }
        }
        catch(Exception $e)
        {
            throw($e);
        }

        return [
            'forecast' => $forecast,
            'city' => $city
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
     * @param string $city
     * @return array
     */
    protected function setApiRequest($city): array
    {
        return [
            'product' => 'forecast_7days_simple',
            'name' => $city,
            'language' => 'en-US',
            'apiKey' => config('weather.app_key'),
            'app_id' => config("weather.app_id")
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
        return Http::get($url, $params);
    }
}