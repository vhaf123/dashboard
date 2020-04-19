<?php

use Illuminate\Database\Seeder;
use App\Boleta;
use App\Timeline;

class BoletaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Boleta::class, 20)->create()->each(function(Boleta $boleta){
            $boleta->fill([
                'costo' => BoletaSeeder::costo($boleta->categoria->precio_cli, $boleta->horas),
                'saldo' => BoletaSeeder::saldo($boleta->categoria->precio_cli, $boleta->horas, $boleta->anticipo)
            ])->save();

            Timeline::create([
                'cliente_id' => $boleta->cliente_id,
                'admin_id' => 1,
                'accion' => 'create_boleta',
                'boleta' => $boleta->id,
            ]);
        });
    }

    public function costo($precio, $horas){
        return $precio * $horas;
    }

    public function saldo($precio, $horas, $anticipo){
        return $precio * $horas - $anticipo;
    }
}
