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

    public function selectFuncionario(Funcionario $funcionario)
    {
        try {
            $id = $funcionario->getId();
            $sql = "SELECT * FROM funcionarios WHERE id = '$id'";
            return $this->select($sql);
        } catch (\Exception $erro) {
            echo "(FuncionarioDAO) Erro ao consultar funcionário: " . $erro;
        }
    }

    public function altFuncionario(Funcionario $funcionario)
    {
        try {
            $id = $funcionario->getId();
            $nome = $funcionario->getNome();
            $dataNascimento = $funcionario->getDataNascimento();
            $dataAdmissao = $funcionario->getDataAdmissao();
            $email = $funcionario->getEmail();
            $sexo = $funcionario->getSexo();
            $cpf = $funcionario->getCpf();
            $telefone = $funcionario->getTelefone();

            $sql = "UPDATE funcionarios SET nome = '$nome',
            dataNascimento = '$dataNascimento',
            dataAdmissao = '$dataAdmissao',
            email = '$email',
            sexo = '$sexo',
            cpf = '$cpf',
            telefone = '$telefone'
            WHERE id = $id";

            $this->update($sql);
        } catch (\Exception $erro) {
            echo "(FuncioanrioDAO) Erro ao alterar funcionário: " . $erro;
        }
    }

    public function deletFuncionario(Funcionario $funcionario)
    {
        try {
            $id = $funcionario->getId();
            $sql = "DELETE FROM funcionarios WHERE id = $id";
            $this->delete($sql);
        } catch (\Exception $erro) {
            echo "(FuncionarioDAO) Erro ao excluir funcionário: " . $erro;
        }
    }
}
