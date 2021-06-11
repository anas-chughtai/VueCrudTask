<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'VUE Crud') | VUE Crud</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        {{--<link rel="stylesheet"
              href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">--}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 150vh;
                margin: 0;
            }
        </style>
        @yield('styles')
    </head>
    <body>
        <div class="container mt-5">
            @yield('content')
        </div>
{{--        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>--}}
{{--        <script type="text/javascript" src="./js/app.js"></script>--}}
        @yield('scripts')
    </body>
</html>
