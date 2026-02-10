<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Création d'un utilisateur test
       User::firstOrCreate(
       ['email' => 'test@example.com'], // vérifie si email existe déjà
       [
        'name' => 'Test User',
        'password' => bcrypt('password123'), // mot de passe par défaut
       ]
    );


        // 🔹 Appel du seeder des rôles
        $this->call([
            RoleSeeder::class,
        ]);

        $this->call([
            CurrencySeeder::class,
         ]);
         $this->call([
             RoleSeeder::class,      // Assure-toi que les rôles sont créés avant les users
             UserSeeder::class,
             CurrencySeeder::class,
        ]);


    }
}
