<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "produtos";

    protected $fillable = [
        'id_categoria',
        'nome',
        'descricao',
        'preco',
        'status'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id');
    }

    public function orcamentos(){
        return $this->belongsToMany(Orcamento::class, 'orcamento_has_produtos', 'id_orcamento', 'id_produto')
                    ->withPivot('quantidade', 'total');
    }
}
