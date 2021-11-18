<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MarcaController;
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


Route::prefix('sistema')->group(function () {

    Route::get('/unauthorized', function () {
        return view('layouts.illustration.unauthorized');
    });

    Route::get('/inicio', function () {
        return view('inicio');
    });

    Route::prefix('cadastro')->group(function () {
        Route::get('/marca', function () {
            return view('cadastros.marca');
        });

        Route::get('/veiculo', function () {
            return view('cadastros.veiculo');
        });

        Route::get('/cliente', function () {
            return view('cadastros.cliente');
        });
    });

    Route::prefix('alteracao')->group(function () {
        Route::get('/marca', function () {
            return view('alteracao.marca');
        });

        Route::get('/cliente', function () {
            return view('alteracao.cliente');
        });
    });

    Route::post('/marca/cadastrar', [MarcaController::class, 'cadastrarMarca']);
    Route::post('/marca/alterar', [MarcaController::class, 'alterarMarca']);
    Route::post('/marca/excluir', [MarcaController::class, 'deletarMarca']);

    Route::post('/cliente/cadastrar', [ClienteController::class, 'cadastrarCliente']);
    Route::post('/cliente/alterar', [ClienteController::class, 'alterarCliente']);
    Route::post('/cliente/excluir', [ClienteController::class, 'deletarCliente']);

});
