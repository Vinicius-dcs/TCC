<?php

namespace App\Models\DAO;

use App\Models\DAO\BaseDAO;
use App\Models\Manutencao;

class ManutencaoDAO extends BaseDAO
{

    public function cadManutencao(Manutencao $manutencao)
    {
        try {
            $idVeiculo = $manutencao->getIdVeiculo();
            $idFuncionario = $manutencao->getIdFuncionario();
            $data = $manutencao->getData();
            $horario = $manutencao->getHorario();
            $valor = $manutencao->getValor();
            $descricao = $manutencao->getDescricao();

            $this->insert('manutencoes', "data, horario, descricao, valor, idVeiculo, idFuncionario", "'$data', '$horario', '$descricao', '$valor', '$idVeiculo', '$idFuncionario'");
        } catch (\Exception $erro) {
            echo "(ManutencaoDAO) Erro ao cadastrar manutenção: " . $erro;
        }
    }

    public function selectManutencao(Manutencao $manutencao)
    {
        try {
            $id = $manutencao->getId();
            $sql = "SELECT * FROM manutencoes WHERE id = '$id'";
            return $this->select($sql);
        } catch (\Exception $erro) {
            echo "(ManutencaoDAO) Erro ao consultar manutenção " . $erro;
        }
    }

    public function selectManutencaoAPI()
    {
        try {
            $sql = "SELECT * FROM manutencoes";
            return json_encode($this->select($sql));
        } catch (\Exception $erro) {
            return json_encode("erro=>$erro");
        }
    }
}
