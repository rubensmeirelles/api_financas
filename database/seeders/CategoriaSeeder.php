<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
    $categorias = [
            ['nome_categoria' => 'Compras'],
            ['nome_categoria' => 'Uber'],
            ['nome_categoria' => 'Farmácia'],
            ['nome_categoria' => 'Supermercado'],
            ['nome_categoria' => 'Farmácia'],
            ['nome_categoria' => 'Salário'],
            ['nome_categoria' => 'Férias'],
            ['nome_categoria' => '13º Salário'],
            ['nome_categoria' => 'Happyhour'],
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}
