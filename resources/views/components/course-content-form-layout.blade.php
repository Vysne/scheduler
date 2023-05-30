<div class="course-content-container">
    <div class="about-course-container">
        <div class="course-content-title">
            <h2 id="about-course-part">About course</h2>
        </div>
        <div class="about-course-form">
            <div class="course-card-info">
                <div class="course-image-wrap">
                    <div id="display-image"></div>
                    <div class="upload-container">
                        <i class="fa fa-upload" aria-hidden="true"></i>
                        <input onclick="uploadImg(this)" type="file" id="file-input" name="course-img" accept="image/*">
                    </div>
                </div>
                <div class="course-name-and-type-container">
                    <div class="course-name-wrap">
                        <span>Course title</span>
                        <input type="text" id="course-title" name="course-name">
                    </div>
                    <div class="course-type-and-limit">
                        <div class="course-type-wrap">
                            <span>Course type</span>
                            <x-course-type-dropdown-content-layout></x-course-type-dropdown-content-layout>
                        </div>
                        <div class="course-limit-wrap">
                            <span>Members limit</span>
                            <input type="number" id="course-limit" name="limit" min="0" max="100" required>
                        </div>
                    </div>
                    <div class="course-requirements-wrap">
                        <span>Course requirements</span>
                        <textarea type="text" id="course-requirements" name="course-requirements" required></textarea>
                    </div>
                </div>
            </div>
            <div class="course-description">
                <div id="course-descr"></div>
                <input type="hidden" id="course-descr" name="course-descr-body"/>
{{--                <div class="text-editor">--}}
{{--                    <input name="box" type="hidden">--}}
{{--                    <div id="editor-container"></div>--}}
{{--                    <div id="counter">0 characters</div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
    <div class="time-and-location-container">
        <div class="course-content-title">
            <h2 id="time-and-location-part">Time & location</h2>
        </div>
        <div class="time-and-location-content">
            <div class="time-content">
                <div id="time-input-container">
                    <x-dropdown-single-layout></x-dropdown-single-layout>
                    <x-time-select-layout></x-time-select-layout>
                </div>
                <div id="marker" hidden></div>
                <div class="add-condition">
                    <button type="button" id="add-time">Add</button>
                </div>
            </div>
            <div id="map" class="map">
                <div id="popup" class="ol-popup">
                    <a id="popup-closer" class="ol-popup-closer"></a>
                    <div id="popup-content"></div>
                </div>
                <input type="hidden" id="lon" name="location[longitude][location]" value="">
                <input type="hidden" id="lat" name="location[latitude][location]" value="">
            </div>
        </div>
    </div>
    <div class="skills-container">
        <div class="course-content-title">
            <h2 id="skills-gain-part">Skills you gain</h2>
        </div>
        <div class="skills-content">
            <div class="skills-card">
                <input type="text" name="skill[condition][skill]" required>
            </div>
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
            <div class="instructor-card">
                <div class="instructor-image">
                    <div id="display-image"></div>
                    <div class="upload-container">
                        <i class="fa fa-upload" aria-hidden="true"></i>
                        <input onclick="uploadImg(this)" type="file" id="file-input" name="instructor[condition][img]" accept="image/*">
                    </div>
                </div>
                <div class="about-instructor">
                    <div id="instructor-descr"></div>
                    <input type="hidden" id="instructor-descr" name="instructor[condition][instructor-descr-body]"/>
                    <input type="hidden" id="instructor-element-name" name="instructor[condition][element-name]" value="instructor-descr"/>
{{--                    <div class="text-editor">--}}
{{--                        <input name="box" type="hidden">--}}
{{--                        <div id="editor-container"></div>--}}
{{--                        <div id="counter-2">0 characters</div>--}}
{{--                    </div>--}}
                </div>
            </div>
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
                <button type="button" class="accordion" ondblclick="accordion(this)"><input type="text" name="syllabus[condition][syllabus-name]" required>Give the section a name.</button>
                <div class="panel">
                    <div class="text-upload-container">
                        <div id="syllabus-descr"></div>
                        <input type="hidden" id="syllabus-descr" name="syllabus[condition][syllabus-descr-body]"/>
                        <input type="hidden" id="syllabus-element-name" name="syllabus[condition][element-name]" value="syllabus-descr"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="add-condition">
            <button type="button" id="add-section">Add</button>
        </div>
    </div>
</div>
