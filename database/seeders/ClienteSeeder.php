<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 20; $i++) { 
            DB::table('clientes')->insert(
                [
                    'nome' => Str::random(10),
                    'cpf' => rand(11111111111, 99999999999),
                    'nascimento' => '06/10/1989',
                    'id_sexo' => rand(1,2),
                    'cep' => '27338-400',
                    'rua' => Str::random(10),
                    'numero' => rand(1, 999),
                    'bairro' => Str::random(10),
                    'cidade' => Str::random(10),
                    'uf' => 'RJ',
                    'observacao' => 'observacao' . Str::random(10),
                ]
            );
        }
    }
}
