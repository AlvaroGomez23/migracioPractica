<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    protected $table = 'articles';  // Nombre de la tabla si no sigue la convención

    protected $fillable = ['nom', 'descripcio', 'id_usuari']; // Campos permitidos para inserción

    // Si no usas timestamps
    public $timestamps = false;

    // Definir la consulta para obtener los artículos con el nombre del autor
    public static function buscarArticulosConAutor($buscar, $articlesPerPagina, $ordre)
    {
        return DB::table('articles')
            ->join('usuaris', 'articles.id_usuari', '=', 'usuaris.id')
            ->select('articles.*', 'usuaris.nom as autor')
            ->where('articles.nom', 'like', '%' . $buscar . '%')
            ->orWhere('articles.descripcio', 'like', '%' . $buscar . '%')
            ->orderBy('articles.nom', $ordre) // Ordenar por el nombre del artículo
            ->paginate($articlesPerPagina);
    }


    public static function buscarArticlesPersonals($usuariId, $articlesPerPagina, $ordre)
    {
        
        $ordre = in_array($ordre, ['asc', 'desc']) ? $ordre : 'asc';
    
        return Article::where('id_usuari', $usuariId)
            ->orderBy('nom', $ordre)
            ->paginate($articlesPerPagina);
    }

    public static function crearArticle($data)
    {
        return self::create([
            'nom' => $data['nom'],
            'descripcio' => $data['descripcio'],
            'id_usuari' => Auth::user()->id, // Obtener el ID del usuario autenticado
        ]);
    }

    public static function updateArticle($articleId, $data)
    {
        return self::where('id', $articleId)->update([
            'nom' => $data['nom'],
            'descripcio' => $data['descripcio'],
        ]);
    }
    
}
