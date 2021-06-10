<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>
    <link type="image/jpg" href="{{ asset('images/favicon.png') }}" rel="shortcut icon"/>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('css')
</head>
@yield('content')
<script src="{{ App::environment() == 'local' ? asset('js/app.js') : asset('js/app.min.js') }}"
        type="text/javascript"></script>
@stack('early_js')
@stack('js')
</html>
