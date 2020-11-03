<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = "clientes";

    protected $fillable = [
        'nome',
        'cpf',
        'nascimento',
        'sexo',
        'cep',
        'rua',
        'numero',
        'bairro',
        'cidade',
        'uf',
        'observacao',
    ];

    public function contatos()
    {
        return $this->hasMany(Contato::class, 'id_cliente', 'id');
    }
    
}
