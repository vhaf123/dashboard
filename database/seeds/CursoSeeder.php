<?php

use Illuminate\Database\Seeder;
use App\Curso;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Curso::create([
            'name' => 'Aritmética',
        ]);

        Curso::create([
            'name' => 'Algebra',
        ]);

        Curso::create([
            'name' => 'Geometría',
        ]);

        Curso::create([
            'name' => 'Trigonometría',
        ]);

        Curso::create([
            'name' => 'Física',
        ]);

        Curso::create([
            'name' => 'Química',
        ]);

        Curso::create([
            'name' => 'Lenguaje',
        ]);

        Curso::create([
            'name' => 'Literatura',
        ]);

        Curso::create([
            'name' => 'Filosofía',
        ]);

        Curso::create([
            'name' => 'Economía',
        ]);

        Curso::create([
            'name' => 'Geografía',
        ]);

        Curso::create([
            'name' => 'Biología',
        ]);

        Curso::create([
            'name' => 'Historia del Perú',
        ]);

        Curso::create([
            'name' => 'Historía Universal',
        ]);
    }
}
