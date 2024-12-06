<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Film - @yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <style>
        /* Sticky Footer Styles */
        html, body {
            height: 100%;
            margin: 0;
        }
        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .content {
            flex: 1 0 auto;
        }
        .footer {
            flex-shrink: 0;
            background-color: #212529;
            color: white;
            padding: 1rem 0;
            width: 100%;
            position: sticky;
            bottom: 0;
            z-index: 1000;
        }
    </style>

    <!-- Custom CSS -->
    @yield('styles')
</head>

<body>
    <div class="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">Rental Film</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('films.index') }}">Films</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('customers.index') }}">Customers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('rentals.index') }}">Rentals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('sales.index') }}">Sales</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto">
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

        <!-- Main Content -->
        <!-- Di layout.blade.php -->
<div class="content container-fluid mt-0 p-0 @if(Request::is('films*')) dark-theme @endif">
    <div class="container-fluid px-4 py-4 @if(Request::is('films*')) dark-theme @endif">
        @yield('content')
    </div>
</div>

<!-- Tambahkan style di head -->
<style>
    /* Style default putih */
    body {
        background-color: #ffffff;
        color: #000000;
    }

    /* Style khusus films */
    .dark-theme {
        background-color: #141414 !important;
        color: #ffffff;
    }

    .dark-theme .card {
        background-color: #1e1e1e;
        color: #ffffff;
        border: none;
    }

    .dark-theme .table {
        color: #ffffff;
    }

    .dark-theme .table thead {
        color: #ffffff;
    }
</style>

        <!-- Footer -->
        <footer class="footer text-center">
            <div class="container">
                <p class="mb-0">&copy; {{ date('Y') }} Rental Film. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    @yield('scripts')
</body>

</html>
