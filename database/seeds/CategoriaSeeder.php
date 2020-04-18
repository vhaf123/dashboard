<?php

use Illuminate\Database\Seeder;
use App\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create([
            'name' => 'Escolar 1',
            'precio_cli' => 20,
            'precio_ase' => 10,
        ]);

        Categoria::create([
            'name' => 'Escolar 2',
            'precio_cli' => 24,
            'precio_ase' => 12,
        ]);

        Categoria::create([
            'name' => 'Escolar 3',
            'precio_cli' => 30,
            'precio_ase' => 15,
        ]);

        Categoria::create([
            'name' => 'Pre 1',
            'precio_cli' => 24,
            'precio_ase' => 12,
        ]);

        Categoria::create([
            'name' => 'Pre 2',
            'precio_cli' => 30,
            'precio_ase' => 15,
        ]);

        Categoria::create([
            'name' => 'Pre 3',
            'precio_cli' => 36,
            'precio_ase' => 18,
        ]);

        Categoria::create([
            'name' => 'Universitario 1',
            'precio_cli' => 30,
            'precio_ase' => 15,
        ]);

        Categoria::create([
            'name' => 'Universitario 2',
            'precio_cli' => 36,
            'precio_ase' => 18,
        ]);
    }
}
