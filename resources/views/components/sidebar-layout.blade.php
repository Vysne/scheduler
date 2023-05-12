@auth
<div class="sidebar-wrap">
    <ul class="sidebar-container">
        <a href="{{ route('dashboard') }}" class="sidebar-logo" title="Home">
            <img src="{{asset('/img/scheduler-logo-top.png')}}">
            Just Course It !
            <img src="{{asset('/img/scheduler-logo-bottom.png')}}">
        </a>
        <div class="sidebar-local-time">
            <div id="greeting"></div>
            <div class="date-and-time">
                <div id="current-date"></div>
                <div id="clock"></div>
            </div>
        </div>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">Catalog</div>
        <li class="sidebar-item">
            <a href="{{ route('courses') }}" class="sidebar-item-link" title="Courses">
                <i class="fa fa-folder" aria-hidden="true"></i>
                <span class="sidebar-item-title">Courses</span>
            </a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">User</div>
        <li class="sidebar-item">
            <a href="{{ route('dashboard') }}" class="sidebar-item-link" title="Dashboard">
                <i class="fa fa-tachometer" aria-hidden="true"></i>
                <span class="sidebar-item-title">Dashboard</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('calendar') }}" class="sidebar-item-link" title="Calendar">
                <i class="fa fa-table" aria-hidden="true"></i>
                <span class="sidebar-item-title">Calendar</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('achievements') }}" class="sidebar-item-link" title="Achievements">
                <i class="fa fa-certificate" aria-hidden="true"></i>
                <span class="sidebar-item-title">Achievements</span>
            </a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">Actions</div>
        <?php $user = auth()->user(); if ($user['status'] != 'user') : ?>
        <li class="sidebar-item">
            <a href="{{ route('create-course') }}" class="sidebar-item-link" title="Create a course">
                <i class="fa fa-list-alt" aria-hidden="true"></i>
                <span class="sidebar-item-title">Create a course</span>
            </a>
        </li>
        <?php else : ?>
        <li class="sidebar-item">
            <a class="sidebar-item-link" title="Freelancer application" data-toggle="modal" data-target="#applicationModal">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                <span class="sidebar-item-title">Course creator application</span>
            </a>
        </li>
        <?php endif; ?>
        <?php if ($user['status'] == 'admin') : ?>
        <li class="sidebar-item">
            <a href="{{ route('admin-panel') }}" class="sidebar-item-link" title="Admin panel">
                <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                <span class="sidebar-item-title">Admin panel</span>
            </a>
        </li>
        <?php endif; ?>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">Settings</div>
        <li class="sidebar-item" title="Dark mode">
            <a class="sidebar-item-link">
                <i class="fa fa-cog" aria-hidden="true"></i>
                <span class="sidebar-item-title">Dark mode</span>
            </a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-button">
            <button class="rounded-button" id="sidebarToggle" target="expanded"></button>
        </div>
    </ul>
</div>
@endauth
