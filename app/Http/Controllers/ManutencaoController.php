<?php

namespace App\Http\Controllers;

use App\Models\Manutencao;
use App\Models\DAO\ManutencaoDAO;

class ManutencaoController extends Controller
{

    private $manutencao;
    private $manutencaoDAO;

    public function __construct()
    {
        $this->manutencao = new Manutencao();
        $this->manutencaoDAO = new ManutencaoDAO();
    }

    public function cadastrarManutencao()
    {
        session_start();
        try {
            $this->manutencao->setIdVeiculo($_POST['veiculo']);
            $this->manutencao->setIdFuncionario($_POST['funcionario']);
            $this->manutencao->setHorario($_POST['horario']);
            $this->manutencao->setData($_POST['data']);
            $this->manutencao->setValor($_POST['valor']);
            $this->manutencao->setDescricao($_POST['descricao']);
            $this->manutencao->setTipoManutencao($_POST['tipoManutencao']);
            $this->manutencao->setSituacao("pendente");

            $this->manutencaoDAO->cadManutencao($this->manutencao);
            $_SESSION['mensagem'] = "Manutenção  cadastrada com sucesso!";
            $_SESSION['tipoAlert'] = "success";
            header('Location: ../cadastro/manutencao');
            exit;
        } catch (\Exception $erro) {
            $_SESSION['mensagem'] = "Erro ao cadastrar manutenção: " . $erro;
            $_SESSION['tipoAlert'] = "danger";
            echo "(ManutencaoController) Erro ao cadastrar manutenção: " . $erro;
        }
    }

    public function listarManutencao($id = null, $semLimiteConsulta = null)
    {
        try {
            if (empty($id) && empty($semLimiteConsulta)) {
                return $this->manutencao->Paginate(8);
            } elseif (!empty($id) && empty($semLimiteConsulta)) {
                $this->manutencao->setId($id);
                return $this->manutencaoDAO->selectManutencao($this->manutencao);
            } elseif (!empty($id) && !empty($semLimiteConsulta)) {
                return $this->manutencao->all();
            }
        } catch (\Exception $erro) {
            echo "(ManutencaoController) Erro ao consultar manutenção: " . $erro;
        }
    }
}
