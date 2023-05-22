<div class="content-container">
    <div class="courses-container">
        <ul class="course-box">
            @foreach($courses as $course)
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
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <p>({{ $course->enlistments }})</p>
                            <input type="hidden" value="{{ $course->rating }}">
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

