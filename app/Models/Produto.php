<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use HasFactory;//, SoftDeletes;

    protected $table = "produtos";

    protected $fillable = [
        'id_categoria',
        'nome',
        'descricao',
        'preco',
        'status',
        'imagem'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id');
    }

    public function orcamentos(){
        return $this->belongsToMany(Orcamento::class, 'orcamento_has_produtos', 'id_produto', 'id_orcamento')
                    ->withPivot('quantidade', 'total');
    }
}
