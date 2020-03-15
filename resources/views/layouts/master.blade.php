<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    @isset($categorias)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Categorias
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach ($categorias as $cat)
                                    <a class="dropdown-item" href="{{ route('publico.categoria', $cat) }}">{{ $cat->nome }}</a>
                                @endforeach
                            </div>
                        </li>
                    @endisset
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('publico.carrinho.index') }}">Carrinho</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('publico.conta.index') }}">Sua Conta</a>
                    </li>
                    @if(Auth::user())
                        <li class="nav-item">
                            <a class="nav-link text-light" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Sair
                            </a>
                            <form id="logout-form" action="{{ route("logout") }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('conteudo')
    </div>

    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
