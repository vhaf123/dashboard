<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'Victor Arana',
            'email' => 'victor.aranaf92@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        factory(Admin::class, 4)->create();
    }
}
