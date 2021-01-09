<?php

namespace Database\Seeders;

use App\Models\Categoria;
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
            CategoriaSeeder::class,
            SexoSeeder::class,
            StatusSeeder::class,
            TipoAnotacaoSeeder::class,
            TipoContatoSeeder::class
        ]);
        
        \App\Models\User::factory(2)->create();
        \App\Models\Cliente::factory(2)->create();
        \App\Models\Produto::factory(10)->create();
    }
}
