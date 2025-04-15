<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablir Contrasenya</title>
</head>
<body>
    <h1>Restablir Contrasenya</h1>
    <form action="{{ route('update-password') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <label for="password">Nova Contrasenya:</label>
        <input type="password" name="password" required>
        <label for="password_confirmation">Confirma la Contrasenya:</label>
        <input type="password" name="password_confirmation" required>
        <button type="submit">Restablir Contrasenya</button>
    </form>
</body>
</html>