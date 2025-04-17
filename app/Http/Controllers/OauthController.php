<?php
namespace App\Http\Controllers;

use App\Models\Usuari;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class OauthController extends Controller
{
    // Redirigir al usuario a Google para autenticarse
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Manejar el callback de Google
    public function handleGoogleCallback()
    {
        try {
            // Obtener los datos del usuario desde Google
            $googleUser = Socialite::driver('google')->user();

            // Buscar o registrar al usuario en la base de datos
            $user = Usuari::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'nom' => $googleUser->getName(),
                    'oauth' => 'google', // Indicar que el usuario se registró por OAuth
                    'foto' => $googleUser->getAvatar(), // Guardar la foto del perfil
                ]
            );

            // Iniciar sesión al usuario
            Auth::login($user, true);

            // Verificar si el usuario está autenticado
            if (Auth::check()) {
                return redirect()->route('dashboard')->with('success', 'Has iniciat sessió correctament amb Google.');
            } else {
                return redirect()->route('login')->withErrors(['oauth' => 'No s\'ha pogut autenticar l\'usuari després del registre.']);
            }
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['oauth' => 'Hi ha hagut un problema amb l\'autenticació de Google.']);
        }
    }
}