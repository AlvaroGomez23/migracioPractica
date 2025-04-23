<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Usuari extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuaris'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'nom',
        'email',
        'oauth', // Campo que indica si el usuario se registró por OAuth
        'foto',  // Campo para almacenar la foto del perfil
    ];

    protected $hidden = [
        'contrasenya', 'remember_token',
    ];

    public $timestamps = false; // Deshabilitar timestamps

    // Indicar que el campo de contraseña es "contrasenya"
    public function getAuthPassword()
    {
        return $this->contrasenya;
    }

    public static function comprovarUsuari($email) {
        return Usuari::where('email', $email)->first();
    }

    public function crearUsuari($data) {
        return Usuari::create([
            'nom' => $data['nom'],
            'email' => $data['email'],
            'contrasenya' => Hash::make($data['contrasenya']),
        ]);
    }

    public function updateUsuari($data)
    {  
        $this->nom = $data['nom'];

        // Si se sube una nueva foto
        if (isset($data['foto']) && $data['foto']->isValid()) {
            // Eliminar la foto anterior si existe
            if ($this->foto && Storage::exists($this->foto)) {
                Storage::delete($this->foto);
            }

            // Guardar la nueva foto en la raíz del proyecto
            $fileName = time() . '_' . $data['foto']->getClientOriginalName(); // Generar un nombre único
            $data['foto']->move(base_path(), $fileName); // Guardar en la raíz del proyecto

            $this->foto = $fileName; // Guardar el nombre del archivo en la base de datos
        }

        // Guardar cambios en la base de datos
        $this->save();
    }

    public function updatePassword($data)
    {
        $this->contrasenya = Hash::make($data['contrasenya']);
        $this->save();
    }

    public static function buscarToken($request)
    {
        return Usuari::where('token', $request->token)
        ->where('tokenExpire', '>', Carbon::now())
        ->first();
    }

    public function resetContrasenya($data) {
        $this->contrasenya = Hash::make($data);
        $this->token = null;
        $this->tokenExpire = null;
        $this->save();
    }

    // Método para verificar si el usuario se registró por OAuth
    public function isOauthUser()
    {
        return $this->oauth !== null;
    }

    public static function eliminarUsuari($id)
    {
        try {
            // Iniciar transacción
            DB::beginTransaction();

            // Reasignar los artículos al usuario con ID 13
            DB::table('articles')->where('id_usuari', $id)->update(['id_usuari' => 13]);

            // Eliminar el usuario
            DB::table('usuaris')->where('id', $id)->delete();

            // Confirmar transacción
            DB::commit();

            return true;
        } catch (\Exception $e) {
            // Revertir transacción en caso de error
            DB::rollBack();
            Log::error('Error eliminant usuari: ' . $e->getMessage());
            return false;
        }
    }

    public function generarJwt()
    {
        // Clave secreta para firmar el JWT
        $secretKey = env('JWT_SECRET', 'clave_secreta');

        // Datos del payload
        $payload = [
            'iss' => 'migracioPractica', // Emisor
            'sub' => $this->id,          // ID del usuario
            'email' => $this->email,     // Email del usuario
            'iat' => time(),             // Fecha de emisión
            'exp' => time() + 3600       // Expiración (1 hora)
        ];

        // Generar el token
        $jwt = JWT::encode($payload, $secretKey, 'HS256');

        // Guardar el token en la base de datos
        $this->jwt = $jwt;
        $this->save();

        return $jwt;
    }

    public function destruirJwt()
    {
        // Eliminar el token JWT de la base de datos
        $this->jwt = null;
        $this->save();
    }
}