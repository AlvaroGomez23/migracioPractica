<?php

namespace App\Http\Controllers;

use App\Models\Usuari;
use Illuminate\Http\Request;

class DeleteUserController extends Controller
{
    public function delete(Request $request)
    {
        $id = $request->input('id');

        // Validar que l'ID sigui vàlid
        if (!$id) {
            return response()->json(['success' => false, 'error' => 'ID invàlid']);
        }

        // Comprovar si l'usuari existeix
        $usuari = Usuari::find($id);
        if (!$usuari) {
            return response()->json(['success' => false, 'error' => 'Usuari no trobat']);
        }

        // Comprovar si l'usuari és "admin" (no es pot eliminar)
        if ($usuari->nom === 'admin') {
            return response()->json(['success' => false, 'error' => 'No es pot eliminar l\'usuari admin']);
        }

        // Delegar l'eliminació al model
        $success = Usuari::eliminarUsuari($id);

        if ($success) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'error' => 'Error intern durant l\'eliminació']);
        }
    }
}
