<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Guardar los roles
        $this->call(RoleSeeder::class);

        // Guardar el usuario administrador
        $this->call(UserAdminSeeder::class);
    }
}
