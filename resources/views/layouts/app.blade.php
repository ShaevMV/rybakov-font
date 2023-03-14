<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script defer src="https://use.fontawesome.com/releases/v5.4.1/js/all.js" integrity="sha384-L469/ELG4Bg9sDQbl0hvjMq8pOcqFgkSpwhwnslzvVVGpDjYJ6wJJyYjvG3u8XW7" crossorigin="anonymous"></script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Рыбаков фонт</title>

    <!-- Styles -->
    <link href="{{ asset('/css/app.css?' . md5_file( public_path() . '/css/app.css' )  )}}" rel="stylesheet">
</head>
<body>
    <span id="app">
        @yield('content')
    </span>
    <!-- Scripts -->
    <script src="{{ asset('/js/app.js?' . md5_file( public_path() . '/js/app.js' ) )}}"></script>
</body>
</html>
