<?php

namespace App\Models\DAO;

use App\Models\DAO\BaseDAO;
use App\Models\Veiculo;

class VeiculoDAO extends BaseDAO
{

    public function cadVeiculo(Veiculo $veiculo)
    {
        try {
            $modelo = $veiculo->getDescricao();
            $cor = $veiculo->getCor();
            $anoFabricacao = $veiculo->getAnoFabricacao();
            $anoModelo = $veiculo->getAnoModelo();
            $placa = $veiculo->getPlaca();
            $idCliente = $veiculo->getIdCliente();
            $idMarca = $veiculo->getIdMarca();

            $this->insert('veiculos', "descricao, cor, anoFabricacao, anoModelo, placa, idCliente, idMarca", "'$modelo', '$cor', '$anoFabricacao', '$anoModelo', '$placa', '$idCliente', '$idMarca'");
        } catch (\Exception $erro) {
            echo "(VeiculoDAO) Erro ao cadastrar veículo: " . $erro;
        }
    }

    public function altVeiculo(Veiculo $veiculo)
    {
        try {
            $id = $veiculo->getId();
            $descricao = $veiculo->getDescricao();
            $marca = $veiculo->getIdMarca();
            $cor = $veiculo->getCor();
            $anoFabricacao = $veiculo->getAnoFabricacao();
            $anoModelo = $veiculo->getAnoModelo();
            $placa = $veiculo->getPlaca();
            $cliente = $veiculo->getIdCliente();
            
            $sql = "UPDATE veiculos SET
            descricao = '$descricao',
            cor = '$cor',
            anoFabricacao = '$anoFabricacao',
            anoModelo = '$anoModelo',
            placa = '$placa',
            idCliente = '$cliente',
            idMarca = '$marca'
            WHERE id = '$id'";

            $this->update($sql);
        } catch (\Exception $erro) {
            echo "(VeiculoDAO) Erro ao alterar veiculo: " . $erro;
        }
    }

    public function deletVeiculo(Veiculo $veiculo) {
        try {
            $id = $veiculo->getId();
            $sql = "DELETE FROM veiculos WHERE id = '$id'";
            $this->delete($sql);
        } catch (\Exception $erro) {
            echo "(VeiculODAO) Erro ao excluir veículo " . $erro;
        }
    }

}
