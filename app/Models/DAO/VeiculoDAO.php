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
}
