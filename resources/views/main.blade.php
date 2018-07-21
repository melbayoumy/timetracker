<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Time Tracker') }}</title>

        <!-- favicon -->
        <link href="{{ asset('favicon.png') }}" rel="shortcut icon">

        <!-- styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- fontawesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    </head>
    <body>
        <div id="app">
            <base-component></base-component>
        </div>

        <script>
            let baseURL = "{{ env('ROOT_URL') }}";
        </script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
