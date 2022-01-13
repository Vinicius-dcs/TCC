<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TesteDrive extends Model
{

    private $id;
    private $data;
    private $horario;
    private $observacao;
    private $idCliente;
    private $idFuncionario;
    private $idVeiculo;
    private $situacao;
    protected $table = "testedrives";

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getHorario() {
        return $this->horario;
    }

    public function setHorario($horario) {
        $this->horario = $horario;
    }

    public function getObservacao() {
        return $this->observacao;
    }

    public function setObservacao($observacao) {
        $this->observacao = $observacao;
    }

    public function getSituacao() {
        return $this->situacao;
    }

    public function setSituacao($situacao) {
        $this->situacao = $situacao;
    }

    public function getIdCliente() {
        return $this->idCliente;
    }

    public function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
    }

    public function getIdFuncionario() {
        return $this->idFuncionario;
    }

    public function setIdFuncionario($idFuncionario) {
        $this->idFuncionario = $idFuncionario;
    }

    public function getIdVeiculo() {
        return $this->idVeiculo;
    }

    public function setIdVeiculo($idVeiculo) {
        $this->idVeiculo = $idVeiculo;
    }

    public function cliente() {
        return $this->hasOne(Cliente::class, 'id');
    }

    public function funcionario() {
        return $this->hasOne(Funcionario::class, 'id');
    }

    public function veiculo() {
        return $this->hasOne(Veiculo::class, 'id');
    }

    use HasFactory;

    protected $fillable = [
        'data, horario, observacao, situacao, idCliente, idVeiculo, idFuncionario'
    ];
}
