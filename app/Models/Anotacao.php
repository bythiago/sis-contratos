<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anotacao extends Model
{
    use HasFactory;

    protected $table = 'anotacoes';

    protected $fillable = [
        'id_pedido',
        'id_tipo',
        'descricao'
    ];
}
