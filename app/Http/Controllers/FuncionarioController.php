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
            $nome = $this->funcionario->setNome($_POST['nome']);
            $dataNascimento = $this->funcionario->setDataNascimento($_POST['dataNascimento']);
            $dataAdmissao = $this->funcionario->setDataAdmissao($_POST['dataAdmissao']);
            $email = $this->funcionario->setEmail($_POST['email']);
            $sexo = $this->funcionario->setSexo($_POST['sexo']);
            $cpf = $this->funcionario->setCpf($_POST['cpf']);
            $telefone = $this->funcionario->setTelefone($_POST['telefone']);

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
}
