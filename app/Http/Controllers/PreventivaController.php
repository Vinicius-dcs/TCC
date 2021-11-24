<?php

namespace App\Http\Controllers;

use App\Models\Preventiva;
use App\Models\DAO\PreventivaDAO;

class PreventivaController extends Controller
{

    private $preventiva;
    private $preventivaDAO;

    public function __construct()
    {
        $this->preventiva = new Preventiva();
        $this->preventivaDAO = new PreventivaDAO();
    }

    public function cadastrarPreventiva()
    {
        session_start();
        try {
            $this->preventiva->setIdVeiculo($_POST['veiculo']);
            $this->preventiva->setIdFuncionario($_POST['funcionario']);
            $this->preventiva->setHorario($_POST['horario']);
            $this->preventiva->setData($_POST['data']);
            $this->preventiva->setValor($_POST['valor']);
            $this->preventiva->setDescricao($_POST['descricao']);

            $this->preventivaDAO->cadPreventiva($this->preventiva);
            $_SESSION['mensagem'] = "Manutenção preventiva cadastrada com sucesso!";
            $_SESSION['tipoAlert'] = "success";
            header('Location: ../cadastro/manutencao-preventiva');
            exit;
        } catch (\Exception $erro) {
            $_SESSION['mensagem'] = "Erro ao cadastrar manutenção preventiva: " . $erro;
            $_SESSION['tipoAlert'] = "danger";
            echo "(PreventivaController) Erro ao cadastrar manutenção preventiva: " . $erro;
        }
    }
}
