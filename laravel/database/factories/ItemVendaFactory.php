<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Venda;
use App\Models\Produto;

class ItemVendaFactory extends Factory
{
    public function definition()
    {
        $produto = Produto::inRandomOrder()->first() ?? Produto::factory()->create();
        $quantidade = $this->faker->numberBetween(1, 5);

        return [
            'venda_id' => Venda::factory(),
            'produto_id' => $produto->id,
            'quantidade' => $quantidade,
            'preco_unitario' => $produto->preco,
        ];
    }
}

