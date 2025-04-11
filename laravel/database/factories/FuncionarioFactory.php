<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FuncionarioFactory extends Factory
{
    public function definition()
    {
        return [
            'nome' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'cargo' => $this->faker->randomElement(['Vendedor', 'Gerente', 'Caixa']),
        ];
    }
}

