<div class="catalog-wrap">
    <div class="catalog-container">
        <nav class="catalog-navbar">
            <form class="navbar-search">
                <div class="input-group">
                    <input type="text" class="search-field" placeholder="Search for.." aria-label="Search">
                    <div class="input-group-button">
                        <button class="search-button" type="button">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </form>
            @auth
            <ul class="navbar-menu">
                <li class="navbar-menu-item">
                    <a role="button" id="alertsDropdown" data-toggle="dropdown" class="item-link" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell" aria-hidden="true" target="shrinked"></i>
                        <span class="item-badge">0+</span>
                    </a>
                    <div class="dropdown-list-menu dropdown-menu-disabled" id="alerts-dropdown-list">
                        <h6 class="dropdown-header">Alerts Center</h6>
                        <a href="" class="dropdown-list-item"></a>
                        <a href="" class="dropdown-list-item"></a>
                        <a href="" class="dropdown-list-item"></a>
                        <a href="" class="dropdown-list-item">Show All Alerts</a>
                    </div>
                </li>
                <li class="navbar-menu-item">
                    <a role="button" id="messagesDropdown" data-toggle="dropdown" class="item-link" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-envelope" aria-hidden="true" target="shrinked"></i>
                        <span class="item-badge">0+</span>
                    </a>
                    <div class="dropdown-list-menu dropdown-menu-disabled" id="messages-dropdown-list">
                        <h6 class="dropdown-header">Message Center</h6>
                        <a href="" class="dropdown-list-item"></a>
                        <a href="" class="dropdown-list-item"></a>
                        <a href="" class="dropdown-list-item"></a>
                        <a href="" class="dropdown-list-item">Read More Messages</a>
                    </div>
                </li>
                <div class="navbar-divider"></div>
                <li class="navbar-menu-item">
                    <a role="button" id="userDropdown" data-toggle="dropdown" class="item-link" aria-haspopup="true" aria-expanded="false" target="shrinked">
                        <span class="user-name">Name Surname</span>
                        <img src="{{asset('/img/user-profile.svg')}}" class="profile-img">
                    </a>
                    <div class="user-dropdown-menu dropdown-menu-disabled" id="dropdown-menu">
                        <a href="#" class="dropdown-item">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
            @endauth
        </nav>
    </div>
</div>
