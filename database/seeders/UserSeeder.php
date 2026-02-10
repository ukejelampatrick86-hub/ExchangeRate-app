<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 🔹 Création de l'admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrator',
                'password' => bcrypt('admin123'), // Change ce mot de passe après
            ]
        );
        $admin->assignRole('admin');

        // 🔹 Création du caissier
        $cashier = User::firstOrCreate(
            ['email' => 'cashier@example.com'],
            [
                'name' => 'Cashier',
                'password' => bcrypt('cashier123'), // Change ce mot de passe après
            ]
        );
        $cashier->assignRole('cashier');

        $this->command->info('Default users created successfully!');
    }
}
