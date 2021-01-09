<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
            'descricao' => 'Pedido',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('tipo_anotacoes')->insert([
            'tipo' => 'orcamento',
            'descricao' => 'Orçamento',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('tipo_anotacoes')->insert([
            'tipo' => 'contrato',
            'descricao' => 'Contrato',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}