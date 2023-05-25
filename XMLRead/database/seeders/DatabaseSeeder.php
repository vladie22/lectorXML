<?php

namespace Database\Seeders;

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
        \App\Models\User::create([
            'name' => 'Angel Perez',
            'email' => 'mariscosbajacabo01@gmail.com',
            'password' =>  bcrypt('123456789')
        ]);
    }
}
