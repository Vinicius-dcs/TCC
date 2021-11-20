<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\DAO\MarcaDAO;

class MarcaController extends Controller
{

    private $marca;
    private $marcaDAO;

    public function __construct()
    {
        $this->marca = new Marca();
        $this->marcaDAO = new MarcaDAO();
    }

    public function cadastrarMarca()
    {
        session_start();
        try {
            $this->marca->setNome(trim($_POST['nome']));

            $this->marcaDAO->cadMarca($this->marca);
            $_SESSION['mensagem'] = "Marca cadastrada com sucesso!";
            $_SESSION['tipoAlert'] = "success";
            header('Location: ../cadastro/marca');
            exit;
        } catch (\Exception $erro) {
            $_SESSION['mensagem'] = "(MarcaController) Erro ao cadastrar marca: " . $erro;
            $_SESSION['tipoAlert'] = "danger";
        }
    }

    public function listarMarca($id = null, $semLimiteConsulta = null)
    {
        try {
            if (empty($id) && empty($semLimiteConsulta)) {
                return $this->marca->Paginate(8);
            } elseif (!empty($id) && empty($semLimiteConsulta)) {
                $this->marca->setId($id);
                return $this->marcaDAO->selectMarca($this->marca);
            } elseif (!empty($id) && !empty($semLimiteConsulta)) {
                return $this->marca->all();
            }
        } catch (\Exception $erro) {
            echo "(MarcaController) Erro ao consultar marca: " . $erro;
        }
    }

    public function alterarMarca()
    {
        session_start();
        try {
            $this->marca->setId($_POST['idAlt']);
            $this->marca->setNome(trim($_POST['nomeAlt']));

            $this->marcaDAO->altMarca($this->marca);
            $_SESSION['mensagem'] = "Marca alterada com sucesso!";
            $_SESSION['tipoAlert'] = "success";
            header('Location: ../alteracao/marca');
            exit;
        } catch (\Exception $erro) {
            $_SESSION['mensagem'] = "(MarcaController) Erro ao alterar marca: " . $erro;
            $_SESSION['tipoAlert'] = "danger";
            echo $erro;
        }
    }

    public function deletarMarca()
    {
        session_start();
        try {
            $this->marca->setId($_POST['idExcluir']);

            $this->marcaDAO->deletMarca($this->marca);
            $_SESSION['mensagem'] = "Marca excluída com sucesso!";
            $_SESSION['tipoAlert'] = "success";
            header('Location: ../alteracao/marca');
            exit;
        } catch (\Exception $erro) {
            $_SESSION['mensagem'] = "(MarcaController) Erro ao excluir marca: " . $erro;
            $_SESSION['tipoAlert'] = "danger";
            echo $erro;
        }
    }
}
