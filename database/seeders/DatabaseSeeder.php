<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\User::factory(5)->create(); // garantit qu'il existe des utilisateurs avant le seed des randonnées

        $this->call([
            RandonneeSeeder::class,
        ]);
    }
}
