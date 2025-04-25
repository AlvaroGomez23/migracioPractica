<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuari;
class PerfilController extends Controller
{

    protected $usuari;

    function __construct(Usuari $usuari) {
        $this->usuari = Auth::user();
    }

    public function update(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'foto' => 'nullable|image|max:2048',
        ]);

        $usuari = Auth::user(); // Obtenir l'usuari autenticat

        // Actualitzar les dades de l'usuari
        $usuari->updateUsuari([
            'nom' => $request->nom,
            'foto' => $request->file('foto')
        ]);

        return redirect()->route('perfil')->with('success', 'Perfil actualitzat correctament.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'pswActual' => 'required',
            'pswNew' => 'required|min:8|confirmed', 
        ], [
            'pswNew.confirmed' => 'Les contrasenyes no coincideixen.',
        ]);

        $user = Auth::user();

        // Verificar la contrasenya actual
        if (!Hash::check($request->pswActual, $user->contrasenya)) {
            return back()->withErrors(['pswActual' => 'La contrasenya actual no és correcta.']);
        }

        // Actualitzar la contrasenya de l'usuari
        // Aquesta línia dona error però funciona correctament
        $user->updatePassword([
            'contrasenya' => $request->pswNew,
        ]);

        return back()->with('success', 'Contrasenya actualitzada correctament.');
    }
}

