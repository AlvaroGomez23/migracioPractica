<!-- ALVARO GOMEZ -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/estilsFinals.css') }}"> <!-- Estils css -->
    <title>Articles Totals</title>
</head>
<body>
<a href="#main-content" class="skip-link">Saltar al contingut principal</a>
<header>
    <div class="logo">Admin panel</div>
    <div>
    </div>
    <div>
        <form action="{{ route('gestioUsers') }}" method="GET" class="form">
            <input class="botons" type="submit" value="Gestió Usuaris">
        </form>
    </div>
    <div class="signin-form">
        <div class="dropdown">
            <button class="dropbtn">Compte</button>
            <div class="dropdown-content">
                <a href="{{ route('perfil') }}">Perfil</a>
                <a href="{{ route('infoApi') }}">Informació API</a>
                <a href="{{ route('logout') }}">Logout</a>
            </div>
        </div>
    </div>
</header>

<h1 class="notfound">ARTICLES</h1>

<div class="articlesTotals" id="main-content">
    @if ($articles->isEmpty())
        <p class="notfound">No s'han trobat resultats</p>
    @else
        @foreach ($articles as $article)
            <div class="articles" tabindex="0">
                <h2 tabindex="0">{{ $article->nom }}</h2>
                <p tabindex="0">{{ $article->descripcio }}</p>
                <p tabindex="0">ID Autor: {{ $article->id_usuari }}</p>
            </div>
        @endforeach
    @endif
</div>

<!-- Paginació -->
@if ($articles->total() > 0)
    <div class="paginacio">
        {{ $articles->links('pagination::bootstrap-4') }}
    </div>
@endif

</body>
</html>