<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
            'tipo' => 'orcamento_solicitado',
            'descricao' => 'orcamento solicitado',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('status')->insert([
            'tipo' => 'orcamento_parcial',
            'descricao' => 'orcamento parcial',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('status')->insert([
            'tipo' => 'orcamento_realizado',
            'descricao' => 'orcamento realizado',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}