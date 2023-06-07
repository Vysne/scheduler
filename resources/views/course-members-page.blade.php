<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Quil textarea -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    @vite([
    'resources/sass/app.scss', 'resources/js/app.js',
    'resources/sass/navbar.scss', 'resources/js/navbar.js',
    'resources/sass/sidebar.scss', 'resources/js/sidebar.js',
    'resources/sass/page-title.scss',
    'resources/sass/notifiers.scss', 'resources/js/notifiers.js',
    'resources/sass/table.scss', 'resources/js/table.js',
    'resources/sass/courseMembers.scss', 'resources/js/courseMembers.js',
    'resources/js/achievementForm.js'
    ])

</head>
<body>
@auth
<div class="app">
    <x-sidebar-layout></x-sidebar-layout>
    <div class="catalog-wrap">
        <x-navbar-layout></x-navbar-layout>
        <x-page-title-layout></x-page-title-layout>
        <div class="table-switch-wrap">
            <button type="button" id="enlistment-button">
                <span>Enlistments</span>
            </button>
            &nbsp;
            <button type="button" id="members-button" class="active">
                <span>Course members</span>
            </button>
        </div>
        <div class="course-limit-wrap">
            <form action="{{ url('/members/' . $course->id . '/update-limit') }}" method="POST">
                @csrf
                <span>Course limit:</span>
                &nbsp;
                <input type="number" id="course-limit" value="{{ $course->limit }}" name="course-limit" min="0" max="100">
                &nbsp;
                <button type="submit" class="limit-update-button">Update</button>
            </form>
        </div>
        <table class="table align-middle mb-0 bg-white" id="enlistments-table" hidden>
            <thead class="bg-light">
                <tr>
                    <th>User Name</th>
                    <th>Course</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($enlistments as $enlistment)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <a href="#" class="user-profile-link" data-toggle="modal" data-target="#{{ $enlistment['user_id'] }}userProfileModal" style="pointer-events: all; cursor: pointer;">
                                @if($enlistment['user-image'] != 'user-profile.svg')
                                <img
                                    src="{{ asset($enlistment['user-image']) }}"
                                    alt=""
                                    style="width: 45px; height: 45px"
                                    class="rounded-circle"
                                />
                                @else
                                    <img
                                        src="{{ asset('/img/' . $enlistment['user-image']) }}"
                                        alt=""
                                        style="width: 45px; height: 45px"
                                        class="rounded-circle"
                                    />
                                @endif
                                <div class="ms-3" style="display: flex; align-items: center">
                                    <p class="fw-bold mb-1">{{ $enlistment['name'] }}</p>
                                </div>
                            </a>
                            <x-user-profile-modal-layout :enlistment="$enlistment"></x-user-profile-modal-layout>
                        </div>
                    </td>
                    <td>
                        <a href="{{ url('course-single/' . $enlistment['id']) }}" class="course-page-link">
                            {{ $enlistment['course_name'] }}
                        </a>
                    </td>
                    <td>
                        @if($enlistment['status'] == 'processing')
                        <div class="enlistment-status-wrap yellow">
                            <p class="fw-normal mb-1">{{ ucfirst($enlistment['status']) }}</p>
                        </div>
                        @elseif($enlistment['status'] == 'accepted')
                            <div class="enlistment-status-wrap green">
                                <p class="fw-normal mb-1">{{ ucfirst($enlistment['status']) }}</p>
                            </div>
                        @else
                            <div class="enlistment-status-wrap red">
                                <p class="fw-normal mb-1">{{ ucfirst($enlistment['status']) }}</p>
                            </div>
                        @endif
                    </td>
                    <td>
                        <p class="fw-normal mb-1">{{ date('M d, Y', strtotime($enlistment['created_at'])) }}</p>
                    </td>
                    <td style="display: table-cell">
                        @if($enlistment['status'] != 'accepted' && $enlistment['status'] != 'declined')
                            <div class="action-buttons-wrap">
                                <form action="{{ url('/members/' . $enlistment['id'] . '/accept/' . $enlistment['user_id']) }}" method="POST">
                                    @csrf
                                    <button type="submit" id="disable-button" onclick="visibilityAction(this)">
                                        <i class="fa fa-check ql-color-blue" aria-hidden="true"></i>
                                    </button>
                                </form>
                                <form action="{{ url('/members/' . $enlistment['id'] . '/decline/' . $enlistment['user_id']) }}" method="POST">
                                    @csrf
                                    <button type="submit" id="disable-button" onclick="visibilityAction(this)">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <table class="table align-middle mb-0 bg-white" id="members-table">
            <thead class="bg-light">
            <tr>
                <th>User Name</th>
                <th>Course</th>
                <th>Progress</th>
                <th>Join Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($members as $member)
                <x-achievement-form-modal-layout :member="$member"></x-achievement-form-modal-layout>
                <x-message-form-modal-layout :member="$member"></x-message-form-modal-layout>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <a class="user-profile-link" id="disable-button" data-toggle="modal" data-target="#{{ $member['user_id'] }}userProgressModal" style="pointer-events: all; cursor: pointer;">
                                @if($member['user-image'] != 'user-profile.svg')
                                    <img
                                        src="{{ asset($member['user-image']) }}"
                                        alt=""
                                        style="width: 45px; height: 45px"
                                        class="rounded-circle"
                                    />
                                @else
                                    <img
                                        src="{{ asset('/img/' . $member['user-image']) }}"
                                        alt=""
                                        style="width: 45px; height: 45px"
                                        class="rounded-circle"
                                    />
                                @endif
                                <div class="ms-3" style="display: flex; align-items: center; font-size: 1rem;">
                                    <p class="fw-bold mb-1">{{ $member['name'] }}</p>
                                </div>
                            </a>
                            <x-course-member-progress-modal-layout :memberId="$member['user_id']" :courseId="$member['id']"></x-course-member-progress-modal-layout>
                        </div>
                    </td>
                    <td style="width: 30%">
                        <a href="{{ url('course-single/' . $member['id']) }}" class="course-page-link">
                            {{ $member['course_name'] }}
                        </a>
                    </td>
                    <td>
                        <div class="progress-bar-wrapper">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ $member['progress'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $member['progress'] }}%"></div>
                            </div>
                            <span>{{ $member['progress'] }}%</span>
                        </div>
                    </td>
                    <td>
                        <p class="fw-normal mb-1">{{ date('M d, Y', strtotime($member['updated_at'])) }}</p>
                    </td>
                    <td style="display: table-cell">
                        <div class="action-buttons-wrap">
                            <a href="#" id="disable-button" data-toggle="modal" data-target="#{{ $member['user_id'] }}achievementModal">
                                <i class="fa fa-certificate" aria-hidden="true"></i>
                            </a>
                            <a href="#" id="disable-button" data-toggle="modal" data-target="#{{ $member['user_id'] }}messageModal">
                                <i class="fa fa-commenting" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('/members/' . $course->id . '/drop/' . $member['user_id']) }}" id="disable-button">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <x-application-modal-layout></x-application-modal-layout>
    </div>
</div>
@endauth
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/ol@v7.2.2/dist/ol.js"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="https://cdn.jsdelivr.net/gh/AmagiTech/JSLoader/amagiloader.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
    function closeModal(button) {
        let input = button.parentElement.previousElementSibling.firstElementChild.lastElementChild;
        let quillEditor = button.parentElement.previousElementSibling.querySelector('.ql-editor');

        input.value = '';
        quillEditor.innerHTML = '';
    }
</script>
</body>
</html>
