<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ mix('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="dns-prefetch" href="//pixelfed.nyc3.cdn.digitaloceanspaces.com">
    <link rel="dns-prefetch" href="//use.fontawesome.com">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @stack('styles')

    <style type="text/css">
        body, button, input, textarea {
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",
                         Roboto,Helvetica,Arial,sans-serif;
        }
    </style>
</head>
<body>
    <div id="app">
    @include('layouts.partial.nav')
            @yield('content')
    </div>
</body>
</html>
