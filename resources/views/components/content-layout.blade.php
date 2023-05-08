<div class="content-container">
    <div class="courses-container">
        <ul class="course-box">
            @foreach($courses as $course)
            <li>
                <div class="course-card" data-type="{{ $course->type }}">
                    <a href="{{ url('course-single/' . $course->id) }}') }}">
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
                            <form action="{{ url('/join/' . $course->id) }}) }}" method="POST">
                                <button type="button">
                                    <div class="course-join-icon">
                                        <i></i>
                                        <span>Join course</span>
                                    </div>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="content-pagination-container">
        {{ $courses->links() }}
    </div>
</div>

