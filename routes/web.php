<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController; // Ensure this controller exists in the specified namespace or create it if missing
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\SigninController;
use App\Http\Controllers\RecuperarContrasenyaController;
use App\Http\Controllers\PerfilController; // Ensure this controller exists in the specified namespace
use App\Http\Controllers\AdminController; // Ensure this controller exists in the specified namespace
use App\Http\Controllers\DeleteUserController; // Ensure this controller exists in the specified namespace
use App\Http\Controllers\OauthController; // Ensure this controller exists in the specified namespace
use App\Http\Controllers\ApiController; // Ensure this controller exists in the specified namespace

// Definir todas las rutas que usan la vista 'home'
Route::get('/', [ArticleController::class, 'index'])->name('home');


Route::get('/inserirArticle', function() {
    return view('inserirArticles');
})->name('inserirArticle');

Route::get('/scanner/qr', function () {
    return view('home'); // Vista para el escáner QR
})->name('scanner.qr');

Route::get('/signin', function () {
    return view('signin'); // Vista para el formulario de registro
})->name('signin');

Route::post('/signin', [SigninController::class, 'signin'])->name('auth.signin');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('auth.login');
Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');

Route::get('/articles/qr', function () {
    return view('home'); // Vista para los artículos con QR
})->name('articles.qr');


Route::get('/login/submit', function () {
    return view('home'); // Vista para la página de registro
})->name('login.submit');



Route::get('/recuperarContrasenya', function () {
    return view('recuperarContrasenya'); // Vista para la página de registro
})->name('recuperarContrasenya');

Route::post('/recuperarContrasenya', [RecuperarContrasenyaController::class, 'recuperar'])->name('recuperarContrasenya');

Route::get('/github', function () {
    return view('home'); // Vista para la página de registro
})->name('github');

Route::get('/dashboard', [ArticleController::class, 'dashboard'])->name('dashboard');

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/create', [ArticleController::class, 'create'])->name('inserirArticle');
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
Route::get('/articles/edit/{id}', [ArticleController::class, 'edit'])->name('articles.edit');
Route::put('/articles/update/{id}', [ArticleController::class, 'update'])->name('articles.update');
Route::delete('/articles/delete/{id}', [ArticleController::class, 'delete'])->name('articles.delete');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/perfil', function () {
    return view('perfil');
})->name('perfil');

Route::post('/perfil/update', [PerfilController::class, 'update'])->name('perfil.update');

Route::get('/info-api', function () {
    return view('index');
})->name('info-api');

Route::get('/admin', [ArticleController::class, 'index'])->name('admin');

Route::get('/password/change', function () {
    return view('cambiarContrasenya');
})->name('password.change');

Route::post('/password/update', [PerfilController::class, 'updatePassword'])->name('password.update');

Route::get('/resePassword/{token}', function ($token) {
    return view('resetPassword', ['token' => $token]);
})->name('resetPassword');

Route::post('/update-password', [RecuperarContrasenyaController::class, 'updatePassword'])->name('update-password');

Route::get('/gestioUsers', [AdminController::class, 'gestioUsers'])->name('gestioUsers');

Route::post('/users/delete', [DeleteUserController::class, 'delete'])->name('deleteUser');


Route::get('/auth/redirect/google', [OauthController::class, 'redirectToGoogle'])->name('auth.google.redirect');
Route::get('/auth/callback/google', [OauthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

Route::get('/api', [ApiController::class, 'index'])->name('api')->middleware('auth');


