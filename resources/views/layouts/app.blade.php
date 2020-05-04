<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Student Gigs </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css?family=Questrial&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .list-group {
            overflow: scroll;
            height: 200px;
        }
        #time {
            font-size: 10px;
            margin-top: 10px;
            color: black;
        }
        
        </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                   <h5>Student Gigs</h5>
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
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        
                        @endguest
                        
                        @auth
                        @if(auth()->user()->user_type=="Client")
                        <li class="nav-item">
                            <a class="nav-link" href="/cdashboard">
                                    Home
                                </a>
                            </li>

                        <li class="nav-item">
                        <a class="nav-link" href="/gigs">
                                Post a Job 
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/cshow">
                                    Jobs
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="/bshow">
                                        Review bids
                                    </a>
                                </li>
                                <li class="nav-item">
                                        <a class="nav-link" href="/todo/create">
                                                Milestones
                                            </a>
                                        </li>
                            <br>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>

                        @elseif(auth()->user()->user_type=="Freelancer")
                        <li class="nav-item">
                            <a class="nav-link" href="/fdashboard">
                                    Find Gig
                                </a>
                            </li>

                        <li class="nav-item">
                        <a class="nav-link" href="/fbids">
                                Proposals
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/messages">
                                    Messages
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/vportfolio">
                                        Portfolio
                                    </a>
                                </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endif
                            @endauth
                    </ul>
                </div>
            </div>
        </nav>
        @if ( Session::has('flash_message') )
 
        <div class="alert {{ Session::get('flash_type') }}">
            <h3>{{ Session::get('flash_message') }}</h3>
        </div>
        
      @endif
        <main class="py-4">
            @yield('content')
        </main>
        
    </div>
</body>
</html>
