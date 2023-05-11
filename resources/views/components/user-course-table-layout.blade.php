<div class="user-course-table">
    <div class="table-wrapper">
        <table class="table table-dark table-bordered bdr">
            <thead>
                <tr>
                    <th colspan="4" class="table-header">My courses</th>
                </tr>
                <tr>
                    <th scope="col">Course</th>
                    <th scope="col">Type</th>
                    <th scope="col">Progress</th>
                    <th scope="col">Course page</th>
                </tr>
            </thead>
            <tbody>
                @foreach($enlistments as $enlistment)
{{--                    {{ dd($enlistment) }}--}}
                <tr>
                    <th scope="row">{{ $enlistment->course_name }}</th>
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
                        <a class="notifier-button">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            <span>{{ ucfirst($enlistment->status) }}</span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <thead>
            <tr>
                <th colspan="4" class="table-header">Created courses</th>
            </tr>
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
                <td>{{ $userContent->course_name }}</td>
                <td>{{ $userContent->type }}</td>
                <td></td>
                <td>
                    <div class="action-buttons-wrap">
                        <input type="hidden" value="{{ $userContent->visible }}">
                        <div class="inspect-button-wrap">
                            <a href="{{ url('/edit-course/' . $userContent->id) }}" class="notifier-button">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                <span>Inspect</span>
                            </a>
                        </div>
                        <div class="course-enlistment-wrap">
                            <a href="{{ url('/members/' . $userContent->id) }}" class="notifier-button">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <span>Members</span>
                            </a>
                        </div>
                        <div class="disable-button-wrap">
                            @if ($userContent->visible != 0)
                            <form action="{{ url('/disable/' . $userContent->id) }}" method="POST" id="disable-form">
                                @csrf
                                <a href="#" class="notifier-button" id="disable-button" onclick="visibilityAction(this)">
                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                    <span>Disable</span>
                                </a>
                            </form>
                            @else
                            <form action="{{ url('/enable/' . $userContent->id) }}" method="POST" id="enable-form">
                                @csrf
                                <a href="#" class="notifier-button" id="disable-button" onclick="visibilityAction(this)">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    <span>Enable</span>
                                </a>
                            </form>
                            @endif
                        </div>
                        <?php $user = auth()->user(); if ($user['status'] == 'admin') : ?>
                        <form action="{{ url('/delete/' . $userContent->id) }}" method="POST" id="delete-form">
                            @csrf
                            <div class="delete-button-wrap">
                                <a href="#" class="notifier-button" onclick="">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                    <span>Delete</span>
                                </a>
                            </div>
                        </form>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

