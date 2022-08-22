<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ str_replace('-', ' ', env('APP_NAME')) }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex gap-2 align-items-center me-4" href="{{ url('/') }}">
                    <img src="{{ asset('img/logo.png') }}" alt="" width="60" height="48"
                        class="d-inline-block align-text-top">
                    <span class="fw-bold">
                        {{ str_replace('-', ' ', env('APP_NAME')) }}
                    </span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            @if (Auth::user()->level == 'pelanggan')
                                <form method="POST" action="" class="d-flex" role="search">
                                    @csrf
                                    <input name="keyword" size="40" class="form-control me-2" type="search"
                                        placeholder="Search Product...">
                                </form>
                            @endif

                            @if (Auth::user()->level == 'admin')
                                <li class="nav-item me-3">
                                    <a class="nav-link" href="{{ url('/') }}">
                                        Beranda
                                    </a>
                                </li>
                                <li class="nav-item me-3">
                                    <a class="nav-link" href="{{ url('/') }}">
                                        Barang
                                    </a>
                                </li>
                                <li class="nav-item me-3">
                                    <a class="nav-link" href="{{ url('/') }}">
                                        Biaya Pengiriman
                                    </a>
                                </li>
                                <li class="nav-item me-3">
                                    <a class="nav-link" href="{{ url('/') }}">
                                        Transaksi
                                    </a>
                                </li>
                                <li class="nav-item me-3">
                                    <a class="nav-link" href="{{ url('/') }}">
                                        Komentar
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @auth
                            @if (Auth::user()->level == 'pelanggan')
                                <li class="nav-item me-3">
                                    <a class="nav-link" href="{{ url('/') }}">
                                        Beranda
                                    </a>
                                </li>
                                <li class="nav-item me-3">
                                    <a class="nav-link" href="{{ url('/') }}">
                                        Profile
                                    </a>
                                </li>
                                <li class="nav-item me-3">
                                    <a class="nav-link" href="{{ url('/') }}">
                                        Cara Pembelian
                                    </a>
                                </li>
                            @endif
                        @endauth
                        <!-- Authentication Links -->
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @auth
                                        @if (Auth::user()->level == 'pelanggan')
                                            <a class="dropdown-item" href="{{ url('') }}">
                                                Dashboard
                                            </a>
                                            <a class="dropdown-item" href="{{ url('') }}">
                                                Keranjang
                                            </a>
                                        @endif
                                        @if (Auth::user()->level == 'admin')
                                            <a class="dropdown-item" href="{{ url('') }}">
                                                Pengaturan
                                            </a>
                                        @endif
                                    @endauth
                                    <hr class="dropdown-divider">
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

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
