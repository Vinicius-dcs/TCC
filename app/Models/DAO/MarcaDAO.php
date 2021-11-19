<?php

namespace App\Models\DAO;

use App\Models\DAO\BaseDAO;
use App\Models\Marca;

class MarcaDAO extends BaseDAO
{

    public function cadMarca(Marca $marca)
    {
        try {
            $nome = $marca->getNome();
            $this->insert('marcas', "nome", "'$nome'");
        } catch (\Exception $erro) {
            echo "(MarcaDAO) Erro ao cadastrar marca: " . $erro;
        }
    }

    public function altMarca(Marca $marca)
    {
        try {
            $id = $marca->getId();
            $nome = $marca->getNome();

            $sql = "UPDATE marcas SET nome = '$nome' WHERE id = $id";
            $this->update($sql);
        } catch (\Exception $erro) {
            echo "(MarcaDAO) Erro ao alterar marca: " . $erro;
        }
    }

    public function deletMarca(Marca $marca)
    {
        try {
            $id = $marca->getId();
            $sql = "DELETE FROM marcas WHERE id = $id";
            $this->delete($sql);
        } catch (\Exception $erro) {
            echo "(MarcaDAO) Erro ao excluir marca: " . $erro;
        }
    }

    public function selecionarNomesMarcas()
    {
        try {
            $sql = "SELECT id, nome FROM marcas";
            return $this->select($sql);
        } catch (\Exception $erro) {
            echo "(MarcaDAO) Erro ao consultar marca: " . $erro;
        }
    }
}
