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

Route::get('/sistema', function () {
    return view('sistema');
});