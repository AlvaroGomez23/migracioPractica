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
            // Devolver un error JSON si no hay JWT
            return response()->json(['error' => 'No autenticat. JWT no proporcionat.'], 401);
        }

        try {
            // Decodificar el JWT
            $secretKey = env('JWT_SECRET', 'clave_secreta');
            $decoded = JWT::decode($jwt, new Key($secretKey, 'HS256'));

            // Verificar si el usuario existe y el JWT coincide con el de la base de datos
            $usuari = Plantilla::buscarUsuariJwt($decoded);

            if (!$usuari || $usuari->jwt !== $jwt) {
                return response()->json(['error' => 'No autenticat. JWT invalid.'], 401);
            }

            // Obtener el parámetro 'nom' de la solicitud
            $nom = $request->input('nom', '');

            // Usar el método del modelo para buscar plantillas
            $plantilles = Plantilla::cercarPerNom($nom);

            // Devolver los resultados como JSON
            return response()->json(['success' => true, 'data' => $plantilles]);
        } catch (\Exception $e) {
            // Manejar errores al decodificar el JWT
            return response()->json(['error' => 'No autenticat. Error al verificar el JWT.'], 401);
        }
    }
}

