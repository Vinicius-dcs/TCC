<?php

namespace App\Models\DAO;

use App\Models\DAO\BaseDAO;
use App\Models\Preventiva;

class PreventivaDAO extends BaseDAO
{

    public function cadPreventiva(Preventiva $preventiva) {
        try {
            $idVeiculo = $preventiva->getIdVeiculo();
            $idFuncionario = $preventiva->getIdFuncionario();
            $data = $preventiva->getData();
            $horario = $preventiva->getHorario();
            $valor = $preventiva->getValor();
            $descricao = $preventiva->getDescricao();

            $this->insert('preventivas', "data, horario, descricao, valor, idVeiculo, idFuncionario", "'$data', '$horario', '$descricao', '$valor', '$idVeiculo', '$idFuncionario'");
        } catch (\Exception $erro) {
            echo "(VeiculoDAO) Erro ao cadastrar manutenção preventiva: " . $erro;
        }
    }

    public function selectPreventivaAPI(Preventiva $id) {
        try {
            $sql = "SELECT * FROM preventivas WHERE id = '$id'";
            return json_encode($this->select($sql));
        } catch (\Exception $erro) {
            return json_encode("erro=>$erro");
        }
    }

}
