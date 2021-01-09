<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
            'descricao' => 'Residencial',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('tipo_contatos')->insert([
            'tipo' => 'celular',
            'descricao' => 'Celular',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('tipo_contatos')->insert([
            'tipo' => 'email',
            'descricao' => 'E-mail',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}