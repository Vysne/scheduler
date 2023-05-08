<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    @vite([
    'resources/sass/app.scss', 'resources/js/app.js',
    'resources/sass/navbar.scss', 'resources/js/navbar.js',
    'resources/sass/sidebar.scss', 'resources/js/sidebar.js',
    'resources/sass/login.scss', 'resources/js/login.js',
    'resources/sass/content.scss', 'resources/js/content.js',
    'resources/sass/page-title.scss',
    'resources/sass/filter.scss', 'resources/js/filter.js'
    ])

</head>
<body>
    <div class="app">
        <x-sidebar-layout></x-sidebar-layout>
        <div class="catalog-wrap">
            <x-navbar-layout></x-navbar-layout>
            <x-page-title-layout></x-page-title-layout>
            <x-content-filter-layout></x-content-filter-layout>
            <x-content-layout></x-content-layout>
{{--            @guest--}}
{{--                <main>--}}
{{--                    @yield('content')--}}
{{--                </main>--}}
{{--            @endguest--}}
        </div>
        <x-application-modal-layout></x-application-modal-layout>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
