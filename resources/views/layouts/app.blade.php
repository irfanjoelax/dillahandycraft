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

    <!-- Font Awesome -->
    <link href="{{ asset('css/fontawesome/css/all.min.css') }}" rel="stylesheet">

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
                                @include('layouts._form-search')
                            @endif

                            @if (Auth::user()->level == 'admin')
                                <li class="nav-item me-3">
                                    <a class="nav-link" href="{{ url('/') }}">
                                        <i class="fa-solid fa-fire-flame-curved"></i>
                                        <span class="ms-1">Beranda</span>
                                    </a>
                                </li>
                                <li class="nav-item me-3">
                                    <a class="nav-link" href="{{ url('/admin/kategori') }}">
                                        <i class="fa-solid fa-rectangle-list"></i>
                                        <span class="ms-1">Kategori</span>
                                    </a>
                                </li>
                                <li class="nav-item me-3">
                                    <a class="nav-link" href="{{ url('/') }}">
                                        <i class="fa-solid fa-box-open"></i>
                                        <span class="ms-1">Barang</span>
                                    </a>
                                </li>
                                <li class="nav-item me-3">
                                    <a class="nav-link" href="{{ url('/') }}">
                                        <i class="fa-solid fa-truck-fast"></i>
                                        <span class="ms-1">Biaya Pengiriman</span>
                                    </a>
                                </li>
                                <li class="nav-item me-3">
                                    <a class="nav-link" href="{{ url('/') }}">
                                        <i class="fa-solid fa-file-invoice-dollar"></i>
                                        <span class="ms-1">Transaksi</span>
                                    </a>
                                </li>
                                <li class="nav-item me-3">
                                    <a class="nav-link" href="{{ url('/') }}">
                                        <i class="fa-solid fa-comments"></i>
                                        <span class="ms-1">Komentar</span>
                                    </a>
                                </li>
                            @endif
                        @endauth

                        @guest
                            @include('layouts._form-search')
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @auth
                            @if (Auth::user()->level == 'pelanggan')
                                @include('layouts._nav-pelanggan')
                            @endif
                        @endauth

                        @guest
                            @include('layouts._nav-pelanggan')
                        @endguest

                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item me-3">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="fa-solid fa-right-to-bracket"></i>
                                        <span class="ms-1">
                                            {{ __('Login') }}
                                        </span>
                                    </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        <i class="fa-solid fa-user-plus"></i>
                                        <span class="ms-1">
                                            {{ __('Register') }}
                                        </span>
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa-solid fa-circle-user"></i>
                                    <span class="ms-1">
                                        {{ Auth::user()->name }}
                                    </span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @auth
                                        @if (Auth::user()->level == 'pelanggan')
                                            <a class="dropdown-item" href="{{ url('') }}">
                                                <i class="fa-solid fa-fire-flame-curved"></i>
                                                <span class="ms-1">Dashboard</span>
                                            </a>
                                            <a class="dropdown-item" href="{{ url('') }}">
                                                <i class="fa-solid fa-basket-shopping"></i>
                                                <span class="ms-1">Keranjang</span>
                                            </a>
                                        @endif
                                        @if (Auth::user()->level == 'admin')
                                            <a class="dropdown-item" href="{{ url('') }}">
                                                <i class="fa-solid fa-gear"></i>
                                                <span class="ms-1">Pengaturan</span>
                                            </a>
                                        @endif
                                    @endauth
                                    <hr class="dropdown-divider">
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-right-from-bracket"></i>
                                        <span class="ms-1">
                                            {{ __('Logout') }}
                                        </span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
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

        <!-- Javascript -->
        @include('sweetalert::alert')
    </div>
</body>

</html>
