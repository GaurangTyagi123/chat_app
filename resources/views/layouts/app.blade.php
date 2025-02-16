<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto:200,400,600|Poppins:200,400,600|Germania">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @viteReactRefresh
    @vite(['resources/sass/app.scss', 'resources/js/app.jsx'])
</head>

<body>
    <div id="app">
        <nav class="navbar">
            <div class="navbar__container">
                <a class="navbar__brand">
                    {{ config('app.name', 'Laravel') }}
                    <svg class="navbar__arrow">
                        <use xlink:href="http://localhost:8000/icons/sprite.svg#icon-arrow-right"></use>
                    </svg>
                </a>

                <!-- Right Side Of Navbar -->
                <ul class="navbar__list">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="navbar__list__item navbar__list__item--highlight">
                                <a class="navbar__link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="navbar__list__item">
                                <a class="navbar__link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="navbar__list__item">
                            <a class="navbar__link navbar__link--logout" onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();"
                                title="logout">
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
    </div>
    </nav>
    @yield('content')
    </div>
    @yield('scripts')

</body>

</html>