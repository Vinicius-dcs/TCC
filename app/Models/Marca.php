<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{

    private $id;
    private $nome;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function veiculo() {
        return $this->hasOne(Veiculo::class, 'id');
    }

    use HasFactory;

    protected $fillable = [
        'nome'
    ];
}
