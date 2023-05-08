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
    'resources/sass/profile.scss', 'resources/js/profile.js'
    ])

</head>
<body>
<div class="app">
    <x-sidebar-layout></x-sidebar-layout>
    <div class="catalog-wrap">
        <x-navbar-layout></x-navbar-layout>
        <x-page-title-layout></x-page-title-layout>
        @foreach($user as $data)
            <form action="{{ url('/update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="container">
                    <div class="main-body">
                        <div class="row gutters-sm">
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex flex-column align-items-center text-center">
                                            @if($data['user-image'] == 'user-profile.svg')
                                                <img src="{{ asset('img/' . $data['user-image']) }}" alt="Admin" class="rounded-circle" width="270">
                                            @else
                                                <img src="{{ asset($data['user-image']) }}" alt="Admin" class="rounded-circle" width="270">
                                            @endif
                                            <div id="display-image" hidden></div>
                                            <div class="upload-container" hidden>
                                                <i class="fa fa-upload" aria-hidden="true"></i>
                                                <input type="file" id="file-input" name="profile-img" accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">User Title</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <span>{{ $data['title'] }}</span>
                                                <input type="text" class="profile-input" name="user-name" id="user-name" value="{{ $data['title'] }}" hidden required>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Email</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <span>{{ $data['email'] }}</span>
                                                <input type="text" class="profile-input" name="user-email" id="user-email" value="{{ $data['email'] }}" hidden required>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Status</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <span data-status="static">{{ $data['status'] }}</span>
                                                <input type="hidden" name="user-status" id="user-status" value="{{ $data['status'] }}">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Mobile</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <span>{{ $data['mobile'] }}</span>
                                                <input type="text" class="profile-input" name="user-mobile" id="user-mobile" value="{{ $data['mobile'] }}" hidden required>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Location</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <span data-status="static">{{ $data['location'] }}</span>
                                                <input type="hidden" name="user-location" id="user-location" value="{{ $data['location'] }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body card">
                                <div class="about-me-container">
                                    <h2>About me</h2>
                                    <div id="about-me"></div>
                                    <input type="hidden" id="about-me-descr" name="aboutme-descr-body" value="{{ $data['aboutme-descr-body'] }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="profile-action-buttons">
                            <button type="button" id="edit-button">Edit</button>
                            <button type="submit" id="update-button" hidden>Update</button>
                            <button type="button" id="cancel-button" hidden>Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        @endforeach
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/ol@v7.2.2/dist/ol.js"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
</body>
</html>