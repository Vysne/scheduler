<div class="user-course-table">
    <div class="table-wrapper">
        <table class="table align-middle mb-0 bg-white" id="my-courses-table">
            <thead class="bg-light">
                <tr>
                    <th scope="col">Course</th>
                    <th scope="col">Progress</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            @if(count($enlistments) === 0)
                <tr>
                    <td colspan="4">
                        <div style="padding: 3rem">
                            <i class="fa fa-search" aria-hidden="true" style="display: flex; justify-content: center; font-size: 5rem"></i>
                            <h1 style="display: flex; justify-content: center;">No enlisted courses found.</h1>
                        </div>
                    </td>
                </tr>
            @endif
                @foreach($enlistments as $enlistment)
                    @if($enlistment->status !== 'declined')
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="{{ url('/course-single/' . $enlistment->id) }}" class="table-course-name" style="display: flex; width: auto;">
                                        <img
                                            src="{{ asset($enlistment->image) }}"
                                            alt=""
                                            style="width: 200px; height: 80px"
                                            class="rounded mx-auto d-block"
                                        />
                                        <div class="ms-3" style="display: block;">
                                            <h5 class="fw-bold mb-1">{{ $enlistment->course_name }}</h5>
                                            <p class="mb-1">{{ $enlistment->type }}</p>
                                        </div>

                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="progress-bar-wrapper">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ $enlistment->progress }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $enlistment->progress }}%"></div>
                                    </div>
                                    <span>{{ $enlistment->progress }}%</span>
                                </div>
                            </td>
                            <td>
                                @if($enlistment->status === 'accepted')
                                    <a href="{{ url('/course-single/' . $enlistment->id) }}" class="process-notifier">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                        <span>Joined</span>
                                    </a>
                                @elseif($enlistment->status === 'processing')
                                    <a href="{{ url('/course-single/' . $enlistment->id) }}" class="process-notifier">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        <span>{{ ucfirst($enlistment->status) }}</span>
                                    </a>
                                @endif
                            </td>
                            <td style="display: table-cell">
                                <form action="{{ url('/leave/' . $enlistment->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="leave-course-button" title="Leave course">
                                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                                    </button>
                                </form>
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
                <th scope="col">Members</th>
                <th scope="col">Enlistments</th>
                <th scope="col">Rating</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @if(count($userContents) === 0)
                <tr>
                    <td colspan="5">
                        <div style="padding: 3rem">
                            <i class="fa fa-search" aria-hidden="true" style="display: flex; justify-content: center; font-size: 5rem"></i>
                            <h1 style="display: flex; justify-content: center;">No created courses found.</h1>
                        </div>
                    </td>
                </tr>
            @endif
            @foreach($userContents as $userContent)
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <a href="{{ url('/course-single/' . $userContent->id) }}" class="table-course-name" style="display: flex; width: auto;">
                            <img
                                src="{{ asset($userContent->image) }}"
                                alt=""
                                style="width: 200px; height: 80px"
                                class="rounded mx-auto d-block"
                            />
                            <div class="ms-3" style="display: block;">
                                <h5 class="fw-bold mb-1">{{ $userContent->course_name }}</h5>
                                <p class="mb-1">{{ $userContent->type }}</p>
                            </div>
                        </a>
                    </div>
                </td>
                <td>{{ $userContent->members }}</td>
                <td>{{ $userContent->enlistments }}</td>
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
                            @elseif ($userContent->visible === 3)
                                <div class="processing-button">
                                    <i class="fa fa-eye-slash" aria-hidden="true" title="Needs updated"></i>
                                </div>
                            @else
                            <form action="{{ url('/enable/' . $userContent->id) }}" method="POST" id="enable-form">
                                @csrf
                                <a href="#" id="disable-button" onclick="visibilityAction(this)" title="Publish course">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                            </form>
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

