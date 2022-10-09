<!DOCTYPE html>
    <html lang="en" class="notranslate" translate="no">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-touch-fullscreen" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="default">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="theme-color" content="#FFFFFF"> 
        <meta name="description" content="">
        <meta name="google" content="notranslate" />
        @vite(['resources/css/app.css'])
        

        @yield('specific_stylesheets')

        @livewireStyles
        
        <title>{{ config('app.name') }} {{ config('app.subtitle') }} | @yield('title')</title>

    </head>
    <body>
        @yield('content')
        @vite(['resources/js/app.js'])
        @yield('specific_scripts')

        @livewireScripts
    </body>
</html>
