<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/estilsForms.css') }}">
    <title>Editar Article</title>
</head>
<body>
    <div class="container">
        <h2>Editar Article</h2>
        <form action="{{ route('articles.update', ['id' => $article->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" value="{{ $article->nom }}" required>

            <label for="descripcio">Descripció:</label>
            <textarea id="descripcio" name="descripcio" rows="4" required>{{ $article->descripcio }}</textarea>

            <button type="submit" class="botons">Guardar Canvis</button>
        </form>

        <form action="{{ route('dashboard') }}">
            <button type="submit" class="botons">Tornar</button>
        </form>
    </div>
</body>
</html>