<!-- filepath: c:\laragon\www\migracioPractica\resources\views\perfil.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/estilsForms.css') }}">
    <title>Perfil</title>
</head>
<body>
    <div class="container">
        <h2>Perfil</h2>

        <!-- Mostrar la foto de perfil -->
        <img class="foto" src="{{ asset('storage/' . Auth::user()->foto) }}" alt="Foto de perfil" style="width: 75px;">

        <form method="POST" action="{{ route('perfil.update') }}" enctype="multipart/form-data">
            @csrf 

            <label for="nom">NickName:</label>
            <input type="text" class="input-field" name="nom" id="nom" value="{{ Auth::user()->nom }}">

            <label for="email">Email:</label>
            <input type="email" id="email" class="input-field" value="{{ Auth::user()->email }}" readonly>

            <label for="foto">Foto:</label>
            <input type="file" id="foto" class="input-field" name="foto" accept="image/*">

           
            @if (Auth::user()->oauth == null)
                <a href="{{ route('password.change') }}">Canviar Contrasenya</a>
            @endif

            <input type="submit" class="botons" value="Modificar Perfil">
        </form>

        <form action="{{ route('dashboard') }}">
            <input type="submit" class="botons" value="Tornar">
        </form>
    </div>
</body>
</html>