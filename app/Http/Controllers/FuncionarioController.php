<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\DAO\FuncionarioDAO;

class FuncionarioController extends Controller
{

    private $funcionario;
    private $funcionarioDAO;

    public function __construct()
    {
        $this->funcionario = new Funcionario();
        $this->funcionarioDAO = new FuncionarioDAO();
    }

    public function cadastrarFuncionario()
    {
        session_start();
        try {
            $this->funcionario->setNome($_POST['nome']);
            $this->funcionario->setDataNascimento($_POST['dataNascimento']);
            $this->funcionario->setDataAdmissao($_POST['dataAdmissao']);
            $this->funcionario->setEmail($_POST['email']);
            $this->funcionario->setSexo($_POST['sexo']);
            $this->funcionario->setCpf(str_replace(array(".", "-"), '', $_POST['cpf']));
            $this->funcionario->setTelefone(str_replace(array("-", "(", ")", " "), '', $_POST['telefone']));

            $this->funcionarioDAO->cadFuncionario($this->funcionario);
            $_SESSION['mensagem'] = "Funcionário cadastrado com sucesso!";
            $_SESSION['tipoAlert'] = "success";
            header('Location: ../cadastro/funcionario');
            exit;
        } catch (\Exception $erro) {
            $_SESSION['mensagem'] = "(FuncionarioController) Erro ao cadastrar funcionário: " . $erro;
            $_SESSION['tipoAlert'] = "danger";
            echo "(FuncionarioController) Erro ao cadastrar funcionário: " . $erro;
        }
    }

    public function listarFuncionarios($id = null, $semLimiteConsulta = null)
    {
        try {
            if (empty($id) && empty($semLimiteConsulta)) {
                return $this->funcionario->Paginate(9);
            } elseif (!empty($id) && empty($semLimiteConsulta)) {
                $this->funcionario->setId($id);
                return $this->funcionarioDAO->selectFuncionario($this->funcionario);
            } elseif (!empty($id) && !empty($semLimiteConsulta)) {
                return $this->funcionario->all();
            }
        } catch (\Exception $erro) {
            echo "(FuncionarioController) Erro ao consultar funcionário: " . $erro;
        }
    }

    public function alterarFuncionario()
    {
        session_start();
        try {
            $this->funcionario->setId($_POST['id']);
            $this->funcionario->setNome($_POST['nome']);
            $this->funcionario->setDataNascimento($_POST['dataNascimento']);
            $this->funcionario->setDataAdmissao($_POST['dataAdmissao']);
            $this->funcionario->setEmail($_POST['email']);
            $this->funcionario->setSexo($_POST['sexo']);
            $this->funcionario->setCpf(str_replace(array(".", "-"), '', $_POST['cpf']));
            $this->funcionario->setTelefone(str_replace(array("-", "(", ")", " "), '', $_POST['telefone']));

            $this->funcionarioDAO->altFuncionario($this->funcionario);
            $_SESSION['mensagem'] = "Funcionário alterado com sucesso!";
            $_SESSION['tipoAlert'] = "success";
            header('Location: ../alteracao/funcionario');
            exit;
        } catch (\Exception $erro) {
            $_SESSION['mensagem'] = "(FuncionarioController) Erro ao alterar funcionário: " . $erro;
            $_SESSION['tipoAlert'] = "danger";
            echo $erro;
        }
    }

    public function deletarFuncionario()
    {
        session_start();
        try {
            $this->funcionario->setId($_POST['idExcluir']);

            $this->funcionarioDAO->deletFuncionario($this->funcionario);
            $_SESSION['mensagem'] = "Funcionário excluído com sucesso!";
            $_SESSION['tipoAlert'] = "success";
            header('Location: ../alteracao/funcionario');
            exit;
        } catch (\Exception $erro) {
            $_SESSION['mensagem'] = "(FuncionarioController) Erro ao excluir funcionário: " . $erro;
            $_SESSION['tipoAlert'] = "danger";
            echo $erro;
        }
    }
}
