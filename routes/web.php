<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/usuario/insert', [UsuarioController::class, 'cadastrarUsuario']);

Route::post('/usuario/logar', [UsuarioController::class, 'logarUsuario']);

Route::get('/sistema/unauthorized', function () {
    return view('layouts.illustration.unauthorized');
});

Route::get('/sistema/inicio', function () {
    return view('layouts.inicio');
});

Route::get('/sistema/cadastro/cliente', function () {
    return view('layouts.cadastros.cliente');
});