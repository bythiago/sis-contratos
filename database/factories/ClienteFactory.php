<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'cpf' => rand(11111111111, 99999999999),
            'rg' => rand(111111111, 999999999),
            'nascimento' => $this->faker->dateTimeThisDecade,
            'id_sexo' => rand(1,2),
            'cep' => $this->faker->postcode,
            'rua' => $this->faker->streetAddress,
            'numero' => $this->faker->buildingNumber,
            'bairro' => $this->faker->streetName,
            'cidade' => $this->faker->city,
            'uf' => $this->faker->state,
            'observacao' => $this->faker->text
        ];
    }
}
