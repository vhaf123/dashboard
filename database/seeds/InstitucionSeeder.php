<?php

use Illuminate\Database\Seeder;
use App\Institucion;

class InstitucionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Institucion::create([
            'name' => 'Pre San Marcos',
        ]);

        Institucion::create([
            'name' => 'Pre UNI',
        ]);

        Institucion::create([
            'name' => 'Pre Villareal',
        ]);

        Institucion::create([
            'name' => 'Pre Católica',
        ]);

        Institucion::create([
            'name' => 'Pre Cayetano',
        ]);

        Institucion::create([
            'name' => 'UNMSM',
        ]);

        Institucion::create([
            'name' => 'UNI',
        ]);

        Institucion::create([
            'name' => 'Villareal',
        ]);

        Institucion::create([
            'name' => 'Católica',
        ]);

        Institucion::create([
            'name' => 'Cayetano',
        ]);
    }
}
