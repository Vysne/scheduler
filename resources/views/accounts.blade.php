<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    'resources/sass/filter.scss', 'resources/js/filter.js',
    'resources/sass/calendar.scss', 'resources/js/calendar.js'
    ])

</head>
<body>
<div class="app">
    <x-sidebar-layout></x-sidebar-layout>
    <div class="catalog-wrap">
        <x-navbar-layout></x-navbar-layout>
        <table class="table align-middle mb-0 bg-white" id="enlistments-table">
            <thead class="bg-light">
            <tr>
                <th>Google accounts</th>
            </tr>
            </thead>
            <tbody>
            @foreach($accounts as $account)
                <tr>
                    <td>
                        <div class="enlistment-status-wrap yellow">
                            <p class="fw-normal mb-1">{{ ucfirst($account['email']) }}</p>
                        </div>
                        <a href="{{ route('google.destroy', [$account['email']]) }}" class="course-page-link">
                            Delete
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
        <iframe src="https://calendar.google.com/calendar/embed?src={{ strstr($account['email'], '@', true) }}%40gmail.com&ctz=Europe%2FVilnius" style="border: 0" width="auto" height="800" frameborder="0" scrolling="no"></iframe>
        @endforeach
        <x-application-modal-layout></x-application-modal-layout>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.6/index.global.min.js'></script>
</body>
