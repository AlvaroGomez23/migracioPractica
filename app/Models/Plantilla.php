<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plantilla extends Model
{
    protected $table = 'plantilles'; // Nombre de la tabla
    protected $fillable = ['nom', 'descripcio']; // Campos asignables

    /**
     * Buscar plantillas por nombre.
     *
     * @param string $nom
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function cercarPerNom($nom)
    {
        return self::where('nom', 'like', "%$nom%")->get();
    }

    public static function buscarUsuariJwt($decoded){
        return Usuari::find($decoded->sub);
    }
}
