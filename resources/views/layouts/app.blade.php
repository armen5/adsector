<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AdSector') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ url('css/font-awesome.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/style.css') }}" />
</head>
<body class="{{ (Request::is('login') || Request::is('register') || Request::is('password/reset')) ? 'auth-container' : ''}}">
    <div id="app">
        @if(Request::is('login') || Request::is('register') || Request::is('password/reset'))
            <header id = "auth_menu" class = "page-header">
                <div class="logo-wrapper">
                    <img src="/images/logo.png">
                </div>
                <div class="rigth-wrapper"></div>
            </header>
        @else
            <nav id = "menu" class="navbar navbar-expand-md navbar-light navbar-laravel">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="/images/logo.png" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto menu-content">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item"><a href="/about" class="lt1 nav-link">About</a></li>
                                <li class="nav-item"><a href="/features" class="lt1 nav-link">Features</a></li>
                                <li class="nav-item">
                                    <a class="nav-link login_btn_style" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
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
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        @endif
        

        <main class="">
            @yield('content')
        </main>
    </div>
    <footer class="{{ (Request::is('login') || Request::is('password/reset') || Request::is('register')) ? 'hidden' : '' }}">
        <div class="container">
            <ul class="list-ftr">
                <li><a href="/terms" rel="nofollow">Terms</a></li>
                <li><a href="/refunds" rel="nofollow">Refunds</a></li>
            </ul>
            <p class="p1-ftr">Copyright © 2018 AdSector</p>
        </div>
    </footer>
</body>
</html>
