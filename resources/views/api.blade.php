<!-- filepath: c:\laragon\www\migracioPractica\resources\views\api\index.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API - Plantilles</title>
    <link rel="stylesheet" href="{{ asset('css/estilsAPI.css') }}">
</head>
<body>
    <h1>Resultats de la API</h1>

    <form action="{{ route('api') }}" method="GET">
        <input type="text" name="nom" placeholder="Cerca per nom" value="{{ $nom }}">
        <button type="submit">Cercar</button>
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Descripció</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($plantilles as $plantilla)
                <tr>
                    <td>{{ $plantilla->id }}</td>
                    <td>{{ $plantilla->nom }}</td>
                    <td>{{ $plantilla->descripcio }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No s'han trobat resultats.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>