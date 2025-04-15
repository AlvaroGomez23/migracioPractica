<!-- resources/views/auth/signin.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/estilsLS.css') }}">
    <title>Formulario de Sign In</title>
</head>
<body>
    <div class="signin-container">
        <h2>Registrar-Se</h2>
        
        <form method="POST" action="{{ route('auth.signin') }}">
            @csrf
            <input type="text" aria-label="nom usuari" name="nom" class="input-field" placeholder="Nom d'usuari" value="{{ old('nom') }}" required>
            @error('nom')
                <div class="error">{{ $message }}</div>
            @enderror

            <input type="email" aria-label="email" name="email" class="input-field" placeholder="Mail Ex. someone@fromsomewhere.com" value="{{ old('email') }}" required>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <input type="password" aria-label="contrasenya" name="contrasenya" class="input-field" placeholder="Contrasenya" required>
            @error('contrasenya')
                <div class="error">{{ $message }}</div>
            @enderror

            <input type="password" aria-label="repetir contrasenya" name="contrasenya_confirmation" class="input-field" placeholder="Torna a introduir la contrasenya" required>
            <input type="submit" aria-label="sign in" value="Sign In" class="botons">
        </form>
        
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

        <div class="signup-link">
            Ja tens compte? <a href="{{ route('login') }}">Inicia la sessió aquí</a>
        </div>
    </div>
</body>
</html>
