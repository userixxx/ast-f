<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="margin:0; padding:0;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="container" >
        <div class="row">
            <div class="col">
                <div class="d-flex flex-column justify-content-center align-items-center pt-5">
                    <figure class="figure">
                        <img src="/img/ast.png" class="figure-img img-fluid rounded" alt="АгроСтарТрейдинг">
                    </figure>
                    <h1 class="display-1 text-black text-opacity-75 text-center">Агро Стар Трейдинг</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div>
                    @if (Route::has('login'))
                        <div class="d-flex justify-content-center">
                            @auth
                                <a href="{{ url('/home') }}" class="btn btn-outline-dark btn-lg mx-3 my-2">Домашняя страница</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-outline-dark btn-lg mx-3 my-2">Войти</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                       class="btn btn-outline-dark btn-lg mx-3 my-2">Регистрация</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</body>
</html>
