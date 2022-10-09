<?php

namespace App\Http\Livewire;

use App\Actions\GetForecastAction;
use Livewire\Component;

class ForecastWeather extends Component
{
    public $city;

    public function render()
    {
        $data = GetForecastAction::run();
        $this->city = $data['city'];

        return view('livewire.forecast-weather', [
            'forecast' => (array) $data['forecast'],
        ]);
    }

    /**
     * Search
     */
    public function search()
    {
        $data = GetForecastAction::run($this->city);
        
        $this->forecast = blank($data['forecast']) ? '' : (array) $data['forecast'];
    }
}
