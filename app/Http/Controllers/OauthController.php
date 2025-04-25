<?php
namespace App\Http\Controllers;

use App\Models\Usuari;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class OauthController extends Controller
{
    // Redirigir l'usuari a Google per autenticar-se
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Gestionar el callback de Google
    public function handleGoogleCallback()
    {
        try {
            // Obtenir les dades de l'usuari des de Google
            $googleUser = Socialite::driver('google')->user();

            // Cercar o registrar l'usuari a la base de dades
            $user = Usuari::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'nom' => $googleUser->getName(),
                    'oauth' => 'google', // Indicar que l'usuari s'ha registrat per OAuth
                    'foto' => $googleUser->getAvatar(), // Guardar la foto del perfil
                ]
            );

            // Iniciar sessió per a l'usuari
            Auth::login($user);

            // Verificar si l'usuari està autenticat
            if (Auth::check()) {
                return redirect('/dashboard'); // Redirigir a la pàgina d'inici després d'iniciar sessió
            } else {
                return redirect('/login');
            }
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['oauth' => 'Hi ha hagut un problema amb l\'autenticació de Google.']);
        }

        dd($user);
    }
}