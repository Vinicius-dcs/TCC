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
            $tipoManutencao = $manutencao->getTipoManutencao();
            $situacao = $manutencao->getSituacao();

            $this->insert('manutencoes', "data, horario, descricao, valor, tipomanutencao, situacao, idVeiculo, idFuncionario", "'$data', '$horario', '$descricao', '$valor', '$tipoManutencao', '$situacao', '$idVeiculo', '$idFuncionario'");
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

    public function concluirManutencaoDAO(Manutencao $manutencao) {
        try {
            $id = $manutencao->getId();
            $sql = "UPDATE manutencoes SET situacao = 'concluida' WHERE id = '$id'";
            $this->update($sql);
        } catch (\Exception $erro) {
            echo "(ManutencaoDAO) Erro ao concluir manutenção " . $erro;
        }
    }

    public function adiarManutencaoDAO(Manutencao $manutencao) {
        try {
            $data = $manutencao->getData();
            $id = $manutencao->getId();
            $sql = "UPDATE manutencoes SET data = '$data', situacao = 'pendente' WHERE id = '$id'";
            $this->update($sql);
        } catch (\Exception $erro) {
            echo "(ManutencaoDAO) Erro ao adiar manutenção " . $erro;
        }
    }

    public function cancelarManutencaoDAO(Manutencao $manutencao) {
        try {
            $id = $manutencao->getId();
            $sql = "UPDATE manutencoes SET situacao = 'cancelada' WHERE id = '$id'";
            $this->update($sql);
        } catch (\Exception $erro) {
            echo "(ManutencaoDAO) Erro ao cancelar manutenção " . $erro;
        }
    }

}
