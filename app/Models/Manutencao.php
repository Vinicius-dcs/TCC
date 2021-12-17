<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manutencao extends Model
{
    private $id;
    private $data;
    private $horario;
    private $descricao;
    private $valor;
    private $idVeiculo;
    private $idFuncionario;
    private $tipoManutencao;
    private $situacao;
    protected $table = "manutencoes";

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getHorario()
    {
        return $this->horario;
    }

    public function setHorario($horario)
    {
        $this->horario = $horario;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    public function getIdVeiculo()
    {
        return $this->idVeiculo;
    }

    public function setIdVeiculo($idVeiculo)
    {
        $this->idVeiculo = $idVeiculo;
    }

    public function getIdFuncionario()
    {
        return $this->idFuncionario;
    }

    public function setIdFuncionario($idFuncionario)
    {
        $this->idFuncionario = $idFuncionario;
    }

    public function veiculo()
    {
        return $this->hasOne(Veiculo::class, 'id');
    }

    public function funcionario()
    {
        return $this->hasOne(Funcionario::class, 'id');
    }

    public function getTipoManutencao() {
        return $this->tipoManutencao;
    }

    public function setTipoManutencao($tipoManutencao) {
        $this->tipoManutencao = $tipoManutencao;
    }

    public function getSituacao() {
        return $this->situacao;
    }

    public function setSituacao($situacao) {
        $this->situacao = $situacao;
    }

    use HasFactory;

    protected $fillable = [
        'data', 'horário', 'descricao', 'valor', 'idVeiculo', 'idFuncionario'
    ];
}
