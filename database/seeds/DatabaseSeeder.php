<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(NivelSeeder::class);
        $this->call(CursoSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(InstitucionSeeder::class);
        $this->call(PaqueteSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(AsesorSeeder::class);
        $this->call(BoletaSeeder::class);
    }
}
