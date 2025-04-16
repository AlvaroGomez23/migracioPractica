<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuari; // Asegúrate de que este modelo existe en la ruta correcta

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

        $usuari = Auth::user(); // <-- este sí es el usuario correcto

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
            'pswNew' => 'required|min:8|confirmed', // Asegúrate de que el campo "pswVerify" en el formulario tenga el atributo "name=pswNew_confirmation"
        ], [
            'pswNew.confirmed' => 'Les contrasenyes no coincideixen.',
        ]);

        $user = Auth::user();

        // Verificar la contraseña actual
        if (!Hash::check($request->pswActual, $user->contrasenya)) {
            return back()->withErrors(['pswActual' => 'La contrasenya actual no és correcta.']);
        }

        $user->updatePassword([
            'contrasenya' => $request->pswNew,
        ]);

        
        return back()->with('success', 'Contrasenya actualitzada correctament.');
    }
    
}

