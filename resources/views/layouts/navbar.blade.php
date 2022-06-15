<!-- Main Navbar Mobile -->
<b class="screen-overlay"></b>
<nav class="navbar2 navbar d-lg-none fixed-top navbar-expand-lg bg-black navbar-dark">
    <div class="container">
        <button data-trigger="#navbar_main" class="navbar-toggler pl-0" type="button"><span
                class="fas fa-bars text-white"></span></button>
        <a class="navbar-brand mx-auto py-2" href="{{ url('/') }}">
            <h4 class="no-pm">Mokumovies</h4>
        </a>
    </div>
</nav>

<!-- Main Navbar -->
<nav id="navbar_main" class="mobile-offcanvas navbar navbar-dark navbar-transparent fixed-top navbar-expand-lg">
    <div class="container nav-cont">
        <a class="navbar-brand d-none d-lg-block" href="{{ url('/') }}">
            <h4 class="no-pm">Mokumovies</h4>
        </a>
        <div class="offcanvas-header">
            <button class="navbar-toggler btn-close"><span class="fas fa-bars"></span></button>
        </div>
        <ul class="navbar-nav">
            <li class="nav-item py-2">
                <a class="nav-link text-white {{ request()->is('browse') || request()->is('browse/*') ? 'font-weight-bold' : '' }}"
                    href="{{ url('/') }}">Home</a>
            </li>
            @guest
            <li class="nav-item py-2">
                <a class="nav-link text-white {{ request()->is('browse') || request()->is('browse/*') ? 'font-weight-bold' : '' }}"
                    href="{{ url('/login') }}">Login</a>
            </li>
            <li class="nav-item py-2 dropdown">
                <a class="nav-link text-white" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false"> {{ config('language')[App::getLocale()] }}
                    <span class="no-pm"> <i
                            class="fas fa-chevron-down"></i></span>
                </a>
                <div class="dropdown-menu">
                    @foreach (config('language') as $lang => $language)
                        @if ($lang != App::getLocale())
                            <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"> {{$language}}</a>
                        @endif
                    @endforeach
                </div>
            </li>
            @else
            <li class="nav-item py-2">
                <a class="nav-link text-white {{ request()->is('browse') || request()->is('browse/*') ? 'font-weight-bold' : '' }}"
                    href="{{ route('favorite') }}">{{__('lang.navbar.favorite')}}</a>
            </li>

            @php
            $fullname = auth()->user()->name;
            $fullname = trim($fullname); // remove double space
            $firstname = substr($fullname, 0, strpos($fullname, ' '));
            $lastname = substr($fullname, strpos($fullname, ' '), strlen($fullname));
            @endphp
            <li class="nav-item py-2 dropdown">
                <a class="nav-link text-white" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false"> {{ $fullname }}
                    <span class="no-pm">{{ Str::upper(auth()->user()->username) }} <i
                            class="fas fa-chevron-down"></i></span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="#">
                        {{__('lang.navbar.logout')}}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest
        </ul>
    </div>

</nav>