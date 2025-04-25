<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\Usuari;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->input('buscar', '');
        $articlesPerPagina = $request->input('articlesPerPagina', 10);
        $ordreArticles = $request->input('ordreArticles', 'asc');

        // Cercar articles amb autor
        $articles = Article::buscarArticulosConAutor($buscar, $articlesPerPagina, $ordreArticles);

        // Comprovar si l'usuari és administrador
        if (Auth::check() && Auth::user()->nom === 'admin') {
            return view('admin', compact('articles', 'buscar', 'articlesPerPagina', 'ordreArticles'));
        } else {
            return view('index', compact('articles', 'buscar', 'articlesPerPagina', 'ordreArticles'));
        }
    }

    public function dashboard(Request $request)
    {
        $buscar = $request->input('buscar', '');
        $articlesPerPagina = $request->input('articlesPerPagina', 10);
        $ordreArticles = $request->input('ordreArticles', 'asc');

        // Validar que l'ordre sigui "asc" o "desc"
        if (!in_array($ordreArticles, ['asc', 'desc'])) {
            $ordreArticles = 'asc';
        }

        // Obtenir els articles personals de l'usuari autenticat
        $usuariId = Auth::user()->id;
        $articles = Article::buscarArticlesPersonals($usuariId, $articlesPerPagina, $ordreArticles);

        return view('dashboard', compact('articles', 'articlesPerPagina', 'ordreArticles'));
    }

    public function create()
    {
        // Retornar la vista per inserir articles
        return view('inserirArticles');
    }

    public function store(Request $request)
    {
        // Validar les dades del formulari
        $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'required|string',
        ]);

        // Crear un nou article
        $article = Article::crearArticle($request);

        // Missatge d'èxit
        session()->flash('success', "Article amb el títol '{$article->nom}' creat correctament.");

        return back();
    }

    public function edit($id)
    {
        // Buscar l'article per ID
        $article = Article::findOrFail($id);

        // Retornar la vista d'edició
        return view('editArticle', compact('article'));
    }

    public function update(Request $request, $id)
    {
        // Validar les dades del formulari
        $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'required|string',
        ]);

        // Actualitzar l'article
        $article = Article::findOrFail($id);
        Article::updateArticle($id, $request->all());

        // Missatge d'èxit
        session()->flash('success', "Article amb el títol '{$article->nom}' actualitzat correctament.");

        return redirect()->route('dashboard');
    }

    public function delete($id)
    {
        // Buscar l'article per ID i eliminar-lo
        $article = Article::findOrFail($id);
        $article->delete();

        // Missatge d'èxit
        session()->flash('success', "Article amb el títol '{$article->nom}' eliminat correctament.");

        return redirect()->route('dashboard');
    }
}