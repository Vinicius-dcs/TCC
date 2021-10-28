<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\DAO\UsuarioDAO;

class UsuarioController extends Controller
{

    public function cadastrarUsuario() {
        $usuario = new Usuario();
        $usuario->setNome($_POST['cadNome']);
        $usuario->setEmail($_POST['cadEmail']);
        $usuario->setSenha($_POST['cadSenha']);

        $usuarioDAO = new UsuarioDAO();
        $usuarioDAO->cadastrarUsuario($usuario);
        header('Location: ../login');
        exit;
    }
    
}