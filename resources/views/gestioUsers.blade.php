<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/estilsTaules.css') }}"> <!-- Estils CSS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert2 -->
    <script> const deleteUserUrl = "{{ route('deleteUser') }}"; </script>
    <script src="{{ asset('js/modalGestioUsers.js') }}"></script> <!-- Script per a la gestió d'usuaris amb AJAX -->
    <title>Gestió d'usuaris</title>
</head>
<body>
    <h1>Gestió d'usuaris</h1>

    <div role="alert" aria-live="polite" id="statusMessage"></div> <!-- Missatges per a usuaris de lectors de pantalla -->

    <table border="1" id="userTable">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Correu</th>
                <th>Eliminar Usuari</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuaris as $usuari)
                <tr id="userRow_{{ $usuari->id }}" tabindex="0">
                    <td>{{ $usuari->id }}</td>
                    <td>{{ $usuari->nom }}</td>
                    <td>{{ $usuari->email }}</td>
                    <td>
                        @if ($usuari->nom !== 'admin')
                            <button class="eliminar" 
                                    onclick="confirmDelete({{ $usuari->id }}, '{{ $usuari->nom }}', '{{ $usuari->email }}', this)" 
                                    onkeypress="handleKeyPress(event, {{ $usuari->id }}, '{{ $usuari->nom }}', '{{ $usuari->email }}', this)" 
                                    tabindex="0" 
                                    aria-label="Eliminar usuari {{ $usuari->nom }}">
                                Eliminar
                            </button>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <form action="{{ route('admin') }}">
        <input type="submit" value="Tornar" aria-label="Tornar a la pàgina d'administració">
    </form>

    <script>
        function handleKeyPress(event, id, nom, email, button) {
            if (event.key === "Enter" || event.key === " ") {
                confirmDelete(id, nom, email, button);
            }
        }
    </script>
</body>
</html>