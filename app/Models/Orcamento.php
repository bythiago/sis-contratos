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
        'status'
        // 'id_pedido',
        // 'assessora',
        // 'cerimonia',
        // 'valido_contrato',
        // 'quantidade_convidados',
    ];

    public function produtos(){
        return $this->belongsToMany(Produto::class, 'orcamento_has_produtos', 'id_orcamento', 'id_produto')
                    ->withPivot('id', 'quantidade', 'total', 'created_at', 'updated_at');
    }

    public function pedido(){
        return $this->belongsTo(Pedido::class, 'id_pedido');
    }
}
