@extends('layouts.app')

@section('title', 'Weather Forecast')

@section('content')
    <div class="min-h-screen bg-gray-800 text-white">
        <div class="py-12">
            @livewire('forecast-weather')
        </div>
    </div>
@endsection