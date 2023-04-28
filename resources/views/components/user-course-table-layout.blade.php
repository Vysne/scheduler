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
                <tr>
                    <th scope="row">The Ultimate Web Design Projects Course</th>
                    <td>Computer Science</td>
                    <td>
                        <div class="progress-bar-wrapper">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 50%"></div>
                            </div>
                            <span>50%</span>
                        </div>
                    </td>
                    <td>
                        <a href="#" class="notifier-button">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            <span>Inspect</span>
                        </a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Mastering Business Negotiations</th>
                    <td>Business</td>
                    <td>
                        <div class="progress-bar-wrapper">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 20%"></div>
                            </div>
                            <span>20%</span>
                        </div>
                    </td>
                    <td>
                        <a href="#" class="notifier-button">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            <span>Inspect</span>
                        </a>
                    </td>
                </tr>
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
                <th scope="row">{{ $userContent->course_name }}</th>
                <td>{{ $userContent->type }}</td>
                <td></td>
                <td>
                    <div class="action-buttons-wrap">
                        <a href="{{ url('/edit-course/' . $userContent->id) }}" class="notifier-button">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            <span>Inspect</span>
                        </a>
                        <a href="" class="notifier-button">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                            <span>Delete</span>
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

