<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Articles Totals</title>
    <link rel="stylesheet" href="{{ asset('css/estilsFinals.css') }}">
</head>
<body>
    @include('components.navbar')
    <a href="#main-content" class="skip-link">Saltar al contingut principal</a>
    <div class="margin">
        <div class="search-bar">
            <form id="searchForm" method="GET">
                <input type="text" name="buscar" placeholder="Escriu el valor a cercar..." value="{{ request('buscar') }}">
                <button type="submit"><img class="icon" src="{{ asset('img/icons/lupa.png') }}" alt="boto buscar"></button>
            </form>
        </div>
        
        <div class="centrar">
            <form method="GET">
                <input type="hidden" name="buscar" value="{{ request('buscar') }}">
                <div class="selector">
                    <label for="articlesPerPagina">Quantitat Articles (Per Pàgina):</label>
                    <select class="botons" id="articlesPerPagina" name="articlesPerPagina" onchange="this.form.submit()">
                        @foreach ([5, 10, 15, 20, 25, 30] as $option)
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
        </div>
        
        <div class="articlesTotals" id="main-content">
            @if($articles->isEmpty())
                <p class="notfound">No s'han trobat resultats</p>
            @else
                @foreach ($articles as $article)
                    <div class="articles" tabindex="0">
                        <h2 tabindex="0">{{ $article->nom }}</h2>
                        <p tabindex="0">{{ $article->descripcio }}</p>
                        <p tabindex="0"><b>Autor:</b> {{ $article->autor }}</p>
                        <div class="gestio">
                            
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        
        {{ $articles->appends(['buscar' => request('buscar'), 'articlesPerPagina' => request('articlesPerPagina'), 'ordreArticles' => request('ordreArticles')])->links() }}
        
        <form action="{{ route('home') }}">
            <input class="botons" type="submit" value="Tornar">
        </form>
    </div>
</body>
</html>