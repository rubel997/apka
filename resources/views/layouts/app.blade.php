<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->

    <!-- Styles -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ mix('/js/app.js') }}" defer></script>
</head>
<body>

@if ($flash = session('status'))
    @if (!empty($flash['type']) && !empty($flash['message']))
        <div id="flash-message" class="alert alert-{{ $flash['type'] }}" role="alert">
            {{ $flash['message'] }}
        </div>
    @endif
@endif
<nav class="navbar navbar-inverse visible-xs">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name', 'Laravel') }}</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                @include('layouts.nav')
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-nav-form').submit();">
                        {{ __('Wyloguj') }}
                    </a>

                    <form id="logout-nav-form" action="{{ route('logout') }}" method="POST"
                          style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row content">
        @auth
            <header class="navbar navbar-expand-md navbar-light navbar-laravel hidden-xs">
                <div class="navbar-brand navbar-logo">
                    <a href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>
                <div class="collapse navbar-collapse pull-right" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Witaj, {{ auth()->user()->name }} {{ auth()->user()->last_name }} <span
                                    class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <ul>
                                    <li>
                                        <a href="{{ route('user.edit', ['id' => auth()->user()->id]) }}">Edytuj</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Wyloguj') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </header>
        @endauth
        <div class="col-sm-3 sidenav hidden-xs">
            @guest
                <h2>{{ config('app.name', 'Laravel') }}</h2>
            @endguest
            <ul class="nav nav-pills nav-stacked">
                @include('layouts.nav')
            </ul>
        </div>
        <br>

        <div class="col-sm-9 content-laravel">
            <div class="col-sm-12">
                @yield('content')
            </div>
        </div>
    </div>
</div>

</body>
</html>
