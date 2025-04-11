<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cliente;
use App\Models\Funcionario;

class VendaFactory extends Factory
{
    public function definition()
    {
        return [
            'cliente_id' => Cliente::factory(),
            'funcionario_id' => Funcionario::factory(),
            'total' => 0, // será atualizado ao criar os itens da venda
            'data_venda' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
