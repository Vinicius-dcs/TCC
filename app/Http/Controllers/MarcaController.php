<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\DAO\MarcaDAO;

session_start();

class MarcaController extends Controller
{
    public function cadastrarMarca() {
        try {
            $marca = new Marca();
            $marca->setNome(trim($_POST['nome']));

            $marcaDAO = new MarcaDAO();
            $marcaDAO->cadMarca($marca);
            $_SESSION['mensagem'] = "Marca cadastrada com sucesso!";
            $_SESSION['tipoAlert'] = "success";
            header('Location: ../cadastro/marca');
            exit;

        } catch (\Exception $erro) {
            $_SESSION['mensagem'] = "Erro ao cadastrar marca: " . $erro;
            $_SESSION['tipoAlert'] = "danger";
        }
    }
}
