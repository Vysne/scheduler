<div class="modal fade-scale" id="{{ $memberId }}userProgressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">User information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="main-body">
                        @foreach($progress as $item)
                            <div class="syllabus-content">
                                @if($item['marked'] === true)
                                <a href="{{ url('course-single/' . $item['course_id'] . '#syllabus-part') }}" class="accordion syllabus-complete" data-mark="{{ $item['marked'] }}">
                                    <span>{{ $item['syllabus-name'] }}</span>
                                    <span>{{ $item['created_at'] }}</span>
                                </a>
                                @else
                                    <a href="{{ url('course-single/' . $item['course_id'] . '#syllabus-part') }}" class="accordion" data-mark="{{ $item['marked'] }}">
                                        <span>{{ $item['syllabus-name'] }}</span>
                                        <span>{{ $item['created_at'] }}</span>
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

