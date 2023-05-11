<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ Config('app.name') }}</title>
    @include('layouts.link')
    <link rel="stylesheet" href="{{ asset('dist/assets/css/pages/auth.css') }}" />
  
</head>
<body>
    <div id="app">
        <main class="">
            @yield('content')
        </main>
        
    </div>
</body>
</html>
