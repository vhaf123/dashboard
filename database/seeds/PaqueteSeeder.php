<?php

use Illuminate\Database\Seeder;
use App\Paquete;

class PaqueteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Paquete::create([
            'name' => 'Diario'
        ]);

        Paquete::create([
            'name' => 'Semanal'
        ]);

        Paquete::create([
            'name' => 'Mensual'
        ]);

        Paquete::create([
            'name' => 'Paralelo a la pre'
        ]);
    }
}
