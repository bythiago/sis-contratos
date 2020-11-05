<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "pedidos";

    protected $fillable = [
        'id_contrato',
        'id_orcamento',
        'id_cliente',
        'id_anotacao',
        'id_status'
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id');
    }

    public function status(){
        return $this->belongsTo(StatusControle::class, 'id_status', 'id');
    }

    // public function anotacoes(){
    //     return $this->hasMany(AnotacaoControle::class, 'id_anotacao', 'id');
    // }
}