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
    'resources/sass/course.scss',
    'resources/sass/map.scss', 'resources/js/map.js',
    'resources/sass/form.scss',
    'resources/sass/dropdown.scss', 'resources/js/dropdown.js',
    'resources/sass/time.scss',
    'resources/js/editCourse.js',
    ])

</head>
<body>
@auth
    <div class="app">
        <x-sidebar-layout></x-sidebar-layout>
        <div class="catalog-wrap">
            <x-navbar-layout></x-navbar-layout>
            <div class="course-single-wrapper">
                <div class="course-single-container">
                    <form action="{{ route('update') }}" method="GET" enctype="multipart/form-data">
                        @csrf
                        <x-course-single-header-layout></x-course-single-header-layout>
                        <div class="course-content-container">
                            <div class="about-course-container">
                                <div class="course-content-title">
                                    <h2 id="about-course-part">About course</h2>
                                </div>
                                @foreach($course['about-course'] as $data)
                                <div class="about-course-form">
                                    <div class="course-card-info">
                                        <div class="course-image-wrap">
                                            <div id="display-image" style="background-image: url('{{ asset($data['image']) }}')"></div>
                                            <div class="upload-container">
                                                <i class="fa fa-upload" aria-hidden="true"></i>
                                                <input onclick="uploadImg(this)" type="file" id="file-input" name="course-img" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="course-name-and-type-container">
                                            <div class="course-name-wrap">
                                                <span>Course title</span>
                                                <input type="text" id="course-title" name="course-name" value="{{ $data['course_name'] }}">
                                            </div>
                                            <div class="course-type-wrap">
                                                <span>Course type</span>
                                                <div class="course-type-select">
                                                    <div class="dropdown" onclick="dropdownActive(this)">
                                                        <input type="text" class="textBox" placeholder="Select a day" value="{{ $data['type'] }}" name="course-type" readonly required>
                                                        <div class="option">
                                                            <div onclick="show(this)">Economy and Finances</div>
                                                            <div onclick="show(this)">Health</div>
                                                            <div onclick="show(this)">Arts and Humanities</div>
                                                            <div onclick="show(this)">Computer Science</div>
                                                            <div onclick="show(this)">Physics and Engineering</div>
                                                            <div onclick="show(this)">Math and Logic</div>
                                                            <div onclick="show(this)">Business</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="course-description">
                                        <div id="course-descr"></div>
                                        <input type="hidden" id="course-descr" name="course-descr-body" value="{{ $data['course_descr_body'] }}"/>
                                        {{--                <div class="text-editor">--}}
                                        {{--                    <input name="box" type="hidden">--}}
                                        {{--                    <div id="editor-container"></div>--}}
                                        {{--                    <div id="counter">0 characters</div>--}}
                                        {{--                </div>--}}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="time-and-location-container">
                                <div class="course-content-title">
                                    <h2 id="time-and-location-part">Time & location</h2>
                                </div>
                                <div class="time-and-location-content">
                                    <div class="time-content">
                                        @foreach($course['course-dates'] as $data)
                                        <div id="time-input-container">
                                            <div class="day-select">
                                                <div class="dropdown" onclick="dropdownActive(this)">
                                                    <input type="text" class="textBox" placeholder="Select a day" value="{{ $data['day'] }}" name="date[{{ $data['key'] }}][day]" readonly required>
                                                    <div class="option">
                                                        <div onclick="show(this)">Monday</div>
                                                        <div onclick="show(this)">Tuesday</div>
                                                        <div onclick="show(this)">Wednesday</div>
                                                        <div onclick="show(this)">Thursday</div>
                                                        <div onclick="show(this)">Friday</div>
                                                        <div onclick="show(this)">Saturday</div>
                                                        <div onclick="show(this)">Sunday</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="time-input">
                                                <input type="time" id="appt" name="date[{{ $data['key'] }}][time]" value="{{ $data['time'] }}" min="00:00" max="24:00" required>
                                            </div>
                                        </div>
                                        @endforeach
                                        <div id="marker" hidden></div>
                                        <div class="add-condition">
                                            <button type="button" id="add-time">Add</button>
                                        </div>
                                    </div>
                                    <div id="map" class="map">
                                        <div id="popup" class="ol-popup">
                                            <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                                            <a href="#" id="popup-remove" class="ol-popup-remove"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            <div id="popup-content"></div>
                                        </div>
                                        <div class="location">
                                            <h1>Test</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="skills-container">
                                <div class="course-content-title">
                                    <h2 id="skills-gain-part">Skills you gain</h2>
                                </div>
                                <div class="skills-content">
                                    @foreach($course['course-skills'] as $data)
                                    <div class="skills-card">
                                        <input type="text" name="skill[{{ $data['key'] }}]" value="{{ $data['skill'] }}" required>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="add-condition">
                                    <button type="button" id="add-skill">Add</button>
                                </div>
                            </div>
                            <div class="instructor-container">
                                <div class="course-content-title">
                                    <h2 id="instructor-part">Instructors</h2>
                                </div>
                                <div class="instructor-content">
                                    @php($i = 0)
                                    @foreach($course['course-instructors'] as $data)
{{--                                        {{ var_dump($data) }}--}}
                                    <div class="instructor-card">
                                        <div class="instructor-image">
                                            <div id="display-image" style="background-image: url('{{ $data['img'] }}')"></div>
                                            <div class="upload-container">
                                                <i class="fa fa-upload" aria-hidden="true"></i>
                                                <input onclick="uploadImg(this)" type="file" id="file-input" name="instructor[{{ $data['key'] }}][img]" accept="image/*">
                                            </div>
                                        </div>
                                        <div class="about-instructor">
                                            @if($i++ == 0)
                                                <div id="instructor-descr"></div>
                                                <input type="hidden" id="instructor-descr" value="{{ $data['instructor-descr-body'] }}" name="instructor[{{ $data['key'] }}][instructor-descr-body]"/>
                                            @else
                                                <div id="instructor-descr{{ $i++ -1 }}"></div>
                                                <input type="hidden" id="instructor-descr{{ $i++ -1 }}" value="{{ $data['instructor-descr-body'] }}" name="instructor[{{ $data['key'] }}][instructor-descr-body]"/>
                                            @endif
                                            {{--                    <div class="text-editor">--}}
                                            {{--                        <input name="box" type="hidden">--}}
                                            {{--                        <div id="editor-container"></div>--}}
                                            {{--                        <div id="counter-2">0 characters</div>--}}
                                            {{--                    </div>--}}
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="add-condition">
                                    <button type="button" id="add-instructor">Add</button>
                                </div>
                            </div>
                            <div class="syllabus-container">
                                <div class="course-content-title">
                                    <h2 id="syllabus-part">Syllabus</h2>
                                </div>
                                <div class="syllabuses">
                                    <div class="syllabus-content">
                                        <div class="controls"></div>
                                        <button type="button" onclick="accordion()" class="accordion"><input type="text" name="syllabus[condition][syllabus-name]" required>Give the section a name.</button>
                                        <div class="panel">
                                            <div class="syllabus-type">
                                                <button type="button" class="syllabus-type-button" data-type="video">Video</button>
                                                <button type="button" class="syllabus-type-button" data-type="text">Text</button>
                                            </div>
                                            <div class="video-upload-container" hidden>
                                                <input type="file" id="video-file-input" multiple>
                                                <label for="video-file-input">
                                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                                    &nbsp;
                                                    Choose files to upload
                                                </label>
                                                <div id="num-of-files">No files chosen</div>
                                                <ul id="files-list"></ul>
                                            </div>
                                            <div class="text-upload-container" hidden>
                                                <div id="syllabus-descr"></div>
                                                <input type="hidden" id="syllabus-descr" name="syllabus[condition][syllabus-descr-body]"/>
                                                {{--                        <div class="text-editor">--}}
                                                {{--                            <input name="box" type="hidden">--}}
                                                {{--                            <div id="editor-container"></div>--}}
                                                {{--                            <div id="counter-2">0 characters</div>--}}
                                                {{--                        </div>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="add-condition">
                                    <button type="button" id="add-section">Add</button>
                                </div>
                            </div>
                        </div>
{{--                        @endforeach--}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endauth

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/ol@v7.2.2/dist/ol.js"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="https://cdn.jsdelivr.net/gh/AmagiTech/JSLoader/amagiloader.js"></script>
{{--TODO MOVE FUNCTION TO DROPDOWN.JS--}}
<script>
    function show(elemValue) {
        let optionsDiv = elemValue.parentElement;
        let input = optionsDiv.previousElementSibling;
        input.value = elemValue.innerHTML;
    }

    function dropdownActive(elem) {
        elem.classList.toggle('active');
    }
    function uploadImg(elem) {
        let uploaded_image = "";

        elem.addEventListener('change', function () {
            let reader = new FileReader();

            reader.addEventListener('load', function () {
                let imgDiv = elem.parentElement.previousElementSibling;
                uploaded_image = reader.result;
                imgDiv.style.backgroundImage = `url(${uploaded_image})`;
            });
            reader.readAsDataURL(this.files[0]);
        });
    }
    function accordion() {
        let accordionElem = document.getElementsByClassName('accordion');
        let i;

        for (i = 0; i < accordionElem.length; i++) {
            accordionElem[i].addEventListener('click', function() {
                this.classList.toggle('active');
                let panel = this.nextElementSibling;
                if (panel.style.maxHeight) {
                    panel.style.maxHeight = null;
                } else {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                }
            });
        }
    }
</script>
</body>
