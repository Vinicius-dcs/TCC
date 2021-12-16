<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ManutencaoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VeiculoController;
use App\Models\DAO\ManutencaoDAO;

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

        Route::get('/funcionario', function () {
            return view('cadastros.funcionario');
        });

        Route::get('/manutencao', function () {
            return view('cadastros.manutencao');
        });
    });

    Route::prefix('alteracao')->group(function () {
        Route::get('/marca', function () {
            return view('alteracao.marca');
        });

        Route::get('/cliente', function () {
            return view('alteracao.cliente');
        });

        Route::get('/veiculo', function () {
            return view('alteracao.veiculo');
        });

        Route::get('/funcionario', function () {
            return view('alteracao.funcionario');
        });
    });

    Route::prefix('check')->group(function () {
        Route::get('manutencao', function () {
            return view('check.manutencao');
        });
    });

    Route::post('/marca/cadastrar', [MarcaController::class, 'cadastrarMarca']);
    Route::post('/marca/alterar', [MarcaController::class, 'alterarMarca']);
    Route::post('/marca/excluir', [MarcaController::class, 'deletarMarca']);

    Route::post('/cliente/cadastrar', [ClienteController::class, 'cadastrarCliente']);
    Route::post('/cliente/alterar', [ClienteController::class, 'alterarCliente']);
    Route::post('/cliente/excluir', [ClienteController::class, 'deletarCliente']);

    Route::post('/veiculo/cadastrar', [VeiculoController::class, 'cadastrarVeiculo']);
    Route::post('/veiculo/alterar', [VeiculoController::class, 'alterarVeiculo']);
    Route::post('/veiculo/excluir', [VeiculoController::class, 'deletarVeiculo']);

    Route::post('/funcionario/cadastrar', [FuncionarioController::class, 'cadastrarFuncionario']);
    Route::post('/funcionario/alterar', [FuncionarioController::class, 'alterarFuncionario']);
    Route::post('/funcionario/excluir', [FuncionarioController::class, 'deletarFuncionario']);

    Route::get('/manutencao/api/get', [ManutencaoDAO::class, 'selectManutencaoAPI']);
    Route::post('/manutencao/cadastrar', [ManutencaoCOntroller::class, 'cadastrarManutencao']);
});
