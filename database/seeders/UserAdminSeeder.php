<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asignar el rol de administrador al usuario principal
        $rolAdmin = Role::where('nombre', 'administrador')->first();

        // Crear usuario administrador
        $user = User::create([
            'nombres' => env('ADMIN_NOMBRES'),
            'apellidos' => env('ADMIN_APELLIDOS'),
            'dpi' => env('ADMIN_DPI'),
            'email' => env('ADMIN_EMAIL'),
            'password' => bcrypt(env('ADMIN_PASSWORD')),
            'role_id' => $rolAdmin->id,
        ]);

        // Asignar token de acceso al usuario administrador
        $user->createToken('auth_token')->plainTextToken;
    }
}
