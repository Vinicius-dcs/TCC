<?php

namespace App\Models\DAO;

use App\Models\Usuario;
use PDOException;

class UsuarioDAO extends BaseDAO
{

    public function cadastrarUsuario(Usuario $usuario)
    {
        try {
            $nome = $usuario->getNome();
            $email = $usuario->getEmail();
            $senha = $usuario->getSenha();
            $this->insert('usuarios', "nome, email, senha", "'$nome', '$email', '$senha'");
        } catch (PDOException $erro) {
            echo "Erro ao cadastrar usuário: " . $erro;
        }
    }
}