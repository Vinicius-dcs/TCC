<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{

    private $id;
    private $idCliente;
    private $idMarca;
    private $descricao;
    private $cor;
    private $anoFabricacao;
    private $anoModelo;
    private $placa;
    private $origem;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIdCliente()
    {
        return $this->idCliente;
    }

    public function setIdCliente($idCliente)
    {
        $this->idCliente = $idCliente;
    }

    public function getIdMarca()
    {
        return $this->idMarca;
    }

    public function setIdMarca($idMarca)
    {
        $this->idMarca = $idMarca;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getCor()
    {
        return $this->cor;
    }

    public function setCor($cor)
    {
        $this->cor = $cor;
    }

    public function getAnoFabricacao()
    {
        return $this->anoFabricacao;
    }

    public function setAnoFabricacao($anoFabricacao)
    {
        $this->anoFabricacao = $anoFabricacao;
    }

    public function getAnoModelo()
    {
        return $this->anoModelo;
    }

    public function setAnoModelo($anoModelo)
    {
        $this->anoModelo = $anoModelo;
    }

    public function getPlaca()
    {
        return $this->placa;
    }

    public function setPlaca($placa)
    {
        $this->placa = $placa;
    }

    public function getOrigem()
    {
        return $this->origem;
    }

    public function setOrigem($origem) {
        $this->origem = $origem;
    }

    use HasFactory;

    protected $fillable = [
        'descricao', 'cor', 'anoFabricacao', 'anoModelo', 'placa', 'origem', 'idCliente', 'idMarca'
    ];
}
