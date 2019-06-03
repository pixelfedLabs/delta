<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="dns-prefetch" href="//pixelfed.nyc3.digitaloceanspaces.com">
    <link rel="dns-prefetch" href="//use.fontawesome.com">

    <script src="{{ mix('js/app.js') }}" defer></script>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    @yield('content')
</body>
</html>
