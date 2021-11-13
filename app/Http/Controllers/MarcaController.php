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
            $_SESSION['mensagem'] = "Erro ao cadastrar marca: " . $erro;
            $_SESSION['tipoAlert'] = "danger";
        }
    }

    public function listarMarca()
    {
        try {
            return $this->marca->Paginate(8);
        } catch (\Exception $erro) {
            echo "Erro ao consultar marca: " . $erro;
        }
    }
}
