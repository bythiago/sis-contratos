<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            'tipo' => 'bolos',
            'descricao' => 'Bolos'
        ]);

        DB::table('categorias')->insert([
            'tipo' => 'doces_finos',
            'descricao' => 'Doces Finos'
        ]);
    }
}
