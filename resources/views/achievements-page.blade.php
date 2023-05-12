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

    <!-- Quil textarea -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    @vite([
    'resources/sass/app.scss', 'resources/js/app.js',
    'resources/sass/navbar.scss', 'resources/js/navbar.js',
    'resources/sass/sidebar.scss', 'resources/js/sidebar.js',
    'resources/sass/login.scss', 'resources/js/login.js',
    'resources/sass/content.scss', 'resources/js/content.js',
    'resources/sass/page-title.scss',
    'resources/sass/filter.scss',
    'resources/sass/achievement.scss', 'resources/js/achievement.js'
    ])

</head>
<body>
<div class="app">
    <x-sidebar-layout></x-sidebar-layout>
    <div class="catalog-wrap">
        <x-navbar-layout></x-navbar-layout>
        <x-page-title-layout></x-page-title-layout>
        <div class="content-container">
            <div class="courses-container">
                <ul class="course-box">
                    @foreach($achievements as $achievement)
                        <x-achievement-modal-layout :achievement="$achievement"></x-achievement-modal-layout>
                        <li>
                            <div class="course-card" data-type="">
                                <a data-toggle="modal" data-target="#{{ $achievement->user_id }}userAchievementModal">
                                    <div class="course-image">
                                        <img src="{{ asset($achievement->image) }}">
                                    </div>
                                    <div class="course-tags">
                                        <div class="course-tag">
                                            <span>{{ $achievement->type }}</span>
                                        </div>
                                    </div>
                                </a>
                                <div class="course-content">
                                    <div class="course-title">
                                        <h3>{{ $achievement->achievement_title }}</h3>
                                    </div>
                                    <div class="course-creator">
                                        <p>{{ $achievement->course_name }}</p>
                                    </div>
                                    <div class="course-creator">
                                        <span>{{ $achievement->achievement_creator }}</span>
                                    </div>
                                    <div class="course-creator">
                                        <span>{{ date('M d, Y', strtotime($achievement->created_at)) }}</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="content-pagination-container">
                {{ $achievements->links() }}
            </div>
        </div>
    </div>
    <x-application-modal-layout></x-application-modal-layout>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/ol@v7.2.2/dist/ol.js"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="https://cdn.jsdelivr.net/gh/AmagiTech/JSLoader/amagiloader.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
