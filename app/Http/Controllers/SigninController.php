<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuari;

class SigninController extends Controller
{
    protected $usuari;

    function __construct(Usuari $usuari) {
        $this->usuari = $usuari;
    }

    public function signin(Request $request)
    {
        // Validacions per crear el compte
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:usuaris,email',
            'contrasenya' => 'required|min:8|confirmed',
        ], [
            'email.unique' => 'Correu electrònic ja registrat.',
            'contrasenya.confirmed' => 'Les contrasenyes no coincideixen.',
            'contrasenya.min' => 'La contrasenya ha de tenir almenys 8 caràcters.',
            'nom.required' => 'El nom és obligatori.',
            'email.required' => 'El correu electrònic és obligatori.',
            'contrasenya.required' => 'La contrasenya és obligatòria.',
        ]);

        $this->usuari->crearUsuari($request);

        return redirect('/login')->with('success', 'Usuari creat amb èxit.');
    }
}
