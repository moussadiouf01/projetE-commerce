<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer l'utilisateur de test seulement s'il n'existe pas déjà
        User::firstOrCreate([
            'email' => 'test@example.com',
        ], [
            'name' => 'Test User',
            'password' => bcrypt('password'),
        ]);

        \App\Models\Admin::updateOrCreate([
            'email' => 'dioufmoussa812@gmail.com',
        ], [
            'name' => 'Moussa Diouf',
            'password' => bcrypt('Papemoussa01'),
        ]);

        $this->call([
            OrderSeeder::class,
        ]);
    }
}
