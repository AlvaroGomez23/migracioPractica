<?php
namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Usuari;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Verificar si el usuario es admin
        if (Auth::check() && Auth::user()->nom === 'admin') {
            // Obtener artículos con paginación
            $articlesPerPage = $request->get('articlesPerPagina', 10); // Por defecto, 10 artículos por página
            $articles = Article::paginate($articlesPerPage);

            return view('admin', compact('articles'));
        }

        // Redirigir si no es admin
        return redirect()->route('home')->withErrors(['access' => 'No tens permisos per accedir a aquesta pàgina.']);
    }

    public function gestioUsers()
    {
        // Obtener todos los usuarios
        $usuaris = Usuari::all();

        // Retornar la vista con los usuarios
        return view('gestioUsers', compact('usuaris'));
    }
}