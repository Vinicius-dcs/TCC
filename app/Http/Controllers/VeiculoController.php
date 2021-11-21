<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use App\Models\DAO\VeiculoDAO;

class VeiculoController extends Controller
{

    private $veiculo;
    private $veiculoDAO;

    public function __construct()
    {
        $this->veiculo = new Veiculo();
        $this->veiculoDAO = new VeiculoDAO();
    }

    public function cadastrarVeiculo()
    {
        session_start();
        try {
            $this->veiculo->setDescricao($_POST['descricao']);
            $this->veiculo->setCor($_POST['cor']);
            $this->veiculo->setAnoFabricacao($_POST['anoFabricacao']);
            $this->veiculo->setAnoModelo($_POST['anoModelo']);
            $this->veiculo->setPlaca($_POST['placa']);
            $this->veiculo->setOrigem($_POST['origem']);
            $this->veiculo->setIdCliente($_POST['cliente']);
            $this->veiculo->setIdMarca($_POST['marca']);

            $this->veiculoDAO->cadVeiculo($this->veiculo);
            $_SESSION['mensagem'] = "Veículo cadastrado com sucesso!";
            $_SESSION['tipoAlert'] = "success";
            header('Location: ../cadastro/veiculo');
            exit;
        } catch (\Exception $erro) {
            echo "(VeiculoController) Erro ao cadastrar veículo: " . $erro;
        }
    }

    public function listarVeiculo()
    {
        try {
            return $this->veiculo->paginate(9);
        } catch (\Exception $erro) {
            echo "(VeiculoController) Erro ao listar veículo: " . $erro;
        }
    }

    public function alterarVeiculo()
    {
        session_start();
        try {
            $this->veiculo->setId($_POST['id']);
            $this->veiculo->setDescricao($_POST['descricao']);
            $this->veiculo->setIdMarca($_POST['marca']);
            $this->veiculo->setCor($_POST['cor']);
            $this->veiculo->setAnoFabricacao($_POST['anoFabricacao']);
            $this->veiculo->setAnoModelo($_POST['anoModelo']);
            $this->veiculo->setPlaca($_POST['placa']);
            $this->veiculo->setOrigem($_POST['origem']);
            $this->veiculo->setIdCliente($_POST['cliente']);

            $this->veiculoDAO->altVeiculo($this->veiculo);
            $_SESSION['mensagem'] = "Veículo alterado com sucesso!";
            $_SESSION['tipoAlert'] = "success";
            header('Location: ../alteracao/veiculo');
            exit;
        } catch (\Exception $erro) {
            $_SESSION['mensagem'] = "(VeiculoController) Erro ao alterar veiculo: " . $erro;
            $_SESSION['tipoAlert'] = "danger";
            echo $erro;
        }
    }

    public function deletarVeiculo()
    {
        session_start();
        try {
            $this->veiculo->setId($_POST['idExcluir']);

            $this->veiculoDAO->deletVeiculo($this->veiculo);
            $_SESSION['mensagem'] = "Veículo excluído com sucesso!";
            $_SESSION['tipoAlert'] = "success";
            header('Location: ../alteracao/veiculo');
            exit;
        } catch (\Exception $erro) {
            $_SESSION['mensagem'] = "(VeiculoController) Erro ao excluir veiculo: " . $erro;
            $_SESSION['tipoAlert'] = "danger";
            echo $erro;
        }
    }
}
