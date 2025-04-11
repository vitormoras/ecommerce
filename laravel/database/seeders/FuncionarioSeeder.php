<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Funcionario;

class FuncionarioSeeder extends Seeder
{
    public function run()
    {
        Funcionario::factory()->count(5)->create();
    }
}
