<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Venda;
use App\Models\ItemVenda;

class VendaSeeder extends Seeder
{
    public function run()
    {
        Venda::factory()
            ->count(15)
            ->create()
            ->each(function ($venda) {
                $itens = ItemVenda::factory()->count(rand(1, 5))->create([
                    'venda_id' => $venda->id
                ]);

                // Atualizar total da venda
                $total = $itens->sum(fn($item) => $item->quantidade * $item->preco_unitario);
                $venda->update(['total' => $total]);
            });
    }
}


