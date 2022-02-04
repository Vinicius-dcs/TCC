<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Models\Usuario;
use App\Models\DAO\UsuarioDAO;
use App\Mail\RecuperarSenha;

session_start();

class UsuarioController extends Controller
{

    public function cadastrarUsuario()
    {
        try {
            $usuario = new Usuario();
            $usuario->setNome(trim($_POST['cadNome']));
            $usuario->setEmail(trim($_POST['cadEmail']));
            $usuario->setSenha(trim($_POST['cadSenha']));

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

    public function logarUsuario()
    {
        try {
            $usuario = new Usuario();
            $usuario->setEmail(trim($_POST['loginEmail']));
            $usuario->setSenha(trim($_POST['loginSenha']));

            $usuarioDAO = new UsuarioDAO();
            $result = $usuarioDAO->verificaLoginUsuario($usuario);

            if ($result[0]['total'] == 1) {
                $_SESSION['loginAutorizado'] = true;
                header('Location: ../sistema/inicio');
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

    public static function verificaSeExisteSessao()
    {
        if (!isset($_SESSION['loginAutorizado'])) {
            header('Location: /carimports/public/sistema/unauthorized');
            exit;
        } else {
            header('Location: ../sistema/inicio');
        }
    }

    public static function enviarEmailRecuperarSenha(Usuario $usuario)
    {
        try {
            $usuarioDAO = new UsuarioDAO();
            $email = $usuario->getEmail();
            $senha = $usuarioDAO->recuperaSenha($usuario);
            
            $detalhes = [
                'senha' => $senha[0]['senha'],
            ];

            Mail::to($email)->send(new RecuperarSenha($detalhes));
        } catch (\Exception $erro) {
            echo "(UsuarioController) Erro ao enviar email recuperação de senha: " . $erro;
        }
    }

    public function recuperarSenha()
    {
        try {
            $usuario = new Usuario();
            $usuarioDAO = new UsuarioDAO();
            $usuario->setEmail($_POST['email']);

            if (!empty($usuarioDAO->verificaSeExisteEmail($usuario))) {
                $this->enviarEmailRecuperarSenha($usuario);
            }
            
            header('Location: ./login');
            exit();
        } catch (\Exception $erro) {
            echo "(UsuarioController) Erro ao executar método recuperar senha: " . $erro;
        }
    }
}
