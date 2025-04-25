<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    protected $table = 'articles';  

    protected $fillable = ['nom', 'descripcio', 'id_usuari']; 

    
    public $timestamps = false;

    
    public static function buscarArticulosConAutor($buscar, $articlesPerPagina, $ordre)
    {
        // Retornar una llista d'articles amb el nom de l'autor
        return DB::table('articles')
            ->join('usuaris', 'articles.id_usuari', '=', 'usuaris.id')
            ->select('articles.*', 'usuaris.nom as autor')
            ->where('articles.nom', 'like', '%' . $buscar . '%')
            ->orWhere('articles.descripcio', 'like', '%' . $buscar . '%')
            ->orderBy('articles.nom', $ordre) 
            ->paginate($articlesPerPagina);
    }


    public static function buscarArticlesPersonals($usuariId, $articlesPerPagina, $ordre)
    {
        
        // Buscar articles personals de l'usuari autenticat
        $ordre = in_array($ordre, ['asc', 'desc']) ? $ordre : 'asc';
    
        return Article::where('id_usuari', $usuariId)
            ->orderBy('nom', $ordre)
            ->paginate($articlesPerPagina);
    }

    public static function crearArticle($data)
    {
        //Crear article
        return self::create([
            'nom' => $data['nom'],
            'descripcio' => $data['descripcio'],
            'id_usuari' => Auth::user()->id, 
        ]);
    }

    public static function updateArticle($articleId, $data)
    {
        // Actualitzar article
        return self::where('id', $articleId)->update([
            'nom' => $data['nom'],
            'descripcio' => $data['descripcio'],
        ]);
    }
    
}
