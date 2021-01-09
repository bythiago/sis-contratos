<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Produto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_categoria' => rand(1, 2),
            'nome' => 'Doce'.$this->faker->bs,
            'descricao' => $this->faker->text(80),
            'preco' => rand(1, 99),
            'status' => 1
        ];
    }
}
