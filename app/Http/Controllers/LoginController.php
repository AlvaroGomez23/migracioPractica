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


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'contrasenya' => 'required',
        ]);

        $usuari = $this->usuari->comprovarUsuari($request->email);
        if (!$usuari) {
            return redirect()->back()->withErrors(['email' => 'Usuari no trobat.']);
        }

        if (Hash::check($request->contrasenya, $usuari->contrasenya)) {
            // Destruir el token JWT anterior
            $usuari->destruirJwt();

            // Generar un nuevo token JWT
            $jwt = $usuari->generarJwt();

            // Iniciar sesión al usuario
            Auth::login($usuari);

            // Guardar el JWT en una cookie segura
            $cookie = cookie('jwt', $jwt, 60, null, null, true, true, false, 'Strict');

            if ($usuari['nom'] == "admin") {
                return redirect('/admin')->withCookie($cookie);
            } else {
                return redirect('/dashboard')->withCookie($cookie);
            }
        } else {
            return redirect()->back()->withErrors(['contrasenya' => 'Contrasenya incorrecta.']);
        }
    }

    public function logout(Request $request)
    {
        $usuari = Auth::user();

        if ($usuari) {
            // Destruir el token JWT
            $usuari->destruirJwt();
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Eliminar la cookie del JWT
        $cookie = cookie('jwt', '', -1);

        return redirect('/login')->withCookie($cookie);
    }
}
