<?php

namespace App\Models\DAO;

use App\Models\DAO\BaseDAO;
use App\Models\Cliente;

class ClienteDAO extends BaseDAO
{

    public function cadCliente(Cliente $cliente)
    {
        try {
            $nome = $cliente->getNome();
            $dataNascimento = $cliente->getDataNascimento();
            $endereco = $cliente->getEndereco();
            $cpf = $cliente->getCpf();
            $cep = $cliente->getCep();
            $cidade = $cliente->getCidade();
            $estado = $cliente->getEstado();

            $this->insert('clientes', "nome, dataNascimento, endereco, cpf, cep, cidade, estado", "'$nome', '$dataNascimento', '$endereco', '$cpf', '$cep', '$cidade', '$estado'");
        } catch (\Exception $erro) {
            echo "(ClienteDAO) Erro ao cadastrar cliente: " . $erro;
        }
    }

    public function altCliente(Cliente $cliente)
    {
        try {
            $id = $cliente->getId();
            $nome = $cliente->getNome();
            $dataNascimento = $cliente->getDataNascimento();
            $endereco = $cliente->getEndereco();
            $cpf = $cliente->getCpf();
            $cep = $cliente->getCep();
            $cidade = $cliente->getCidade();
            $estado = $cliente->getEstado();

            $sql = "UPDATE clientes SET nome = '$nome',
            dataNascimento = '$dataNascimento', 
            endereco = '$endereco', 
            cpf = '$cpf', 
            cep = '$cep', 
            cidade = '$cidade', 
            estado = '$estado'
            WHERE id = $id";
            $this->update($sql);
        } catch (\Exception $erro) {
            echo "(ClienteDAO) Erro ao alterar cliente: " . $erro;
        }
    }

    public function deletCliente(Cliente $cliente)
    {
        try {
            $id = $cliente->getId();
            $sql = "DELETE FROM clientes WHERE id = $id";
            $this->delete($sql);
        } catch (\Exception $erro) {
            echo "(ClienteDAO) Erro ao excluir cliente: " . $erro;
        }
    }
}
