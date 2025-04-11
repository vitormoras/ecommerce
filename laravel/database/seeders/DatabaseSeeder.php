<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ClienteSeeder::class,
            FuncionarioSeeder::class,
            ProdutoSeeder::class,
            VendaSeeder::class,
        ]);
    }
}
