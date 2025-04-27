<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Articles Totals</title>
    <link rel="stylesheet" href="{{ asset('css/estilsFinals.css') }}"> 
</head>
<body>
    <a href="#main-content" class="skip-link">Saltar al contingut principal</a>

    <header>
        <div class="logo">
            Hola! {{ Auth::user()->nom ?? 'Usuari' }}
        </div> 

        <div class="signin-form">
            <form action="{{ route('inserirArticles') }}">
                <input class="botons" type="submit" value="Inserir Article">
            </form>
        </div>

        <div class="signin-form">
            <div class="dropdown">
                <button class="dropbtn">Compte</button>
                <div class="dropdown-content" tabindex="0">
                    <a href="{{ route('perfil') }}">Perfil</a>
                    <a href="{{ route('infoApi') }}">Informació API</a>
                    <a href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <div class="margin">
        <h1 class="notfound">Articles</h1>

        <form method="GET">
            <div class="selector">
                <label for="articlesPerPagina" class="labelArticles">Quantitat Articles (Per Pàgina):</label>
                <select class="botons" id="articlesPerPagina" name="articlesPerPagina" onchange="this.form.submit()">
                    @foreach([5, 10, 15, 20, 25, 30] as $option)
                        <option value="{{ $option }}" {{ request('articlesPerPagina') == $option ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
            </div>

            <div class="selector">
                <label for="ordreArticles">Ordenar Articles</label>
                <select class="botons" name="ordreArticles" id="ordreArticles" onchange="this.form.submit()">
                    <option value="asc" {{ request('ordreArticles') == 'asc' ? 'selected' : '' }}>Ascendent (Nom)</option>
                    <option value="desc" {{ request('ordreArticles') == 'desc' ? 'selected' : '' }}>Descendent (Nom)</option>
                </select>
            </div>
        </form>

        <div class="articlesTotals" id="main-content">
            @forelse($articles as $article)
                <div class="articles" tabindex="0">
                    <h2 tabindex="0">{{ $article->nom }}</h2>
                    <p tabindex="0">{{ $article->descripcio }}</p>

                   
                    <form action="{{ route('articles.edit', ['id' => $article->id]) }}" method="GET" style="display: inline;">
                        <button type="submit" class="botons">Editar</button>
                    </form>

                    
                    <form action="{{ route('articles.delete', ['id' => $article->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="botons" onclick="return confirm('Estàs segur que vols eliminar aquest article?')">Eliminar</button>
                    </form>
                </div>
            @empty
                <p class="notfound">No s'han trobat articles.</p>
            @endforelse
        </div>

        <!-- Paginación -->
        <div class="paginacio">
            @if($articles->currentPage() > 1)
                <a href="{{ $articles->previousPageUrl() }}"> < </a>
            @else
                <button disabled> < </button>
            @endif

            @foreach(range(1, $articles->lastPage()) as $page)
                <a href="{{ $articles->url($page) }}" class="{{ $page == $articles->currentPage() ? 'active' : '' }}">{{ $page }}</a>
            @endforeach

            @if($articles->currentPage() < $articles->lastPage())
                <a href="{{ $articles->nextPageUrl() }}"> > </a>
            @else
                <button disabled> > </button>
            @endif
        </div>

        <form action="{{ route('home') }}">
            <input class="botons" type="submit" value="Tornar">
        </form>
    </div>
</body>
</html>