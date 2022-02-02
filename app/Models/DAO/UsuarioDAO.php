<?php

namespace App\Models\DAO;

use App\Models\Usuario;

class UsuarioDAO extends BaseDAO
{

    public function cadastrarUsuario(Usuario $usuario)
    {
        try {
            $nome = $usuario->getNome();
            $email = $usuario->getEmail();
            $senha = $usuario->getSenha();
            $this->insert('usuarios', "nome, email, senha", "'$nome', '$email', '$senha'");
        } catch (\Exception $erro) {
            echo "(UsuarioDAO) Erro ao cadastrar usuário: " . $erro;
        }
    }

    public function verificaSeExisteEmail(Usuario $usuario)
    {
        $email = $usuario->getEmail();
        return $this->select("SELECT nome FROM usuarios WHERE email = '$email'");
    }

    public function verificaLoginUsuario(Usuario $usuario)
    {
        try {
            $email = $usuario->getEmail();
            $senha = $usuario->getSenha();

            echo $email . "\n";
            echo $senha . "\n";

            return $this->select("SELECT COUNT(*) AS total FROM usuarios WHERE email = '$email' AND senha = '$senha'");
        } catch (\Exception $erro) {
            echo "(UsuarioDAO) Erro ao logar no sistema: " . $erro;
        }
    }

    public function recuperaSenha(Usuario $usuario)
    {
        try {
            $email = $usuario->getEmail();
            return $this->select("SELECT senha FROM usuarios WHERE email = '$email'");
        } catch (\Exception $erro) {
            echo "(UsuarioDAO) Erro ao recuperar senha: " . $erro;
        }
    }
}
