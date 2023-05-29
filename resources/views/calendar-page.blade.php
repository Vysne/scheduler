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
    'resources/sass/filter.scss',
    'resources/sass/calendar.scss', 'resources/js/calendar.js'
    ])

</head>
<body>
<div class="app">
    <x-sidebar-layout></x-sidebar-layout>
    <div class="catalog-wrap">
        <x-navbar-layout></x-navbar-layout>
{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            <a href="{{ url('google/oauth') }}">--}}
{{--                <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" style="margin-left: 3em;">--}}
{{--            </a>--}}
{{--        </div>--}}
        <table class="table align-middle mb-0 bg-white" id="enlistments-table">
            <thead class="bg-light">
            <tr>
                <th>Google account</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="enlistment-status-wrap yellow">
                            <p class="fw-normal mb-1">{{ $accounts->email }}</p>
                        </div>
                        <div class="event-create-wrap">
                            <a href="{{ route('google.destroy', [$accounts->email]) }}" class="course-page-link">
                                Log out
                            </a>
                            <div class="add-calendar-event-wrap">
                                <button type="button" data-toggle="modal" data-target="#calendarEventAddModal">
                                    <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                    &nbsp;
                                    <span>New event</span>
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="content-calendar">
            <table class="table align-middle mb-0 bg-white" id="enlistments-table">
                <thead class="bg-light">
                <tr>
                    <th>Calendar events</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
{{--                {{ dd($events) }}--}}
                @foreach($events['items'] as $event)
                    @if (isset($event['summary']))
                        <tr>
                            <td>
                                <div class="event-summary">
                                    <input type="hidden" value="{{ $event['id'] }}" name="event_id">
                                    <div class="event-link-wrap">
                                        <a href="{{ $event['htmlLink'] }}">
                                            <p class="fw-normal mb-1">{{ $event['summary'] }}</p>
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons-wrap">
                                    <button class="event-update-button" type="submit" data-toggle="modal" data-target="#{{ $event['id'] }}calendarEventEditModal">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </button>
                                    <form action="{{ url('api/google/update/' . $event['id']) }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal fade-scale event-edit-modal" id="{{ $event['id'] }}calendarEventEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">New event</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="event-title-wrap">
                                                            <input type="text" id="event-title" name="summary" value="{{ $event['summary'] }}" placeholder="Title" required>
                                                        </div>
                                                        <div class="event-location-wrap">
                                                            <input type="text" id="event-location" name="location" placeholder="&#xf041; Location" required>
                                                        </div>
                                                        <div class="event-description-wrap">
                                                            <textarea id="event-description" name="description" placeholder="Description"></textarea>
                                                        </div>
                                                        <div class="event-start-wrap">
                                                            <div class="event-date-wrap">
                                                                <input type="date" id="event-start-date" name="event-start-date" value="{{ strstr(array_values($event['start'])[0], 'T', true) }}" required>
                                                            </div>
                                                            <div class="event-time-wrap">
                                                                <input type="time" id="event-start-time" name="event-start-time" value="{{ str_replace('T', '', strstr(strstr(array_values($event['start'])[0], 'T'), '+', true)) }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="event-end-wrap">
                                                            <div class="event-date-wrap">
                                                                <input type="date" id="event-start-date" name="event-end-date" value="{{ strstr(array_values($event['end'])[0], 'T', true) }}" required>
                                                            </div>
                                                            <div class="event-time-wrap">
                                                                <input type="time" id="event-start-time" name="event-end-time" value="{{ str_replace('T', '', strstr(strstr(array_values($event['end'])[0], 'T'), '+', true)) }}" required>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="timeZone" value="Europe/Vilnius">
                                                        <input type="hidden" name="userId" value="{{ auth()->id() }}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
{{--                                    <x-calendar-edit-form-layout :events="$events"></x-calendar-edit-form-layout>--}}
                                    &nbsp;
                                    <form action="{{ url('/api/google/delete/' . $event['id']) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <input name="userId" type="hidden" value="{{ auth()->id() }}">
                                        <button class="event-delete-button" type="submit">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
            <iframe src="https://calendar.google.com/calendar/embed?src={{ strstr($accounts->email, '@', true) }}%40gmail.com&ctz=Europe%2FVilnius" style="border: 0" width="auto" height="800" frameborder="0" scrolling="no"></iframe>
        </div>
    </div>
    <x-application-modal-layout></x-application-modal-layout>
    <x-calendar-form-layout :events="$events"></x-calendar-form-layout>
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
