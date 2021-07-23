<nav class="navbar blue-grey darken-2">
    <div class="container">
        <div class="nav-wrapper">
            <a href="/" class="brand-logo">
                <img src="{{ asset('img/amarguru_logo_w.png') }}" style="width:140px; height:auto;" alt="AmarGuru">
            </a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger white-text"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
{{--                <li><a href="/" class="white-text" ><i class="material-icons left">business</i>Universities</a></li>--}}
                <li><a href="/help" class="white-text" ><i class="material-icons left">help_outline</i>Help</a></li>
                @auth  
                <li>
                <a href="{{ route('logout') }}" class="white-text"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    <i class="material-icons left">power_settings_new</i>
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<ul class="sidenav" id="mobile-demo">
{{--    <li><a href="#"><i class="material-icons left">business</i>Universities</a></li>--}}
    <li><a href="/help"><i class="material-icons left">help_outline</i>Help</a></li>
    @auth  
    <li>
    <a href="{{ route('logout') }}"
        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
        <i class="material-icons left">power_settings_new</i>
        Logout
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    </li>
    @endauth
</ul>

