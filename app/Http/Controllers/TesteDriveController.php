<?php

namespace App\Http\Controllers;

use App\Models\TesteDrive;
use App\Models\DAO\TesteDriveDAO;

class TesteDriveController extends Controller
{

    private $testeDrive;
    private $testeDriveDAO;

    public function __construct()
    {
        $this->testeDrive = new TesteDrive();
        $this->testeDriveDAO = new TesteDriveDAO();
    }

    public function cadastrarTesteDrive()
    {
        session_start();
        try {
            $this->testeDrive->setIdCliente($_POST['cliente']);
            $this->testeDrive->setIdVeiculo($_POST['veiculo']);
            $this->testeDrive->setIdFuncionario($_POST['funcionario']);
            $this->testeDrive->setData($_POST['data']);
            $this->testeDrive->setHorario($_POST['horarioTesteDrive']);
            $this->testeDrive->setObservacao($_POST['observacao']);

            $this->testeDriveDAO->cadTesteDrive($this->testeDrive);
            $_SESSION['mensagem'] = "Teste drive cadastrado com sucesso!";
            $_SESSION['tipoAlert'] = "success";
            header('Location: ../cadastro/testedrive');
            exit;
        } catch (\Exception $erro) {
            $_SESSION['mensagem'] = "Erro ao cadastrar teste drive: " . $erro;
            $_SESSION['tipoAlert'] = "danger";
            header('Location: ../cadastro/testedrive');
            exit;
        }
    }
}
