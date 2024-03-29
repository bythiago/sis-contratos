<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contato extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "contatos";

    protected $fillable = [
        'id_cliente',
        'id_tipo_contato',
        'contato',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id');
    }

    public function tipoContato()
    {
        return $this->belongsTo(TipoContato::class, 'id_tipo_contato', 'id');
    }
}
