<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
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
            'descricao' => 'Bolos',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('categorias')->insert([
            'tipo' => 'doces_finos',
            'descricao' => 'Doces Finos',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}