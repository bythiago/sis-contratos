<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orcamento extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "orcamentos";

    protected $fillable = [
        'id_pedido',
        'assessora',
        'cerimonia',
        'valido_contrato',
        'quantidade_convidados',
    ];

    public function produtos(){
        return $this->belongsToMany(Produto::class, 'orcamento_has_produtos', 'id_orcamento', 'id_produto')
                    ->withPivot('quantidade', 'total');
    }
}
