<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Call-a-Car</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>
    @include("delete_modal_html")
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Call-a-Car 🚗
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
                        @if(Auth::guard('employee')->check())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('clients') }}"><i class="fas fa-users"></i> {{ __('Klanten') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('employees') }}"><i class="fas fa-user-tie"></i> {{ __('Medewerkers') }}</a>
                            </li>
                        @endif
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> {{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"><i class="fas fa-user-plus"></i> {{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('rides') }}"><i class="fas fa-location-arrow"></i> {{ __('Ritten') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cars') }}"><i class="fas fa-car"></i> {{ __('Auto\'s') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('privacy') }}"><i class="fas fa-user-secret"></i> {{ __('Privacy') }}</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-user-circle"></i> {{ ucfirst(Auth::user()->name) }} <span class="caret"></span>
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

        <main class="py-4">
            <div class="container">
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        <ul>
                            <il><p>{{ session('success') }}</p></il>
                        </ul>
                    </div>
                @endif
                @if(isset($errors) && count($errors) > 1)
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            <?php
                            foreach ($errors->all() as $message) {
                                echo "<il><p>" . $message . "</p></il>";
                            }
                            ?>
                        </ul>
                    </div>
                @endif
                <div class="row justify-content-between">
                    <div class="col-md-6">
                        @if(isset($object_name) && $object_name)
                            <button type="submit" class="btn btn-primary" onclick="window.location.href='/{{ $object_name }}/create'" title="Nieuwe {{ $object_name_nl }}"><i class="fas fa-edit"></i>Nieuwe {{ $object_name_nl }}</button>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="row pull-right">
                            {{--<div class="col-6">--}}
                                {{--<form action="#" id="paginateForm">--}}
                                    {{--<div class="form-group"><label for="result_amount">Resultaten per pagina</label>--}}
                                        {{--<select name="result_amount" id="result_amount" class="custom-select result-amount-select">--}}
                                            {{--<option value="25">25</option>--}}
                                            {{--<option value="50">50</option>--}}
                                            {{--<option value="100">100</option>--}}
                                            {{--<option value="150">150</option>--}}
                                            {{--<option value="200">200</option>--}}
                                            {{--<option value="250">250</option>--}}
                                            {{--<option value="500">500</option>--}}
                                            {{--<option value="750">750</option>--}}
                                            {{--<option value="1000">1000</option>--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</form>--}}
                            {{--</div>--}}
                            {{--<div class="col-6">--}}
                                {{--{{ $object->links() }}--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
                <div class="title row justify-content-between">
                    <h2>@yield('title_register')</h2>
                </div>
                    @yield('content')
                <div class="footer pull-right">
                    {{ $object->links() }}
                </div>
            </div>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="{{URL::asset('js/script.js')}}"></script>
</body>
</html>
