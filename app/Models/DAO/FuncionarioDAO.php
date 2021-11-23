<?php

namespace App\Models\DAO;

use App\Models\DAO\BaseDAO;
use App\Models\Funcionario;

class funcionarioDAO extends BaseDAO
{

    public function cadFuncionario(Funcionario $funcionario)
    {
        try {
            $nome = $funcionario->getNome();
            $dataNascimento = $funcionario->getDataNascimento();
            $dataAdmissao = $funcionario->getDataAdmissao();
            $email = $funcionario->getEmail();
            $sexo = $funcionario->getSexo();
            $cpf = $funcionario->getCpf();
            $telefone = $funcionario->getTelefone();

            $this->insert('funcionarios', "nome, dataNascimento, dataAdmissao, email, sexo, cpf, telefone", "'$nome', '$dataNascimento', '$dataAdmissao', '$email', '$sexo', '$cpf', '$telefone'");
        } catch (\Exception $erro) {
            echo "(FuncionarioDAO) Erro ao cadastrar funcionário: " . $erro;
        }
    }
}
