<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/resume.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    @yield('style')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
            <a class="navbar-brand">
                {{--  <span class="d-none d-lg-block">
                    <img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="{{ asset('img/profile.jpg') }}" alt="">
                </span>  --}}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    {{-- <li><a href="{{ route('register') }}">Register</a></li> --}}
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item submenu">
                        <a class="nav-link li-dd" href="#">Equipment</a>
                        <ul class="ul_submenu list-unstyled">
                            <li class="nav-item list-bright"><a class="nav-link" href="{{ route('equipment.index') }}">List All</a></li>
                            <li class="nav-item list-bright"><a class="nav-link" href="{{ route('equipment.defective') }}">Defective</a></li>
                            {{--  <li class="nav-item list-bright"><a class="nav-link" href="{{ route('equipment.create') }}">New Equipment</a></li>  --}}
                            <li class="nav-item list-bright"><a class="nav-link" href="{{ route('category.index') }}">Categories</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('borrowing.borrow') }}">Borrow</a>
                    </li>
                    <li class="nav-item submenu">
                        <a class="nav-link li-dd" href="#">List</a>
                        <ul class="ul_submenu list-unstyled">
                            <li class="nav-item list-bright"><a class="nav-link" href="{{ route('borrowing.index') }}">All</a></li>
                            <li class="nav-item list-bright"><a class="nav-link" href="{{ route('borrowing.uncompleted') }}">Uncompleted</a></li>
                            <li class="nav-item list-bright"><a class="nav-link" href="{{ route('borrowing.history') }}">Histories</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('borrower.index') }}">Borrowers</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    @endguest
                </ul>
            </div>
        </nav>

        <div class="resume-section p-3 p-lg-5 d-flex d-column my-auto">
            <div class="container">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    {{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>  --}}
    {{--  <script src="{{ asset('js/app.js') }}"></script>  --}}
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/resume.js') }}"></script>
    <script src="{{ asset('js/disableAutoFill.js') }}"></script>

    @yield('script')

</body>

</html>