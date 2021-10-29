<?php

namespace App\Models\DAO;

define( 'MYSQL_HOST', 'localhost' );
define( 'MYSQL_USER', 'root' );
define( 'MYSQL_PASSWORD', '' );
define( 'MYSQL_DB_NAME', 'carimports' );

class Conexao {

    static function getConnection() {
        try {
            $conn = new \PDO( 'mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB_NAME, MYSQL_USER, MYSQL_PASSWORD);
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (\PDOException $erro) {
            echo 'Erro ao conectar no banco de dados: ' . $erro->getMessage();
        }
    }

}