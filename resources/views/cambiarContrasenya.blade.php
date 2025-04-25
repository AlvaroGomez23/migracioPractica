<!-- filepath: c:\laragon\www\migracioPractica\resources\views\cambiarContrasenya.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/estilsForms.css') }}">
    <title>Cambiar Contrasenya</title>
</head>
<body>
    <div class="container">
        <h2>Cambiar Contrasenya</h2>
        <form action="{{ route('password.update') }}" method="POST">
            @csrf 

            <input type="password" name="pswActual" class="input-field" placeholder="Contrasenya Actual" required>
            <input type="password" name="pswNew" class="input-field" placeholder="Nova Contrasenya" required>
            <input type="password" name="pswNew_confirmation" class="input-field" placeholder="Repeteix la nova contrasenya" required>
            <input type="submit" name="cambiar" value="Cambiar Contrasenya" class="botons">

            
            @if ($errors->any())
                <div class="error-messages">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

         
            @if (session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif
        </form>
        <p></p>
        <form action="{{ route('dashboard') }}">
            <input type="submit" value="Tornar" class="botons">
        </form>
    </div>
</body>
</html>