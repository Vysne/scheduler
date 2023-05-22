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

    <!-- Map -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v7.2.2/ol.css">

    <!-- Quil textarea -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    @vite([
    'resources/sass/app.scss', 'resources/js/app.js',
    'resources/sass/navbar.scss', 'resources/js/navbar.js',
    'resources/sass/sidebar.scss', 'resources/js/sidebar.js',
    'resources/sass/login.scss',
    'resources/sass/content.scss', 'resources/js/content.js',
    'resources/sass/page-title.scss',
    'resources/sass/course.scss', 'resources/js/course.js',
    'resources/sass/map.scss', 'resources/js/map.js',
    'resources/sass/courseSingle.scss', 'resources/js/courseSingle.js'
    ])

</head>
<body>
<div class="app">
    <x-sidebar-layout></x-sidebar-layout>
    <div class="catalog-wrap">
        <x-navbar-layout></x-navbar-layout>
            <div class="course-single-wrapper">
                <div class="course-single-container">
                    @foreach($course['about-course'] as $courseSingleData)
                    <x-course-single-header-layout :availability="$availability" :courseSingleData="$courseSingleData"></x-course-single-header-layout>
                    @if(array_key_exists($courseSingleData['id'], $availability))
                        <input type="hidden" id="enroll-check" value="{{ $availability[$courseSingleData['id']] }}">
                    @else
                        <input type="hidden" id="enroll-check" value="">
                    @endif
                    <div class="course-content-container">
                        <div class="about-course-container">
                            <div class="course-content-title">
                                <h2 id="about-course-part">About course</h2>
                            </div>
                            <div class="about-course-content">
                                <div class="course-content-description">
                                    <h3>{{ $courseSingleData['course_name'] }}</h3>
                                    <div id="course-descr"></div>
                                    <input type="hidden" id="course-descr" name="course-descr-body" value="{{ $courseSingleData['course_descr_body'] }}"/>
                                </div>
                                <div class="course-content-rating">
                                    <span class="fa fa-star star-checked"></span>
                                    <span class="fa fa-star star-checked"></span>
                                    <span class="fa fa-star star-checked"></span>
                                    <span class="fa fa-star"></span>
                                    <span class="fa fa-star"></span>
                                    <p>4/5 stars</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="time-and-location-container">
                            <div class="course-content-title">
                                <h2 id="time-and-location-part">Time & location</h2>
                            </div>

                            <div class="time-and-location-content">
                                <div class="time-content">
                                    <ul>
                                        @foreach($course['course-dates'] as $courseSingleDate)
                                        <li>{{ $courseSingleDate['day'] }} - {{ $courseSingleDate['time'] }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div id="map" class="map">
                                    <div id="popup" class="ol-popup">
                                        <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                                        <a href="#" id="popup-remove" class="ol-popup-remove"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        <div id="popup-content"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="skills-container">
                            <div class="course-content-title">
                                <h2 id="skills-gain-part">Skills you gain</h2>
                            </div>
                            <div class="skills-content">
                                @foreach($course['course-skills'] as $courseSingleSkill)
                                <div class="skills-card">
                                    <span>{{ $courseSingleSkill['skill'] }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="instructor-container">
                            <div class="course-content-title">
                                <h2 id="instructor-part">Instructors</h2>
                            </div>
                            <div class="instructor-content">
                                @foreach($course['course-instructors'] as $courseSingleInstructor)
                                <div class="instructor-card">
                                    <div class="instructor-image">
                                        <img src="{{ asset($courseSingleInstructor['img']) }}" alt="Avatar">
                                    </div>
                                    <div class="about-instructor">
                                        <div id="instructor-descr"></div>
                                        <input type="hidden" name="{{ $courseSingleInstructor['key'] }}" value="{{ $courseSingleInstructor['instructor-descr-body'] }}"/>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="syllabus-container">
                            <div class="course-content-title">
                                <h2 id="syllabus-part">Syllabus</h2>
                            </div>
                            @foreach($course['course-syllabuses'] as $courseSingleSyllabus)
                                @if (auth()->id() == $courseSingleSyllabus['author'] || auth()->id() == '4')
                                    <div class="syllabus-content">
                                @else
                                    <div class="syllabus-content-disabled">
                                @endif
                                <button class="accordion" onclick="accordion(this)">{{ $courseSingleSyllabus['syllabus-name'] }}</button>
                                <div class="panel">
                                    <div class="text-upload-container">
                                        <div id="syllabus-descr"></div>
                                        <input type="hidden" name="{{ $courseSingleSyllabus['key'] }}" value="{{ $courseSingleSyllabus['syllabus-descr-body'] }}"/>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <x-application-modal-layout></x-application-modal-layout>
</div>

<!-- Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/ol@v7.2.2/dist/ol.js"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="https://cdn.jsdelivr.net/gh/AmagiTech/JSLoader/amagiloader.js"></script>
<script>
    function accordion(elem) {
        let contentDiv = elem.parentElement;

        if (contentDiv.className !== 'syllabus-content-disabled') {
            elem.classList.toggle('active');
            let panel = elem.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + 'px';
            }
        }
    }
</script>
</body>
