<?php

use Illuminate\Database\Seeder;

class DiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dias')->insert(
            [
                'val' => 'lun', 
                'name' => "lunes"
            ]
        );

        DB::table('dias')->insert(
            [
                'val' => 'mar', 
                'name' => "martes"
            ]
        );

        DB::table('dias')->insert(
            [
                'val' => 'mier', 
                'name' => "miercoles"
            ]
        );

        DB::table('dias')->insert(
            [
                'val' => 'jue', 
                'name' => 'jueves'
            ]
        );

        DB::table('dias')->insert(
            [
                'val' => 'vier', 
                'name' => 'viernes'
            ]
        );

        DB::table('dias')->insert(
            [
                'val' => 'sab', 
                'name' => 'sabado'
            ]
        );

        DB::table('dias')->insert(
            [
                'val' => 'dom', 
                'name' => 'domingo'
            ]
        );
    }
}
