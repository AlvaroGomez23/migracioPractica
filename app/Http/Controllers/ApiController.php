<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\Plantilla;
use App\Models\Usuari;

class ApiController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el JWT de la cookie
        $jwt = $request->cookie('jwt');

        if (!$jwt) {
            return response()->json(['error' => 'No hi ha JWT o no està logat.'], 401);
        }

        try {
            // Decodificar el JWT
            $secretKey = env('JWT_SECRET', 'clave_secreta');
            $decoded = JWT::decode($jwt, new Key($secretKey, 'HS256'));

            // Verificar si el usuario existe y el JWT coincide con el de la base de datos
            $usuari = Usuari::find($decoded->sub);

            if (!$usuari || $usuari->jwt !== $jwt) {
                return response()->json(['error' => 'No autenticat. JWT invalid.'], 401);
            }

            // Obtener el parámetro 'nom' de la solicitud
            $nom = $request->input('nom', '');
            $plantilles = Plantilla::where('nom', 'like', "%$nom%")->get();

            // Devolver los resultados
            return view('api', compact('plantilles', 'nom'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'No hi ha JWT o no està logat.'], 401);
        }
    }
}

