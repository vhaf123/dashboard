<?php

use Illuminate\Database\Seeder;
use App\Cliente;
use App\Timeline;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Cliente::class, 30)->create()->each(function(Cliente $cliente){

            Timeline::create([
                'cliente_id' => $cliente->id,
                'admin_id' => 1,
                'accion' => 'create_cliente',
            ]);
            
        });
    }
}
