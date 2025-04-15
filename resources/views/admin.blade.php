<!-- ALVARO GOMEZ -->

@php
    use Illuminate\Support\Facades\DB;

    if (!session()->has('nom')) {
        header("Location: ./vistaLogin.php");
        exit();
    } else {
        $user = DB::table('users')->where('nom', session('nom'))->first();
        if (!$user || $user->role != 'admin') {
            header("Location: ../index.php");
            exit();
        }
    }
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estils/estilsFinals.css"> <!-- Estils css (diferents als altres) -->
    <title>Articles Totals</title>
</head>
<body>
<a href="#main-content" class="skip-link">Saltar al contingut principal</a>
<header> <!-- Header que veurà l'usuari una vegada ja logat -->
    <div class="logo">Admin panel</div>
   
    <div>
        <form action="{{ url('../vista/vistaInserir.php') }}">
            <input class="botons" type="submit" value="Inserir Article"> <!-- Redirecciona a la vista per inserir un article -->
        </form>
    </div>
    <div>
        <form action="{{ url('../vista/vistaGestioUsuaris.php') }}">
            <input class="botons" type="submit" value="Gestió Usuaris">
        </form>
    </div>
   
    <div class="signin-form">
        <div>
            <div class="dropdown">
                <button class="dropbtn">Compte</button>
                <div class="dropdown-content">
                    <a href="{{ url('../vista/vistaModificarPerfil.php') }}">Perfil</a>
                    <a href="{{ url('../vista/vistaInformacioApi.php') }}">Informació API</a>
                    <a href="{{ url('../controlador/logout.php') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>
</header>

<h1 class="notfound">ARTICLES</h1>

<div class="articlesTotals" id="main-content">
    @if ($articles)
        @foreach ($articles as $article)
            <div class="articles" tabindex="0">
                <h2 tabindex="0">{{ htmlspecialchars($article['nom']) }}</h2>
                <p tabindex="0">{{ htmlspecialchars($article['descripcio']) }}</p>
                <p tabindex="0">ID Autor: {{ htmlspecialchars($article['id_usuari']) }}</p>
            </div>
        @endforeach
    @else
        <p class="notfound">No s'han trobat resultats</p>
    @endif
</div>

@if ($articlesTotals > 0)
    @php
        $numPagines = ceil($articlesTotals / $articlesPerPagina);
    @endphp

    <div class="paginacio">
        @if ($paginaActual > 1)
            <a href="?pagina={{ $paginaActual - 1 }}&articlesPerPagina={{ $articlesPerPagina }}"><</a>
        @else
            <button disabled><</button>
        @endif

        @for ($i = 1; $i <= $numPagines; $i++)
            @if ($i == $paginaActual)
                <a class="active">{{ $i }}</a>
            @else
                <a href="?pagina={{ $i }}&articlesPerPagina={{ $articlesPerPagina }}">{{ $i }}</a>
            @endif
        @endfor

        @if ($paginaActual < $numPagines)
            <a href="?pagina={{ $paginaActual + 1 }}&articlesPerPagina={{ $articlesPerPagina }}">></a>
        @else
            <button disabled>></button>
        @endif
    </div>
@endif

</body>
</html>