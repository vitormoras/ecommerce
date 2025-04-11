<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{
    public function definition()
    {
        return [
            'nome' => $this->faker->word(),
            'descricao' => $this->faker->sentence(),
            'preco' => $this->faker->randomFloat(2, 10, 500),
            'quantidade_estoque' => $this->faker->numberBetween(5, 100),
        ];
    }
}

