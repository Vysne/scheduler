{{--TODO REMOVE OR MAKE UP SOLUTION--}}
<div class="course-content-container">
    <div class="about-course-container">
        <div class="course-content-title">
            <h2 id="about-course-part">About course</h2>
        </div>
        <div class="about-course-content">
            <div class="course-content-description">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum congue ultricies tellus et cursus. Nam placerat felis lectus, sit amet elementum ligula tempus quis. Pellentesque euismod eget urna sit amet volutpat. Vestibulum varius, ipsum et sodales fringilla, est augue finibus sapien, eget fringilla nunc nisl eu nibh. Vestibulum nec diam vel tellus dignissim elementum sed vel mauris. Duis eget hendrerit odio, quis porttitor quam. Phasellus dignissim turpis gravida pellentesque porttitor. Ut egestas sodales mi in ultrices. Etiam accumsan nisi sed nulla condimentum, viverra facilisis nisl vestibulum. In hac habitasse platea dictumst. Vestibulum aliquam fermentum nibh sit amet luctus.
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
    <div class="time-and-location-container">
        <div class="course-content-title">
            <h2 id="time-and-location-part">Time & location</h2>
        </div>
        <div class="time-and-location-content">
            <div class="time-content">
                <ul>
                    <li>Day/Time</li>
                    <li>Day/Time</li>
                    <li>Day/Time</li>
                    <li>Day/Time</li>
                    <li>Including holidays</li>
                </ul>
            </div>
            <div id="map" class="map">
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
            <div class="skills-card">
                <span>Javascript</span>
            </div>
            <div class="skills-card">
                <span>PHP</span>
            </div>
            <div class="skills-card">
                <span>MYSQL</span>
            </div>
            <div class="skills-card">
                <span>Laravel</span>
            </div>
        </div>
    </div>
    <div class="instructor-container">
        <div class="course-content-title">
            <h2 id="instructor-part">Instructors</h2>
        </div>
        <div class="instructor-content">
            <div class="instructor-card">
                <div class="instructor-image">
                    <img src="{{ asset('/img/user-profile.svg') }}" alt="Avatar">
                </div>
                <div class="about-instructor">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum congue ultricies tellus et cursus. Nam placerat felis lectus, sit amet elementum ligula tempus quis. Pellentesque euismod eget urna sit amet volutpat. Vestibulum varius, ipsum et sodales fringilla, est augue finibus sapien, eget fringilla nunc nisl eu nibh. Vestibulum nec diam vel tellus dignissim elementum sed vel mauris. Duis eget hendrerit odio, quis porttitor quam. Phasellus dignissim turpis gravida pellentesque porttitor. Ut egestas sodales mi in ultrices. Etiam accumsan nisi sed nulla condimentum, viverra facilisis nisl vestibulum. In hac habitasse platea dictumst. Vestibulum aliquam fermentum nibh sit amet luctus.</p>
                    <div class="socials">
                        <a href="#" class="fa fa-facebook"></a>
                        <a href="#" class="fa fa-twitter"></a>
                        <a href="#" class="fa fa-google"></a>
                        <a href="#" class="fa fa-linkedin"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="syllabus-container">
        <div class="course-content-title">
            <h2 id="syllabus-part">Syllabus</h2>
        </div>
        <div class="syllabus-content">
            <button class="accordion">Section 1</button>
            <div class="panel">
                <h4>Introduction</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <video id="course-video" controls autobuffer>
{{--                    <source src="{{ asset('video/Introduction.mp4') }}" type="video/mp4">--}}
                    <source src="video/Introduction.mp4" type="video/mp4">
                </video>
            </div>

            <button class="accordion">Section 2</button>
            <div class="panel">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <button class="accordion">Section 3</button>
            <div class="panel">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
        </div>
    </div>
</div>
