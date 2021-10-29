<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\DAO\UsuarioDAO;

session_start();

class UsuarioController extends Controller
{

    public function cadastrarUsuario()
    {
        try {
            $usuario = new Usuario();
            $usuario->setNome(trim($_POST['cadNome']));
            $usuario->setEmail(trim($_POST['cadEmail']));
            $usuario->setSenha(trim(md5($_POST['cadSenha'])));

            if (!$this->verificaSeExisteEmail($usuario)) {
                $usuarioDAO = new UsuarioDAO();
                $usuarioDAO->cadastrarUsuario($usuario);
                exit;
            }
        } catch (\Exception $erro) {
            echo "Erro ao cadastrar usuário: " . $erro;
        }
    }

    public function verificaSeExisteEmail(Usuario $usuario)
    {
        try {
            $usuarioDAO = new UsuarioDAO();
            $result = $usuarioDAO->verificaSeExisteEmail($usuario);

            if (!empty($result)) {
                $_SESSION['mensagemDanger'] = "E-mail já cadastrado!";
                header('Location: ../login');
                exit;
                return true;
            } else {
                $_SESSION['mensagemSucces'] = "Usuário cadastrado com sucesso!";
                header('Location: ../login');
                return false;
            }
        } catch (\Exception $erro) {
            echo "Erro ao verificar se já existe e-mail cadastrado: " . $erro;
        }
    }

    public function logarUsuario() {
        try {
            $usuario = new Usuario();
            $usuario->setEmail(trim($_POST['loginEmail']));
            $usuario->setSenha(trim(md5($_POST['loginSenha'])));

            $usuarioDAO = new UsuarioDAO();
            $result = $usuarioDAO->verificaLoginUsuario($usuario);

            if($result[0]['total'] == 1) {
                $_SESSION['loginAutorizado'] = true;
                echo "autorizado";
                header('Location: ../sistema');
                exit;
            } else {
                $_SESSION['loginAutorizado'] = false;
                header('Location: ../login');
                exit;
            }
                        
        } catch (\PDOException $erro) {
            echo "Erro ao entrar no sistema: " . $erro;
        }
    }
}