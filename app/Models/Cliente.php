<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "clientes";

    protected $fillable = [
        'nome',
        'cpf',
        'rg',
        'nascimento',
        'id_sexo',
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

    public function sexo(){
        return $this->belongsTo(Sexo::class, 'id_sexo', 'id');
    }

    public function pedidos(){
        return $this->hasMany(Pedido::class, 'id_cliente');
    }
}
