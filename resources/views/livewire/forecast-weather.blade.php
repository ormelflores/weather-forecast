<div>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8" x-data="{city: ''}" x-cloak>
        <div class="bg-gray-800 py-8 px-2 shadow sm:rounded-lg sm:px-10">
            <form wire:submit.prevent="search">
                <x-input.text
                    type="text"
                    wire:model.defer="city"
                    label="Type City"
                    value="{{$city}}"
                    x-model="city"
                    maxlength="180">
                </x-input.text>
                <x-buttons.inline-flex.info type="submit">Find Forecast</x-buttons.inline-flex.info>
            </form>
        </div>
        @if(filled($forecast))
            <div class="lg:text-center">
                <p class="mt-2 text-3xl font-bold leading-8 tracking-tight sm:text-4xl">{{ $forecast['city']->name }} - {{ $forecast['city']->country }}</p>
                
                <p class="mt-4 max-w-2xl text-xl text-white lg:mx-auto">Week's Forecast</p>
            </div>

            <div class="grid gap-4 mb-8 md:grid-cols-7 xl:grid-cols-4 mt-4">
                @if(count($forecast['list']) > 0)
                    @foreach(collect($forecast['list'])->groupBy(function ($date) {
                        return date('l, F d', strtotime($date->dt_txt));
                    }) as $key => $data)
                        <x-cards.weather
                            title="{{$key}}"
                            temperature="{{ $data[0]->main->temp }}"
                            icon="https://openweathermap.org/img/wn/{{$data[0]->weather[0]->icon}}.png">
                        </x-cards.weather>
                    @endforeach
                @endif
            </div>
        @else
            <div class="lg:text-center">
                <p class="mt-2 text-3xl font-bold leading-8 tracking-tight sm:text-4xl">City not found.</p>
            </div>
        @endif
    </div>
</div>
