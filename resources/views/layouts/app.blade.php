<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- ... Bagian-bagian head lainnya ... -->
    <link rel="icon" href="{{ asset('image/logoptpn4.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('image/logoptpn4.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->

    <link rel="stylesheet" href="{{asset('build/assets/app-lhA9k1qk.css')}}">




    {{-- Icons --}}


    <style>
    .containerr{
        margin-top: 200px
    }

    .atas{
        padding-top: 120px;
    }

    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar fixed-top navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand pt-2" href="{{ url('/') }}">
                    <img src="{{ asset('image/logo-ptpn4.jpg') }}" alt="Logo" height="60px"
                /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @if (Auth::check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('penempatan.index')}}">{{ __('Penempatan') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('asal_sekolah.index')}}">{{ __('Asal Sekolah') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('siswa.index')}}">{{ __('Data Siswa') }}</a>
                            </li>
                        @endif
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('/') }}">
                                        {{ __('Dashboard') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

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
        <main class="atas">
            @yield('content')
        </main>

        <script src="{{asset('build/assets/app-W7Y791fY.js')}}"></script>

    </div>

    <script src="{{asset('build/assets/app-W7Y791fY.js')}}"></script>

    <footer class="containerr bg-dark text-light text-center py-5">
        <div class="container pt-4">
            <p>&copy; {{ date('Y') }} PT Perkebunan Nusantara IV | Phoenix. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>
