<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Finances @section('title')@show</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body  style="background-color: #b3c3d3; min-height: 100vh">
@section('menu')
    <nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #4a5568; padding: 15px 50px">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}" >My Finances</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarText" >
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @if (auth()->check() && auth()->user()->role == 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Категорії</a>
                        </li>
                    @endif
                    @if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->role == 'user'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Джерела доходу</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Гаманці</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Операції</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Фінансовий план</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        <div>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item" style="width: 65px">
                    <a class="nav-link" href="{{ url('/login') }}">Вхід</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/register') }}">Реєстрація</a>
                </li>
            </ul>
        </div>
        </div>
    </nav>
@show

<main>
    {{-- Content --}}
    @yield('content')
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
