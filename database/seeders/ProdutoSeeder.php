<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 20; $i++) { 
            DB::table('produtos')->insert(
                [
                    'id_categoria' => rand(1, 2),
                    'nome' => 'Doce'.Str::random(10),
                    'descricao' => Str::random(10),
                    'preco' => rand(1, 99),
                    'status' => 1
                ]
            );
        }
    }
}
