<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Boleta;
use Faker\Generator as Faker;

use Carbon\Carbon;

$factory->define(Boleta::class, function (Faker $faker) {
    return [
        'cliente_id' => rand(1,30),
        'categoria_id' => rand(4,6),
        'numero_alumnos' => 1,
        'alumno' => $faker->name,
        'institucion_id' => rand(1,5),
        'paquete_id' => rand(1,4),
        'horas' => 6,
        'sesiones' => 3,
        'anticipo' => 100,
        'inicio' => Carbon::create(2020, 05, 01, 0, 0, 0, 'GMT'),
        'culminacion' => Carbon::create(2020, 05, 16, 0, 0, 0, 'GMT'),
        'admin_id' => rand(1,5),
        /* 
        'created_at'=>  $faker->dateTime, */
    ];
});
