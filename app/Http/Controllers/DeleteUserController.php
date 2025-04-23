<?php

namespace App\Http\Controllers;

use App\Models\Usuari;
use Illuminate\Http\Request;

class DeleteUserController extends Controller
{
    public function delete(Request $request)
    {
        $id = $request->input('id');

        // Comprobar si el ID es válido
        if (!$id) {
            return response()->json(['success' => false, 'error' => 'ID invàlid']);
        }

        // Comprobar si el usuario es "admin" (no se puede eliminar)
        $usuari = Usuari::find($id);
        if (!$usuari) {
            return response()->json(['success' => false, 'error' => 'Usuari no trobat']);
        }

        if ($usuari->nom === 'admin') {
            return response()->json(['success' => false, 'error' => 'No es pot eliminar l\'usuari admin']);
        }

        // Delegar la eliminación al modelo
        $success = Usuari::eliminarUsuari($id);

        if ($success) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'error' => 'Error intern durant l\'eliminació']);
        }
    }
}
