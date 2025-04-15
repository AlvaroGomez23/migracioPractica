<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
}