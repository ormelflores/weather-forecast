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
                <p class="mt-2 text-3xl font-bold leading-8 tracking-tight sm:text-4xl">{{ $forecast['city'] }} - {{ $forecast['state'] }} - {{ $forecast['country'] }}</p>
                
                <p class="mt-4 max-w-2xl text-xl text-white lg:mx-auto">Week's Forecast</p>
            </div>

            <div class="grid gap-4 mb-8 md:grid-cols-7 xl:grid-cols-4 mt-4">
                @if(count($forecast['forecast']) > 0)
                    @foreach ($forecast['forecast'] as $data)
                        <x-cards.weather
                            title="{{$data->weekday}}, {{date('F d', strtotime($data->utcTime))}}"
                            temperature="{{ $data->comfort }}"
                            icon="{{$data->iconLink}}">
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
