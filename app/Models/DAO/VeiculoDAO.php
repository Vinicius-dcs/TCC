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
            $origem = $veiculo->getOrigem();
            $idCliente = $veiculo->getIdCliente();
            $idMarca = $veiculo->getIdMarca();

            if ($origem === "concessionária") {
                $this->insert('veiculos', "descricao, cor, anoFabricacao, anoModelo, placa, origem, idMarca", "'$modelo', '$cor', '$anoFabricacao', '$anoModelo', '$placa', 'concessionária', '$idMarca'");
            } else {
                $this->insert('veiculos', "descricao, cor, anoFabricacao, anoModelo, placa, origem, idCliente, idMarca", "'$modelo', '$cor', '$anoFabricacao', '$anoModelo', '$placa', '$origem', '$idCliente', '$idMarca'");
            }
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
            $origem = $veiculo->getOrigem();

            if ($origem === "concessionária") {
                $sql = "UPDATE veiculos SET
                descricao = '$descricao',
                cor = '$cor',
                anoFabricacao = '$anoFabricacao',
                anoModelo = '$anoModelo',
                placa = '$placa',
                origem = '$origem',
                idMarca = '$marca'
                WHERE id = '$id'";
            } else {
                $cliente = $veiculo->getIdCliente();

                $sql = "UPDATE veiculos SET
                descricao = '$descricao',
                cor = '$cor',
                anoFabricacao = '$anoFabricacao',
                anoModelo = '$anoModelo',
                placa = '$placa',
                origem = '$origem',
                idCliente = '$cliente',
                idMarca = '$marca'
                WHERE id = '$id'";
            }
            $this->update($sql);
        } catch (\Exception $erro) {
            echo "(VeiculoDAO) Erro ao alterar veiculo: " . $erro;
        }
    }

    public function deletVeiculo(Veiculo $veiculo)
    {
        try {
            $id = $veiculo->getId();
            $sql = "DELETE FROM veiculos WHERE id = '$id'";
            $this->delete($sql);
        } catch (\Exception $erro) {
            echo "(VeiculODAO) Erro ao excluir veículo " . $erro;
        }
    }

    public function selectVeiculo(Veiculo $veiculo)
    {
        try {
            $id = $veiculo->getId();
            $sql = "SELECT * FROM veiculos WHERE id = '$id'";
            return $this->select($sql);
        } catch (\Exception $erro) {
            echo "(VeiculoDAO) Erro ao consultar veículo " . $erro;
        }
    }
}
