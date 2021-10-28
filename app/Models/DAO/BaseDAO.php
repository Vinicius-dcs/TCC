<?php

namespace App\Models\DAO;

use App\Models\DAO\Conexao;

class BaseDAO
{

    private $conexao;

    public function __construct()
    {
        $this->conexao = new Conexao();
    }

    public function insert($table, $columns, $values)
    {       
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = $this->conexao->getConnection()->prepare($sql);
        $stmt->execute();
    }
}
