<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SexoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sexos')->insert([
            'tipo' => 'masculino',
            'descricao' => 'Masculino',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('sexos')->insert([
            'tipo' => 'feminino',
            'descricao' => 'Feminino',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}