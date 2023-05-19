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
        @if(!empty($courses))
            <div class="content-container">
                <div class="courses-container">
                    <ul class="course-box">
                        @foreach($courses as $course)
                            {{ dd($course) }}
                            <li>
                                <div class="course-card" data-type="{{ $course->type }}">
                                    <a href="{{ url('course-single/' . $course->id) }}">
                                        <div class="course-image">
                                            <img src="{{ asset($course->image) }}">
                                        </div>
                                        <div class="course-tags">
                                            <div class="course-tag">
                                                <span>{{ $course->type }}</span>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="course-content">
                                        <div class="course-title">
                                            <h3>{{ $course->course_name }}</h3>
                                        </div>
                                        <div class="course-creator">
                                            <span>{{ $course->name }}</span>
                                        </div>
                                        <div class="course-rating">
                                            <span class="fa fa-star star-checked"></span>
                                            <span class="fa fa-star star-checked"></span>
                                            <span class="fa fa-star star-checked"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <p>(2354)</p>
                                        </div>
                                        <div class="course-join">
                                            @if ($course->author != Auth::id() && array_key_exists($course->id, $availability) == false)
                                                <form action="{{ url('/join/' . $course->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit">
                                                        <div class="course-join-icon">
                                                            <i></i>
                                                            <span>Join course</span>
                                                        </div>
                                                    </button>
                                                </form>
                                            @elseif (array_key_exists($course->id, $availability) == true)
                                                @if($availability[$course->id] !== 'accepted')
                                                    <button type="submit">
                                                        <div class="course-join-icon">
                                                            <i></i>
                                                            <span>{{ ucfirst($availability[$course->id]) }}</span>
                                                        </div>
                                                    </button>
                                                @else
                                                    <button type="submit">
                                                        <div class="course-join-icon">
                                                            <i></i>
                                                            <span>Already joined</span>
                                                        </div>
                                                    </button>
                                                @endif
                                            @else
                                                <button type="submit">
                                                    <div class="course-join-icon">
                                                        <i></i>
                                                        <span>Already joined</span>
                                                    </div>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="content-pagination-container">
                    {{ $courses->appends(request()->all())->links() }}
                </div>
            </div>
            <div class="post-list">
                <p>{{ $course->course_name }}</p>
                <img src="{{ $course->image }}">
            </div>
        @else
            <div>
                <h2>No posts found</h2>
            </div>
        @endif
    </div>
    <x-application-modal-layout></x-application-modal-layout>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
