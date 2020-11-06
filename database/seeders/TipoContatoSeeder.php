<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_contatos')->insert([
            'tipo' => 'residencial',
            'descricao' => 'Residencial'
        ]);

        DB::table('tipo_contatos')->insert([
            'tipo' => 'celular',
            'descricao' => 'Celular'
        ]);
    }
}
