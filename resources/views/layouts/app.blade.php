<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <title>Анализатор страниц</title>
</head>
<body class="d-flex min-vh-100 flex-column">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ route('urls.create') }}">Анализатор страниц</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item @yield('page_main')">
                        <a class="nav-link" href="{{ route('urls.create') }}">Главная<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item @yield('page_sites')">
                        <a class="nav-link" href="{{ route('urls.index') }}">Сайты</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main class="flex-grow-1">
        @include('flash::message')
        @yield('content')
    </main>
    <footer class="border-top py-3 mt-5 flex-shrink-0">
        <div class="container-lg">
            <div class="text-center">
                created by
                <a class="text-info" href="https://ru.hexlet.io/u/inqast" target="_blank">Inqast</a>
            </div>
        </div>
    </footer>
</body>
</html>