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
        //Obtenir el JWT de la cookie
        $jwt = $request->cookie('jwt');

        if (!$jwt) {
            
            return response()->json(['error' => 'No autenticat. JWT no proporcionat.'], 401);
        }

        try {
            
            //Decodificar el JWT
            $secretKey = env('JWT_SECRET', 'clave_secreta');
            $decoded = JWT::decode($jwt, new Key($secretKey, 'HS256'));

            //Verificar si el JWT és vàlid
            $usuari = Plantilla::buscarUsuariJwt($decoded);

            if (!$usuari || $usuari->jwt !== $jwt) {
                return response()->json(['error' => 'No autenticat. JWT invalid.'], 401);
            }

            
            $nom = $request->input('nom', '');

            // Comprovar si el nom és buit, per retornar totes les plantilles
            $plantilles = Plantilla::cercarPerNom($nom);

            
            return response()->json(['success' => true, 'data' => $plantilles]);
        } catch (\Exception $e) {
            
            //Mostrar errors
            return response()->json(['error' => 'No autenticat. Error al verificar el JWT.'], 401);
        }
    }
}

