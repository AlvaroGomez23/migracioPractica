<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecuperarContrasenyaController extends Controller
{
    public function recuperar(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:usuaris,email',
        ], [
            'email.exists' => 'El correu electrònic no està registrat.',
        ]);

        // Aquí puedes implementar la lógica para enviar un correo de recuperación
        // Por ejemplo, generar un token y enviarlo al correo del usuario
        session()->flash('success', 'S\'ha enviat un correu per recuperar la contrasenya.');

        // Volver a cargar la misma vista
        return back();
    }
}
