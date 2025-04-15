<!-- filepath: c:\laragon\www\migracioPractica\resources\views\inserirArticles.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/estilsForms.css') }}"> <!-- Estils css -->
    <title>Inserir Articles</title>
</head>
<body>
    <div>
        <h1>INSERTAR ARTICLES</h1>

        <!-- Mostrar mensaje de éxito -->
        

        <div class="container">
            <form class="formUsuari" method="POST" action="{{ route('articles.store') }}">
                @csrf <!-- Protección contra CSRF -->

                <label for="nom">Nom:</label>
                <input class="input-field" type="text" id="nom" name="nom" value="{{ old('nom') }}" required> <!-- Input pel nom -->
                @error('nom')
                    <div class="error">{{ $message }}</div>
                @enderror

                <label for="descripcio">Descripció:</label>
                <textarea id="descripcio" name="descripcio" rows="4" required>{{ old('descripcio') }}</textarea> <!-- Textarea pel missatge -->
                @error('descripcio')
                    <div class="error">{{ $message }}</div>
                @enderror

                @if (session('success'))
                    <div class="success-message">
                        {{ session('success') }}
                    </div>
                @endif

                <input class="botons" type="submit" value="Crear Article">
            </form>

            <form action="{{ route('dashboard') }}">
                <input class="botons" type="submit" value="Tornar"> <!-- Botó per tornar a la pàgina principal -->
            </form>
        </div>
    </div>
</body>
</html>