<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    
    use HasFactory, SoftDeletes;

    const ORCAMENTO_SOLICITADO = 'orcamento_solicitado';
    const ORCAMENTO_PARCIAL = 'orcamento_parcial';
    const ORCAMENTO_REALIZADO = 'orcamento_realizado';



    protected $table = "pedidos";

    protected $fillable = [
        'id_cliente',
        'id_status'
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function status(){
        return $this->belongsTo(Status::class, 'id_status');
    }

    public function anotacao(){
        return $this->hasOne(Anotacao::class, 'id_pedido');
    }
    
    public function orcamento(){
        return $this->hasOne(Orcamento::class, 'id_pedido');
    }
}
