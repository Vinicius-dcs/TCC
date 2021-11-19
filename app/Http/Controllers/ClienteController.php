<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\DAO\ClienteDAO;

use function PHPUnit\Framework\isEmpty;

class ClienteController extends Controller
{

    private $cliente;
    private $clienteDAO;

    public function __construct()
    {
        $this->cliente = new Cliente();
        $this->clienteDAO = new ClienteDAO();
    }

    public function cadastrarCliente()
    {
        session_start();
        try {
            $this->cliente->setNome($_POST['nome']);
            $this->cliente->setDataNascimento($_POST['dataNascimento']);
            $this->cliente->setEndereco($_POST['endereco']);
            $this->cliente->setCpf(str_replace(array(".", "-"), '', $_POST['cpf']));
            $this->cliente->setCep(str_replace("-", '', $_POST['cep']));
            $this->cliente->setCidade($_POST['cidade']);
            $this->cliente->setEstado($_POST['estado']);

            $this->clienteDAO->cadCliente($this->cliente);
            $_SESSION['mensagem'] = "Cliente cadastrado com sucesso!";
            $_SESSION['tipoAlert'] = "success";
            header('Location: ../cadastro/cliente');
            exit;
        } catch (\Exception $erro) {
            $_SESSION['mensagem'] = "(ClienteController) Erro ao cadastrar cliente: " . $erro;
            $_SESSION['tipoAlert'] = "danger";
        }
    }

    public function listarClientes($id = null, $semLimiteConsulta = null)
    {
        try {
            if (empty($id) && empty($semLimiteConsulta)) {
                return $this->cliente->Paginate(9);
            } elseif (!empty($id) && empty($semLimiteConsulta)) {
                return $this->cliente->where('id', '=', $id)->Paginate(1);
            } elseif (!empty($id) && !empty($semLimiteConsulta)) {
                return $this->clienteDAO->selecionarNomesClientes();
            }
        } catch (\Exception $erro) {
            echo "(ClienteController) Erro ao consultar cliente: " . $erro;
        }
    }

    public function alterarCliente()
    {
        session_start();
        try {
            $this->cliente->setId($_POST['id']);
            $this->cliente->setNome($_POST['nome']);
            $this->cliente->setDataNascimento($_POST['dataNascimento']);
            $this->cliente->setEndereco($_POST['endereco']);
            $this->cliente->setCpf(str_replace(array(".", "-"), '', $_POST['cpf']));
            $this->cliente->setCep(str_replace("-", '', $_POST['cep']));
            $this->cliente->setCidade($_POST['cidade']);
            $this->cliente->setEstado($_POST['estado']);

            $this->clienteDAO->altCliente($this->cliente);
            $_SESSION['mensagem'] = "Cliente alterado com sucesso!";
            $_SESSION['tipoAlert'] = "success";
            header('Location: ../alteracao/cliente');
            exit;
        } catch (\Exception $erro) {
            $_SESSION['mensagem'] = "(ClienteController) Erro ao alterar cliente: " . $erro;
            $_SESSION['tipoAlert'] = "danger";
            echo $erro;
        }
    }

    public function deletarCliente()
    {
        session_start();
        try {
            $this->cliente->setId($_POST['idExcluir']);

            $this->clienteDAO->deletCliente($this->cliente);
            $_SESSION['mensagem'] = "Cliente excluído com sucesso!";
            $_SESSION['tipoAlert'] = "success";
            header('Location: ../alteracao/cliente');
            exit;
        } catch (\Exception $erro) {
            $_SESSION['mensagem'] = "(ClienteController) Erro ao excluir cliente: " . $erro;
            $_SESSION['tipoAlert'] = "danger";
            echo $erro;
        }
    }
}
