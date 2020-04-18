<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cliente;
use Faker\Generator as Faker;

$factory->define(Cliente::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'telefono' => $faker->numberBetween($min = 900000000, $max = 999999999),
        'dni' => $faker->numberBetween($min = 10000000, $max = 89999999),
        'direccion' => $faker->address,
        'distrito' => $faker->state,
        'referencia' => $faker->sentence(6),
    ];
});
