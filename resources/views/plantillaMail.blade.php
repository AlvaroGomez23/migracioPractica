<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperació de Contrasenya</title>
</head>
<body>
    <! -- Plantilla per al correu electrònic de recuperació de contrasenya -->
    <h1>Recuperació de Contrasenya</h1>
    <p>Has sol·licitat recuperar la teva contrasenya. Fes clic al següent enllaç per restablir-la:</p>
    <a href="{{ url('/resetPassword/' . $token) }}">Restablir Contrasenya</a>
    <p>Aquest enllaç expira en 15 minuts.</p>
</body>
</html>