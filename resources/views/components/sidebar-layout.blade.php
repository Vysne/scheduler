<div class="sidebar-wrap">
    <ul class="sidebar-container">
        <a href="#" class="sidebar-logo" title="Home">
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
        <li class="sidebar-item">
            <a class="sidebar-item-link" title="Dashboard">
                <i class="fa fa-tachometer" aria-hidden="true"></i>
                <span class="sidebar-item-title">Dashboard</span>
            </a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">Interface</div>
        <li class="sidebar-item">
            <a class="sidebar-item-link" title="Components">
                <i class="fa fa-cog" aria-hidden="true"></i>
                <span class="sidebar-item-title">Components</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-item-link" title="Utilities">
                <i class="fa fa-wrench" aria-hidden="true"></i>
                <span class="sidebar-item-title">Utilities</span>
            </a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">Addons</div>
        <li class="sidebar-item">
            <a class="sidebar-item-link" title="Pages">
                <i class="fa fa-folder" aria-hidden="true"></i>
                <span class="sidebar-item-title">Pages</span>
            </a>
        </li>
        <li class="sidebar-item" title="Charts">
            <a class="sidebar-item-link">
                <i class="fa fa-table" aria-hidden="true"></i>
                <span class="sidebar-item-title">Charts</span>
            </a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-button">
            <button class="rounded-button" id="sidebarToggle" target="expanded"></button>
        </div>
    </ul>
</div>
