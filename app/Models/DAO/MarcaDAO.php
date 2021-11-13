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
            echo "Erro ao cadastrar marca: " . $erro;
        }
    }
}
