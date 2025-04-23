<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plantilla extends Model
{
    protected $table = 'plantilles'; // Nombre de la tabla
    protected $fillable = ['nom', 'descripcio']; // Campos asignables
}
