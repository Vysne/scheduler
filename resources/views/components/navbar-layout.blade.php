{{--<div class="catalog-wrap">--}}
    <div class="catalog-container" style="flex-direction: column;">
        <nav class="catalog-navbar">
            <div style="display: inline-flex;">
                @guest
                    <a href="/" class="sidebar-logo guest-logo" title="Home">
                        <img src="{{asset('/img/scheduler-logo-top.png')}}">
                        Just Course It !
                        <img src="{{asset('/img/scheduler-logo-bottom.png')}}">
                    </a>
                    <div class="navbar-divider"></div>
                @endguest
                <form class="navbar-search @guest guest-search @endguest">
                    <div class="input-group">
                        <input type="text" class="search-field" placeholder="Search for.." aria-label="Search">
                        <div class="input-group-button">
                            <button class="search-button" type="button">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <ul class="navbar-menu">
                @auth
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
                            <span class="user-name">{{ Auth::user()->name }}</span>
                            @foreach($userData as $userImage)
                                @if($userImage['user-image'] != 'user-profile.svg')
                                    <img src="{{ asset($userImage['user-image']) }}" class="profile-img">
                                @else
                                    <img src="{{ asset('/img/user-profile.svg') }}" class="profile-img">
                                @endif
                            @endforeach
                        </a>
                        <div class="user-dropdown-menu dropdown-menu-disabled" id="dropdown-menu">
                            <a href="{{ route('profile') }}" class="dropdown-item">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                Logout
                            </a>
                            <form method="POST" id="logout-form" action="{{ route('logout') }}">
                                @csrf
                            </form>
                        </div>
                    </li>
                @elseguest
                    @if (Route::has('login'))
                        <li class="navbar-menu-item">
                            <a href="{{ route('login') }}" role="button" id="alertsDropdown" data-toggle="dropdown" class="item-link" aria-haspopup="true" aria-expanded="false">Login</a>
                        </li>
                    @endif
                    @if (Route::has('register'))
                        <li class="navbar-menu-item">
                            <a href="{{ route('register') }}" role="button" id="alertsDropdown" data-toggle="dropdown" class="item-link" aria-haspopup="true" aria-expanded="false">Register</a>
                        </li>
                    @endif
                @endguest
            </ul>
        </nav>
    </div>
{{--</div>--}}
