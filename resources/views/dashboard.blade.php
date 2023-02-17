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

    @vite(['resources/sass/navbar.scss', 'resources/js/navbar.js', 'resources/sass/sidebar.scss', 'resources/js/sidebar.js'])

</head>
<body>
    <div style="display: flex;">
        <x-sidebar-layout></x-sidebar-layout>
        <x-navbar-layout></x-navbar-layout>
    </div>
</body>

