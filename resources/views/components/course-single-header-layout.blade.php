{{--TODO POSSIBLE CONFLICT DUE TO DOUBLE @auth function--}}
@auth
<div class="course-navbar-container">
    <ul class="course-navbar-menu">
        <div class="navbar-button">
            <li class="navbar-item">
                @auth
                    <a href="{{ route('courses') }}" class="header-button-link"><</a>
                @elseguest
                    <a href="/" class="header-button-link"><</a>
                @endguest
            </li>
        </div>
        <li class="navbar-item" id="about-course">
            <a href="#about-course-part" class="header-item-link">About course</a>
        </li>
        <li class="navbar-item" id="time-and-location">
            <a href="#time-and-location-part" class="header-item-link">Time & location</a>
        </li>
        <li class="navbar-item" id="skills-gain">
            <a href="#skills-gain-part" class="header-item-link">Skills gain</a>
        </li>
        <li class="navbar-item" id="instructor">
            <a href="#instructor-part" class="header-item-link">Instructor</a>
        </li>
        <li class="navbar-item" id="syllabus">
            <a href="#syllabus-part" class="header-item-link">Syllabus</a>
        </li>
    </ul>
    <?php $currentUrl = Route::current()->getName(); if (!in_array($currentUrl, ['create-course', 'edit-course/{id}'])) : ?>
    <div class="enrollment-container">
        <div class="enrollment-button-container">
            @if ($courseSingleData['author'] != Auth::id() && array_key_exists($courseSingleData['id'], $availability) == false)
            <form action="{{ url('/join/' . $courseSingleData['id']) }}" method="POST">
                @csrf
                <button type="submit" class="enrollment-button">
                    <span>Join course</span>
                </button>
            </form>
            @elseif (array_key_exists($courseSingleData['id'], $availability) == true)
                <button type="submit" class="enrollment-button">
                    <div class="course-join-icon">
                        <i></i>
                        <span>{{ ucfirst($availability[$courseSingleData['id']]) }}</span>
                    </div>
                </button>
            @else
                <button type="submit" class="enrollment-button">
                    <div class="course-join-icon">
                        <i></i>
                        <span>Already joined</span>
                    </div>
                </button>
            @endif
        </div>
        <div class="enrollment-statistics-container">
            <h5>Already enrolled: 100 users</h5>
        </div>
    </div>
    <?php else : ?>
    <div class="enrollment-container">
        <div class="enrollment-button-container">
            <button type="submit" class="enrollment-button">
                <span>Submit</span>
            </button>
        </div>
    </div>
    <?php endif; ?>
</div>
@endauth



