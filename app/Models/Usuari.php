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

class Usuari extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuaris'; // Nom de la taula a la base de dades

    protected $fillable = [
        'nom',
        'email',
        'oauth', // Camp que indica si l'usuari es va registrar per OAuth
        'foto',  // Camp per emmagatzemar la foto del perfil
    ];

    protected $hidden = [
        'contrasenya', 'remember_token',
    ];

    public $timestamps = false; // Deshabilitar timestamps

    
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

        // Si es puja una nova foto
        if (isset($data['foto']) && $data['foto']->isValid()) {
            // Eliminar la foto anterior si existeix
            if ($this->foto && Storage::exists($this->foto)) {
                Storage::delete($this->foto);
            }

            // Guardar la nova foto
            $fileName = time() . '_' . $data['foto']->getClientOriginalName(); // Generar un nom únic
            $data['foto']->move(base_path(), $fileName);

            $this->foto = $fileName; // Guardar el nom del fitxer a la base de dades
        }

        // Guardar els canvis a la base de dades
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

    // Mètode per verificar si l'usuari es va registrar per OAuth
    public function isOauthUser()
    {
        return $this->oauth !== null;
    }

    public static function eliminarUsuari($id)
    {
        try {
            // Iniciar transacció
            //Important per evitar que es perdi informació
            // en cas d'error durant l'eliminació
            DB::beginTransaction();

            // Reassignar els articles a l'usuari amb ID 13
            DB::table('articles')->where('id_usuari', $id)->update(['id_usuari' => 13]);

            // Eliminar l'usuari
            DB::table('usuaris')->where('id', $id)->delete();

            // Confirmar transacció
            DB::commit();

            return true;
        } catch (\Exception $e) {
            // Revertir transacció en cas d'error
            DB::rollBack();
            Log::error('Error eliminant usuari: ' . $e->getMessage()); // Registrar l'error
            return false;
        }
    }

    public function generarJwt()
    {
        // Clau secreta per signar el JWT
        $secretKey = env('JWT_SECRET', 'clave_secreta');

        // Dades del payload
        $payload = [
            'iss' => 'migracioPractica', // Emissor
            'sub' => $this->id,          // ID de l'usuari
            'email' => $this->email,     // Email de l'usuari
            'iat' => time(),             // Data d'emissió
            'exp' => time() + 3600       // Expiració (1 hora)
        ];

        // Generar el token
        $jwt = JWT::encode($payload, $secretKey, 'HS256');

        // Guardar el token a la base de dades
        $this->jwt = $jwt;
        $this->save();

        return $jwt;
    }

    public function destruirJwt()
    {
        // Eliminar el token JWT de la base de dades
        $this->jwt = null;
        $this->save();
    }
}