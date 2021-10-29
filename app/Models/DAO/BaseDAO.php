<?php

namespace App\Models\DAO;

use App\Models\DAO\Conexao;

class BaseDAO
{

    private $conexao;

    public function __construct()
    {
        $this->conexao = Conexao::getConnection();
    }

    public function insert($table, $columns, $values)
    {
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();
    }

    public function select($sql)
    {
        $result = $this->conexao->query($sql);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
}
