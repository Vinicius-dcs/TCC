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

    public function cadastrarVeiculo() {
        session_start();
        try {
            $this->veiculo->setDescricao($_POST['descricao']);
            $this->veiculo->setCor($_POST['cor']);
            $this->veiculo->setAnoFabricacao($_POST['anoFabricacao']);
            $this->veiculo->setAnoModelo($_POST['anoModelo']);
            $this->veiculo->setPlaca($_POST['placa']);
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

    public function listarVeiculo() {
        try {
            return $this->veiculo->paginate(9);
        } catch (\Exception $erro) {
            echo "(VeiculoController) Erro ao listar veículo: " . $erro;
        }
    }

}
