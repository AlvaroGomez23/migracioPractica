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
        // Verificar admin
        if (Auth::check() && Auth::user()->nom === 'admin') {
            // Paginacio
            $articlesPerPage = $request->get('articlesPerPagina', 10); 
            $articles = Article::paginate($articlesPerPage);

            return view('admin', compact('articles'));
        }

        // Redirigir si no es admin
        return redirect()->route('home');
    }

    public function gestioUsers()
    {
        // Obtenir usuaris
        $usuaris = Usuari::all();

        // Retornar la vista
        return view('gestioUsers', compact('usuaris'));
    }
}