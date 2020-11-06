<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoAnotacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_anotacoes')->insert([
            'tipo' => 'pedido',
            'descricao' => 'Pedido'
        ]);

        DB::table('tipo_anotacoes')->insert([
            'tipo' => 'orcamento',
            'descricao' => 'Orçamento'
        ]);

        DB::table('tipo_anotacoes')->insert([
            'tipo' => 'contrato',
            'descricao' => 'Contrato'
        ]);
    }
}
