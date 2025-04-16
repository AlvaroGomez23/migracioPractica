<?php

namespace App\Http\Controllers;

use App\Models\Usuari;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class RecuperarContrasenyaController extends Controller
{
    public function recuperar(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:usuaris,email',
        ], [
            'email.exists' => 'El correu electrònic no està registrat.',
        ]);

        // Buscar usuari
        $usuari = Usuari::comprovarUsuari($request->email);

        // Generar token
        $token = Str::random(60);
        $usuari->token = $token;
        $usuari->tokenExpire = Carbon::now()->addMinutes(15); // Cambiado a tokenExpire
        $usuari->save();

        // Enviar email
        Mail::send('plantillaMail', ['token' => $token], function($message) use ($usuari) {
            $message->to($usuari->email);
            $message->subject('Recuperació de Contrasenya');
        });

        session()->flash('success', 'S\'ha enviat un correu per recuperar la contrasenya.');

        return back();
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:8|confirmed', // Validar que las contraseñas coincidan
        ], [
            'password.confirmed' => 'Les contrasenyes no coincideixen.',
        ]);

        // Buscar usuario por token
        $usuari = Usuari::buscarToken($request);
        

        if (!$usuari) {
            return back()->withErrors(['token' => 'El token és invàlid o ha expirat.']);
        }


        // Actualizar la contraseña
        $usuari->resetContrasenya($request->password);

        return redirect()->route('login')->with('success', 'Contrasenya restablerta correctament.');
    }
}
