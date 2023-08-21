<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Boardify')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" href="{{ asset('logo.png') }}" />
</head>
<body>
    <div id="app"></div>
    @vite('resources/js/app.js')
    <!-- <script src="{{ asset('js/HomeView.vue') }}"></script> -->
</body>
</html>
