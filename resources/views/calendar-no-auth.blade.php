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
    'resources/sass/filter.scss', 'resources/js/filter.js',
    'resources/sass/calendar.scss', 'resources/js/calendar.js'
    ])

</head>
<body>
<div class="app">
    <x-sidebar-layout></x-sidebar-layout>
    <div class="catalog-wrap">
        <x-navbar-layout></x-navbar-layout>
        <div class="flex items-center justify-end mt-4">
            <a href="{{ url('google/oauth') }}">
                <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" style="margin-left: 3em;">
            </a>
        </div>
        {{--        <div id="calendar"></div>--}}
{{--                <div class="add-calendar-event-wrap">--}}
{{--                    <button type="button" data-toggle="modal" data-target="#calendarEventAddModal">--}}
{{--                        <i class="fa fa-calendar-o" aria-hidden="true"></i>--}}
{{--                        &nbsp;--}}
{{--                        <span>New event</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
        {{--        <x-calendar-form-layout></x-calendar-form-layout>--}}
        {{--        <iframe src="https://outlook.live.com/calendar/0/published/00000000-0000-0000-0000-000000000000/3064dcfa-4e78-4c74-9117-1694f37a4492/cid-B3E44109C35D337F/calendar.html" width="100%" height="100%"></iframe>--}}
        {{--    </div>--}}
        <x-application-modal-layout></x-application-modal-layout>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.6/index.global.min.js'></script>

    <script>

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth'
            });
            calendar.render();
        });

    </script>

</body>
