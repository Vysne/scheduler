<div class="user-course-table">
    <div class="table-wrapper">
        <table class="table align-middle mb-0 bg-white" id="my-courses-table">
            <thead class="bg-light">
                <tr>
                    <th scope="col">Course</th>
                    <th scope="col">Type</th>
                    <th scope="col">Progress</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($enlistments as $enlistment)
                    @if($enlistment->status !== 'declined')
                        <tr>
                            <td><a href="{{ url('/course-single/' . $enlistment->id) }}" class="table-course-name">{{ $enlistment->course_name }}</a></td>
                            <td>{{ $enlistment->type }}</td>
                            <td>
                                <div class="progress-bar-wrapper">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 50%"></div>
                                    </div>
                                    <span>50%</span>
                                </div>
                            </td>
                            <td>
                                @if($enlistment->status === 'accepted')
                                    <a href="{{ url('/course-single/' . $enlistment->id) }}" class="process-notifier">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                        <span>Already joined</span>
                                    </a>
                                @elseif($enlistment->status === 'processing')
                                    <a href="{{ url('/course-single/' . $enlistment->id) }}" class="process-notifier">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        <span>{{ ucfirst($enlistment->status) }}</span>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <table class="table align-middle mb-0 bg-white" id="created-courses-table" hidden>
            <thead class="bg-light">
            <tr>
                <th scope="col">Course</th>
                <th scope="col">Type</th>
                <th scope="col">Rating</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($userContents as $userContent)
            <tr>
                <td><a href="{{ url('/course-single/' . $userContent->id) }}" class="table-course-name">{{ $userContent->course_name }}</a></td>
                <td>{{ $userContent->type }}</td>
{{--                <td>{{ $userContent->rating }}</td>--}}
                <td>
                    <div class="course-rating">
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                        <input type="hidden" value="{{ $userContent->rating }}">
                    </div>
                </td>
                <td>
                    <div class="action-buttons-wrap">
                        @if ($userContent->visible === 2)
                            @if (Auth::user()->status == 'creator')
                                <div class="inspect-button-wrap">
                                    <div class="processing-button">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div class="course-enlistment-wrap">
                                    <div class="processing-button">
                                        <i class="fa fa-users" aria-hidden="true"></i>
                                    </div>
                                </div>
                            @else
                                <input type="hidden" value="{{ $userContent->visible }}">
                                <div class="inspect-button-wrap">
                                    <a href="{{ url('/edit-course/' . $userContent->id) }}" title="Edit">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <div class="course-enlistment-wrap">
                                    <a href="{{ url('/members/' . $userContent->id) }}" title="Manage members">
                                        <i class="fa fa-users" aria-hidden="true"></i>
                                    </a>
                                </div>
                            @endif
                        @else
                            <input type="hidden" value="{{ $userContent->visible }}">
                            <div class="inspect-button-wrap">
                                <a href="{{ url('/edit-course/' . $userContent->id) }}" title="Edit">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                            </div>
                            <div class="course-enlistment-wrap">
                                <a href="{{ url('/members/' . $userContent->id) }}" title="Manage members">
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                </a>
                            </div>
                        @endif
                        <div class="disable-button-wrap">
                            @if ($userContent->visible === 1)
                            <form action="{{ url('/disable/' . $userContent->id) }}" method="POST" id="disable-form">
                                @csrf
                                <a href="#" id="disable-button" onclick="visibilityAction(this)" title="Hide course">
                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                </a>
                            </form>
                            @elseif ($userContent->visible === 2)
                                @if (Auth::user()->status == 'creator')
                                    <div class="processing-button">
                                        <i class="fa fa-eye-slash" aria-hidden="true" title="Verifying course"></i>
                                    </div>
                                @else
                                    <form action="{{ url('/disable/' . $userContent->id) }}" method="POST" id="disable-form">
                                        @csrf
                                        <a href="#" id="disable-button" onclick="visibilityAction(this)" title="Hide course">
                                            <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                        </a>
                                    </form>
                                @endif
                            @else
                            <form action="{{ url('/enable/' . $userContent->id) }}" method="POST" id="enable-form">
                                @csrf
                                <a href="#" id="disable-button" onclick="visibilityAction(this)" title="Publish course">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                            </form>
                            @endif
                        </div>
{{--                        <?php $user = auth()->user(); if ($user['status'] == 'admin') : ?>--}}
{{--                        <form action="{{ url('/delete/' . $userContent->id) }}" method="POST" id="delete-form">--}}
{{--                            @csrf--}}
{{--                            <div class="delete-button-wrap">--}}
{{--                                <a href="#" onclick="" title="Delete">--}}
{{--                                    <i class="fa fa-trash" aria-hidden="true"></i>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                        <?php endif; ?>--}}
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

