<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('img/amarguru_logo_w.png') }}" style="width:100px; height:auto;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
            
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li>
                <form action="/professors/search" method="POST" class="form-inline">
                {{ csrf_field() }}
                <input class="form-control mr-sm-2" name="q" type="search" placeholder="Search" aria-label="Search" value="{{ old('q') }}">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
                </li>
                
                @auth
                
                <li>
                <a class="btn btn-outline-success my-2 my-sm-0" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
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
