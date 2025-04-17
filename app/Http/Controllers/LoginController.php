<?php

namespace App\Http\Controllers;

use App\Models\Usuari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller {

    protected $usuari;

    function __construct(Usuari $usuari) {
        $this->usuari = $usuari;
    }


    public function login(Request $request) {

        $request->validate([
            'email' => 'required|email',
            'contrasenya' => 'required',
        ]);

        $usuari = $this->usuari->comprovarUsuari($request->email);
        if (!$usuari) {
            return redirect()->back()->withErrors(['email' => 'Usuari no trobat.']);
        }

        if (Hash::check($request->contrasenya, $usuari->contrasenya)) {

            Auth::login($usuari);
            if ($usuari['nom'] == "admin") {
                return redirect('/admin');
            } else {
                return redirect('/dashboard');
            }
        } else {
            return redirect()->back()->withErrors(['contrasenya' => 'Contrasenya incorrecta.']);
        }

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
