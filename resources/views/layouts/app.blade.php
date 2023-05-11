<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Warngel | {{ $title }}</title>
    @include('layouts.link')
  
</head>
<body>
    <div id="app">
      
        @include('partials.navbar')
        @include('partials.offcanvas')
        <main class="pb-4 mt-5 pt-4">
            
            @yield('content')
        </main>
        
        @include('user.partials.footer')
    </div>
</body>
@include('layouts.script')
</html>
