<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ManutencaoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VeiculoController;
use App\Http\Controllers\TesteDriveController;
use App\Models\DAO\ManutencaoDAO;
use App\Models\DAO\TesteDriveDAO;
use App\Models\DAO\RelatoriosDAO;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/recuperarSenha', function () {
    return view('mails.esqueceuASenha');
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

        Route::get('/testedrive', function () {
            return view('cadastros.testeDrive');
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

        Route::get('/manutencao', function () {
            return view('alteracao.manutencao');
        });

        Route::get('/testedrive', function () {
            return view('alteracao.testeDrive');
        });
    });

    Route::prefix('check')->group(function () {
        Route::get('manutencao', function () {
            return view('check.manutencao');
        });

        Route::get('testedrive', function () {
            return view('check.testeDrive');
        });
    });

    Route::get('/relatorios', function () {
        return view('relatorios.inicio');
    });

    Route::prefix('relatorios')->group(function () {
        Route::get('/', function () {
            return view('relatorios.inicio');
        });

        Route::get('relatorio-1', function () {
            return view('relatorios.relatorio-1');
        });

        Route::get('relatorio-2', function () {
            return view('relatorios.relatorio-2');
        });

        Route::get('relatorio-3', function () {
            return view('relatorios.relatorio-3');
        });

        Route::get('relatorio-4', function () {
            return view('relatorios.relatorio-4');
        });

        Route::get('relatorio-5', function () {
            return view('relatorios.relatorio-5');
        });
        
        Route::get('relatorio-6', function () {
            return view('relatorios.relatorio-6');
        });
        
        Route::get('/api/get', [RelatoriosDAO::class, 'getRelatorio1']);
        Route::post('/filtrar', [RelatoriosDAO::class, 'setFiltrosSession']);
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
    Route::post('/manutencao/cadastrar', [ManutencaoController::class, 'cadastrarManutencao']);
    Route::post('/manutencao/concluir', [ManutencaoController::class, 'concluirManutencao']);
    Route::post('/manutencao/adiar', [ManutencaoController::class, 'adiarManutencao']);
    Route::post('/manutencao/cancelar', [ManutencaoController::class, 'cancelarManutencao']);
    Route::post('/manutencao/alterar', [ManutencaoController::class, 'alterarManutencao']);
    Route::post('/manutencao/excluir', [ManutencaoController::class, 'excluirManutencao']);

    Route::get('/testedrive/api/get', [TesteDriveDAO::class, 'selectTesteDriveAPI']);
    Route::post('/testedrive/cadastrar', [TesteDriveController::class, 'cadastrarTesteDrive']);
    Route::post('/testedrive/alterar', [TesteDriveController::class, 'alterarTesteDrive']);
    Route::post('/testedrive/excluir', [TesteDriveController::class, 'deletarTesteDrive']);
    Route::post('/testedrive/concluir', [TesteDriveController::class, 'concluirTesteDrive']);
    Route::post('/testedrive/adiar', [TesteDriveController::class, 'adiarTesteDrive']);
    Route::post('/testedrive/cancelar', [TesteDriveController::class, 'cancelarTesteDrive']);
});
