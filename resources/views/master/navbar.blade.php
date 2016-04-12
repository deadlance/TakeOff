<div class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">4CH Takeoff</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                @if (Sentry::check() && Sentry::getUser()->hasAccess('admin'))
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">User Admin Menu
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li {!! (Request::is('users*') ? 'class="active"' : '') !!}><a
                                        href="{{ action('\\Sentinel\Controllers\UserController@index') }}">Users</a>
                            </li>
                            <li {!! (Request::is('groups*') ? 'class="active"' : '') !!}><a
                                        href="{{ action('\\Sentinel\Controllers\GroupController@index') }}">Groups</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Assembly Menu
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/building_materials">Building Materials</a></li>
                            <li><a href="#">Takeoffs</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Sentry::check())
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Account
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li {!! (Request::is('profile') ? 'class="active"' : '') !!}><a
                                        href="{{ route('sentinel.profile.show') }}">Profile</a></li>
                            <li><a href="{{ route('sentinel.logout') }}">Logout</a></li>
                        </ul>
                    </li>
                @else
                    <li {!! (Request::is('login') ? 'class="active"' : '') !!}><a href="{{ route('sentinel.login') }}">Login</a>
                    </li>
                    <li {!! (Request::is('users/create') ? 'class="active"' : '') !!}><a
                                href="{{ route('sentinel.register.form') }}">Register</a></li>
                @endif
            </ul>
        </div>
    </div>
</div>