<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SexoSeeder::class,
            CategoriaProdutoSeeder::class,
            TipoContatoSeeder::class,
            StatusSeeder::class,
        ]);
    }
}
