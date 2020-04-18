<?php

use Illuminate\Database\Seeder;
use App\Nivel;

class NivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Nivel::create([
            'name' => 'Básico'
        ]);

        Nivel::create([
            'name' => 'Intermedio'
        ]);

        Nivel::create([
            'name' => 'Avanzado'
        ]);
    }
}
