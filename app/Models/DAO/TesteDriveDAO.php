<?php

namespace App\Models\DAO;

use App\Models\DAO\BaseDAO;
use App\Models\TesteDrive;

class TesteDriveDAO extends BaseDAO
{

    public function cadTesteDrive(TesteDrive $testeDrive)
    {
        try {
            $idCliente = $testeDrive->getIdCliente();
            $idVeiculo = $testeDrive->getIdVeiculo();
            $idFuncionario = $testeDrive->getIdFuncionario();
            $data = $testeDrive->getData();
            $horario = $testeDrive->getHorario();
            $observacao = $testeDrive->getObservacao();

            $this->insert('testedrives', "data, horario, observacao, idCliente, idVeiculo, idFuncionario", "'$data', '$horario', '$observacao', '$idCliente', '$idVeiculo', '$idFuncionario'");
        } catch (\Exception $erro) {
            echo "(TesteDriveDAO) Erro ao cadastrar teste drive " . $erro;
        }
    }

    public function selectTesteDriveAPI()
    {
        try {
            $sql = "SELECT * FROM testedrives";
            return json_encode($this->select($sql));
        } catch (\Exception $erro) {
            return json_encode("erro=>$erro");
        }
    }

    public function altTesteDrive(TesteDrive $testeDrive)
    {
        try {
            $id = $testeDrive->getId();
            $idCliente = $testeDrive->getIdCliente();
            $idVeiculo = $testeDrive->getIdVeiculo();
            $idFuncionario = $testeDrive->getIdFuncionario();
            $data = $testeDrive->getData();
            $horario = $testeDrive->getHorario();
            $observacao = $testeDrive->getObservacao();

            $sql = "UPDATE testeDrives SET
            idCliente = '$idCliente',
            idVeiculo = '$idVeiculo',
            idFuncionario = '$idFuncionario',
            data = '$data',
            horario = '$horario',
            observacao = '$observacao'
            WHERE id = '$id'";
            $this->update($sql);
        } catch (\Exception $erro) {
            echo "(TesteDriveDAO) Erro ao alterar teste drive " . $erro;
        }
    }

    public function deletTesteDrive(TesteDrive $testeDrive) {
        try {
            $id = $testeDrive->getId();

            $sql = "DELETE FROM testeDrives WHERE id = '$id'";
            $this->delete($sql);
        } catch (\Exception $erro) {
            echo "(TesteDriveDAO) Erro ao excluir o teste drive " . $erro;
        }
    }

}
