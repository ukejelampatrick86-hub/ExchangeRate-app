<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // 🔹 Supprimer les rôles existants pour éviter les doublons
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 🔹 Créer les rôles
        $roles = ['admin', 'cashier', 'viewer'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // 🔹 Créer un utilisateur admin par défaut
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrator',
                'password' => bcrypt('password123'), // Change le mot de passe ensuite
            ]
        );

        // 🔹 Assigner le rôle admin
        $admin->assignRole('admin');

        $this->command->info('Roles and default admin created successfully!');
    }
}
