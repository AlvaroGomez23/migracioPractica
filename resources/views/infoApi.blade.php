<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informació per utilitzar la API</title>
    <link rel="stylesheet" href="{{ asset('css/estilsForms.css') }}">
</head>
<body>
    <div class="containerinfo">
        <h1 tabindex="0">Informació per utilitzar la API</h1>
        <p tabindex="0">Per utilitzar la API des-de la web pots fer-ho accedint a aquest link: 
            <a href="{{ url('/api') }}">API</a>.
        </p>
        <p tabindex="0">S'ha d'estar logat per poder utilitzar-la.</p>
        <p tabindex="0">Per utilitzar-la al postman s'han d'utilitzar les següents dades:</p>
        <br>
        <p>A diferència del projecte de PHP natiu només s'ha dafegir el jwt, ja que s'esborra quan l'usuari fa logout</p>
        <p tabindex="0"><strong>jwt
            </strong>:
            <span class="jwt-container"> {{ request()->cookie('jwt') }} </span>
        </p>
        <br>
        <p tabindex="0">Aquí tens com s'ha de configurar el postman per utilitzar-ho: </p>
        <div>
            <img class="fotos" src="{{ asset('fotos/postman1.png') }}" alt="Imatge d'exemple configuració postman">
            <img class="fotos" src="{{ asset('fotos/postman2.png') }}" alt="Imatge d'exemple configuració postman headers">
        </div>
    
        <form action="{{ url('/dashboard') }}">
            <input class="botons" type="submit" value="Tornar">
        </form>
    </div>
</body>
</html>
