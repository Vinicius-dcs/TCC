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
            $this->testeDrive->setHorario($_POST['horario']);
            $this->testeDrive->setObservacao($_POST['observacao']);
            $this->testeDrive->setSituacao("pendente");

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

    public function alterarTesteDrive()
    {
        session_start();
        try {
            $this->testeDrive->setId($_POST['id']);
            $this->testeDrive->setIdCliente($_POST['cliente']);
            $this->testeDrive->setIdVeiculo($_POST['veiculo']);
            $this->testeDrive->setIdFuncionario($_POST['funcionario']);
            $this->testeDrive->setData($_POST['data']);
            $this->testeDrive->setHorario($_POST['horario']);
            $this->testeDrive->setObservacao($_POST['observacao']);

            $this->testeDriveDAO->altTesteDrive($this->testeDrive);
            $_SESSION['mensagem'] = "Teste drive alterado com sucesso!";
            $_SESSION['tipoAlert'] = "success";
            header('Location: ../alteracao/testedrive');
            exit;
        } catch (\Exception $erro) {
            $_SESSION['mensagem'] = "Erro ao alterar teste drive: " . $erro;
            $_SESSION['tipoAlert'] = "danger";
            header('Location: ../alteracao/testedrive');
            exit;
        }
    }

    public function deletarTesteDrive()
    {
        session_start();
        try {
            $this->testeDrive->setId($_POST['idExcluir']);

            $this->testeDriveDAO->deletTesteDrive($this->testeDrive);
            $_SESSION['mensagem'] = "Teste drive excluído com sucesso!";
            $_SESSION['tipoAlert'] = "success";
            header('Location: ../alteracao/testedrive');
            exit;
        } catch (\Exception $erro) {
            $_SESSION['mensagem'] = "Erro ao excluir teste drive: " . $erro;
            $_SESSION['tipoAlert'] = "danger";
            header('Location: ../alteracao/testedrive');
            exit;
        }
    }

    public function listarTesteDrive($id = null, $semLimiteConsulta = null)
    {
        try {
            if (empty($id) && empty($semLimiteConsulta)) {
                return $this->testeDrive->Paginate(8);
            } elseif (!empty($id) && empty($semLimiteConsulta)) {
                $this->testeDrive->setId($id);
                // return $this->testeDriveDAO->selectTesteDrive($this->testeDrive);
            } elseif (!empty($id) && !empty($semLimiteConsulta)) {
                return $this->testeDrive->all();
            }
        } catch (\Exception $erro) {
            echo "(TesteDriveController) Erro ao consultar teste drive: " . $erro;
        }
    }

    public function listarTesteDrivePeA()
    {
        try {
            return $this->testeDrive->where('situacao', '=', 'pendente')->orWhere('situacao', '=', 'atrasado')->Paginate(8);
        } catch (\Exception $erro) {
            echo "(TesteDriveController) Erro ao consultar testes drives pendentes e atrasados: " . $erro;
        }
    }

    public function concluirTesteDrive()
    {
        session_start();
        try {
            $this->testeDrive->setId($_POST['id']);
            $this->testeDriveDAO->concluirTesteDriveDAO($this->testeDrive);

            $_SESSION['mensagem'] = "Teste Drive concluído com sucesso!";
            $_SESSION['tipoAlert'] = "success";
            header('Location: ../check/testedrive');
            exit;
        } catch (\Exception $erro) {
            $_SESSION['mensagem'] = "Erro ao concluir teste drive: " . $erro;
            $_SESSION['tipoAlert'] = "danger";
            echo "(TesteDriveController) Erro ao concluir teste drive: " . $erro;
        }
    }

    public function adiarTesteDrive()
    {
        session_start();
        try {
            $this->testeDrive->setId($_POST['id']);
            $this->testeDrive->setData($_POST['novaData']);
            $this->testeDriveDAO->adiarTesteDriveDAO($this->testeDrive);

            $_SESSION['mensagem'] = "Teste drive adiado com sucesso!";
            $_SESSION['tipoAlert'] = "success";
            header('Location: ../check/testedrive');
            exit;
        } catch (\Exception $erro) {
            $_SESSION['mensagem'] = "Erro ao adiar teste drive: " . $erro;
            $_SESSION['tipoAlert'] = "danger";
            echo "(TesteDriveController) Erro ao adiar teste drive: " . $erro;
        }
    }

    public function cancelarTesteDrive()
    {
        session_start();
        try {
            $this->testeDrive->setId($_POST['id']);
            $this->testeDriveDAO->cancelarTesteDriveDAO($this->testeDrive);

            $_SESSION['mensagem'] = "Teste drive cancelado com sucesso!";
            $_SESSION['tipoAlert'] = "success";
            header('Location: ../check/testedrive');
            exit;
        } catch (\Exception $erro) {
            $_SESSION['mensagem'] = "Erro ao cancelar teste drive: " . $erro;
            $_SESSION['tipoAlert'] = "danger";
            echo "(TesteDriveController) Erro ao cancelar teste drive: " . $erro;
        }
    }
}
