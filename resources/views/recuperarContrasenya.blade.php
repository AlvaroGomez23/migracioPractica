<!-- filepath: c:\laragon\www\migracioPractica\resources\views\recuperarContrasenya.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/estilsForms.css') }}"> <!-- Estils css -->
    <title>Recuperar Contrasenya</title>
</head>
<body>
    <div class="container">
        <h2>Recuperar Contrasenya</h2>
        <form action="{{ route('recuperarContrasenya') }}" method="POST">
            @csrf <!-- Protección contra CSRF -->
            <input type="email" name="email" class="input-field" placeholder="Email" required>
            <input type="submit" value="Recuperar Contrasenya" class="botons">
        </form>

        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error-messages">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('home') }}">
            <input type="submit" value="Tornar" class="botons">
        </form>
    </div>
</body>
</html>