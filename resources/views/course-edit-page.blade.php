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
    'resources/sass/map.scss',
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
                    <form action="{{ route('update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @foreach($course['about-course'] as $courseSingleData)
                            <input type="hidden" name="course_id" value="{{ $courseSingleData['id'] }}">
                            <x-course-single-header-layout :availability="$availability" :courseSingleData="$courseSingleData"></x-course-single-header-layout>
                        @endforeach
                        @foreach($course['about-course'] as $courseSingleData)
                            <div class="course-content-container">
                                <div class="about-course-container">
                                    <div class="course-content-title">
                                        <h2 id="about-course-part">About course</h2>
                                    </div>
                                    <div class="about-course-form">
                                        <div class="course-card-info">
                                            <div class="course-image-wrap">
                                                <div id="display-image" style="background-image: url('{{ asset($courseSingleData['image']) }}')"></div>
                                                <div class="upload-container">
                                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                                    <input onclick="uploadImg(this)" type="file" id="file-input" name="course-img" accept="image/*">
                                                </div>
                                                <input type="hidden" name="course-image" value="{{ $courseSingleData['image'] }}">
                                            </div>
                                            <div class="course-name-and-type-container">
                                                <div class="course-name-wrap">
                                                    <span>Course title</span>
                                                    <input type="text" id="course-title" name="course-name" value="{{ $courseSingleData['course_name'] }}">
                                                </div>
                                                <div class="course-type-wrap">
                                                    <span>Course type</span>
                                                    <div class="course-type-select">
                                                        <div class="dropdown" onclick="dropdownActive(this)">
                                                            <input type="text" class="textBox" placeholder="Select a day" value="{{ $courseSingleData['type'] }}" name="course-type" readonly required>
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
                                                <div class="course-requirements-wrap">
                                                    <span>Course requirements</span>
                                                    <textarea type="text" id="course-requirements" name="course-requirements" required>{{ $courseSingleData['requirements'] }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="course-description">
                                            <div id="course-descr"></div>
                                            <input type="hidden" id="course-descr" name="course-descr-body" value="{{ $courseSingleData['course_descr_body'] }}"/>
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
                                            <form action="{{ route('remove') }}" method="POST" id="timedate-form">
                                                @csrf
                                                <input type="hidden" name="conditionId" value="{{ $data['id'] }}">
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
                                            </form>
                                        @endforeach
                                        <div id="marker" hidden></div>
                                        <div class="add-condition">
                                            <button type="button" id="add-time">Add</button>
                                        </div>
                                    </div>
                                    <div id="map" class="map">
                                        <div id="popup" class="ol-popup">
                                            <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                                            <div id="popup-content"></div>
                                        </div>
                                        <input type="hidden" id="lon" name="location[longitude][location]" value="{{ $course['course-location'][0]['location'] }}">
                                        <input type="hidden" id="lat" name="location[latitude][location]" value="{{ $course['course-location'][1]['location'] }}">
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
                                            <form action="{{ route('remove') }}" method="POST" id="skills-form">
                                            @csrf
                                                <input type="hidden" name="conditionId" value="{{ $data['id'] }}">
                                                <input type="text" name="skill[{{ $data['key'] }}]" value="{{ $data['skill'] }}" required>
                                            </form>
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
{{--                                        {{ dd($data) }}--}}
                                    <form action="{{ route('remove') }}" method="POST" id="instructor-form">
                                        <div class="instructor-card">
                                                @csrf
                                                <input type="hidden" name="conditionId" value="{{ $data['id'] }}">
                                                <div class="instructor-image">
                                                    <div id="display-image" style="background-image: url('{{ asset($data['img']) }}')"></div>
                                                    <div class="upload-container">
                                                        <i class="fa fa-upload" aria-hidden="true"></i>
                                                        <input onclick="uploadImg(this)" type="file" id="file-input" name="instructor[{{ $data['key'] }}][img]" accept="image/*">
                                                    </div>
                                                </div>
                                                <div class="about-instructor">
                                                    <div id="{{ $data['element-name'] }}"></div>
                                                    <input type="hidden" id="instructor-descr" name="instructor[{{ $data['key'] }}][instructor-descr-body]" value="{{ $data['instructor-descr-body'] }}"/>
                                                    <input type="hidden" id="instructor-element-name" name="instructor[{{$data['key']}}][element-name]" value="{{ $data['element-name'] }}"/>
                                                </div>
                                                <input type="hidden" id="instructor-current-image" name="instructor[{{ $data['key'] }}][instructor-image]" value="{{ $data['img'] }}">
                                        </div>
                                    </form>
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
                                    @foreach($course['course-syllabuses'] as $data)
                                    <form action="{{ route('remove') }}" method="POST" id="syllabus-form">
                                        @csrf
                                        <input type="hidden" name="conditionId" value="{{ $data['id'] }}">
                                        <div class="syllabus-content">
                                            <button type="button" onclick="accordion(this)" class="accordion"><input type="text" name="syllabus[{{ $data['key'] }}][syllabus-name]" value="{{ $data['syllabus-name'] }}" required>Give the section a name.</button>
                                            <div class="panel">
                                                <div class="text-upload-container">
                                                    <div id="{{ $data['element-name'] }}"></div>
                                                    <input type="hidden" id="syllabus-descr" name="syllabus[{{ $data['key'] }}][syllabus-descr-body]" value="{{ $data['syllabus-descr-body'] }}"/>
                                                    <input type="hidden" id="syllabus-element-name" name="syllabus[{{ $data['key'] }}][element-name]" value="{{ $data['element-name'] }}"/>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    @endforeach
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
        <x-application-modal-layout></x-application-modal-layout>
    </div>
@endauth

<!-- Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
    function removeFrontTime(button) {
        let condition = button.parentElement.parentElement;
        condition.remove();

        let conditions = document.querySelectorAll('#time-input-container:not(:first-child)');
        var i = 1;

        conditions.forEach(function (condition) {
            let dayInput = condition.querySelector('.day-select input');
            let timeInput = condition.querySelector('.time-input input');
            let counter = i++;

            dayInput.setAttribute('name', 'date[daytime-condition' + counter + ']' + '[day]');
            timeInput.setAttribute('name', 'date[daytime-condition' + counter + ']' + '[time]');
        });
    }
    function removeTime(button) {
        AmagiLoader.show();
        let condition = button.parentElement.parentElement;
        let form = condition.parentElement;
        form.submit();
        condition.remove();

        let conditions = document.querySelectorAll('#time-input-container:not(:first-child)');
        var i = 1;

        conditions.forEach(function (condition) {
           let dayInput = condition.querySelector('.day-select input');
           let timeInput = condition.querySelector('.time-input input');
           let counter = i++;

           dayInput.setAttribute('name', 'date[daytime-condition' + counter + ']' + '[day]');
           timeInput.setAttribute('name', 'date[daytime-condition' + counter + ']' + '[time]');
        });
    }
    function removeFrontSkill(button) {
        let condition = button.parentElement;
        condition.remove();

        let conditions = document.querySelectorAll('.skills-card:not(:first-child)');
        var i = 1;

        conditions.forEach(function (condition) {
            let skillInput = condition.querySelector('input');
            let counter = i++;

            skillInput.setAttribute('name', 'skill[skill-condition' + counter + ']');
        });
    }
    function removeSkill(button) {
        AmagiLoader.show();
        let condition = button.parentElement;
        let form = button.nextElementSibling;
        form.submit();
        condition.remove();

        let conditions = document.querySelectorAll('.skills-card:not(:first-child)');
        var i = 1;

        conditions.forEach(function (condition) {
           let skillInput = condition.querySelector('input');
           let counter = i++;

           skillInput.setAttribute('name', 'skill[skill-condition' + counter + ']');
        });
    }
    function removeFrontInstructor(button) {
        let condition = button.parentElement;
        condition.remove();

        let conditions = document.querySelectorAll('.instructor-card');
        var i = 1;

        conditions.forEach(function (condition, index) {
            if (index !== 0) {
                let counter = i++;
                let instructorImg = condition.querySelector('.upload-container input');
                let instructorOldImg = condition.querySelector('#instructor-current-image');
                let instructorEditor = condition.querySelector('.ql-container');
                let editorInput = instructorEditor.nextElementSibling;
                let elementInput = editorInput.nextElementSibling;

                instructorImg.setAttribute('name', 'instructor[instructor-condition' + counter + ']' + '[img]');
                instructorOldImg.setAttribute('name', 'instructor[instructor-condition' + counter + ']' + '[instructor-image]');
                instructorEditor.setAttribute('id', 'instructor-descr' + counter);
                editorInput.setAttribute('id', 'instructor-descr' + counter);
                editorInput.setAttribute('name', 'instructor[instructor-condition' + counter + ']' + '[instructor-descr-body]');
                elementInput.setAttribute('name', 'instructor[instructor-condition' + counter + ']' + '[element-name]');
                elementInput.value = instructorEditor.getAttribute('id');
            }
        });
    }
    function removeFrontSection(button) {
        let condition = button.parentElement.parentElement;
        condition.remove();

        let conditions = document.querySelectorAll('.syllabus-content');
        var i = 1;

        conditions.forEach(function (condition, index) {
            if (index !== 0) {
                let counter = i++;
                let titleInput = condition.querySelector('input');
                let instructorEditor = condition.querySelector('.ql-container');
                let editorInput = instructorEditor.nextElementSibling;
                let elementInput = editorInput.nextElementSibling;

                titleInput.setAttribute('name', 'syllabus[syllabus-condition' + counter + '][syllabus-name]');
                instructorEditor.setAttribute('id', 'syllabus-descr' + counter);
                editorInput.setAttribute('id', 'syllabus-descr' + counter);
                editorInput.setAttribute('name', 'syllabus[syllabus-condition' + counter + ']' + '[syllabus-descr-body]');
                elementInput.setAttribute('name', 'syllabus[syllabus-condition' + counter + ']' + '[element-name]');
                elementInput.setAttribute('value', 'syllabus-descr' + counter);
            }
        });
    }
</script>
</body>
