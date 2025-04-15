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
        $buscar = $request->input('buscar', ''); // Valor por defecto: cadena vacía
        $articlesPerPagina = $request->input('articlesPerPagina', 10); // Valor por defecto: 10
        $ordreArticles = $request->input('ordreArticles', 'asc'); // Valor por defecto: asc

        $articles = Article::buscarArticulosConAutor($buscar, $articlesPerPagina, $ordreArticles);

        return view('index', compact('articles', 'buscar', 'articlesPerPagina', 'ordreArticles'));
    }

    public function dashboard(Request $request)
    {
        $buscar = $request->input('buscar', ''); // Valor por defecto: cadena vacía
        $articlesPerPagina = $request->input('articlesPerPagina', 10); // Valor por defecto: 10
        $ordreArticles = $request->input('ordreArticles', 'asc'); // Valor por defecto: asc

        // Validar que el orden sea "asc" o "desc"
        if (!in_array($ordreArticles, ['asc', 'desc'])) {
            $ordreArticles = 'asc'; // Valor predeterminado si no es válido
        }

        $usuariId = Auth::user()->id; // Obtener el ID del usuario autenticado
        $articles = Article::buscarArticlesPersonals($usuariId, $articlesPerPagina, $ordreArticles);

        return view('dashboard', compact( 'articles', 'articlesPerPagina', 'ordreArticles'));

    }

    public function create()
    {
        return view('inserirArticles'); // Apunta a la vista inserirArticle
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'required|string',
        ]);


        $article = Article::crearArticle($request);

        // Almacenar un mensaje de éxito en la sesión
        session()->flash('success', "Article amb el títol '{$article->nom}' creat correctament.");

        // Volver a cargar la vista
        return back();
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id); // Buscar el artículo por ID
        return view('editArticle', compact('article')); // Retornar la vista de edición
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'required|string',
        ]);

        $article = Article::findOrFail($id);
        
        Article::updateArticle($id, $request->all()); // Actualizar el artículo

        // Mensaje de éxito
        session()->flash('success', "Article amb el títol '{$article->nom}' actualitzat correctament.");

        return redirect()->route('dashboard'); // Redirigir al dashboard
    }

    public function delete($id)
    {
        $article = Article::findOrFail($id); // Buscar el artículo por ID
        $article->delete(); // Eliminar el artículo

        // Mensaje de éxito
        session()->flash('success', "Article amb el títol '{$article->nom}' eliminat correctament.");

        return redirect()->route('dashboard'); // Redirigir al dashboard
    }
}