<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    // Registro de usuarios
    public function register(RegisterRequest $request)
    {
        try {
            // Crear usuario
            $user = User::create([
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'dpi' => $request->dpi,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_id' => $request->role_id,
            ]);

            // Crear token de acceso
            $token = $user->createToken('auth_token')->plainTextToken;

            // Respuesta JSON
            return response()->json([
                'data' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al registrar el usuario',
                'error' => $e->getMessage(),
                'status' => '500'
            ], 500);
        }
    }

    // Inicio de sesión
    public function login(LoginRequest $request)
    {
        // Intento de inicio de sesión
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Credenciales incorrectas',
                'status' => '401'
            ], 401);
        }

        // Obtener usuario
        $user = User::where('email', $request->email)->firstOrFail();

        
        // ocultar atributos
        $user->makeHidden(['apellidos', 'dpi', 'email_verified_at', 'created_at', 'updated_at', 'role_id']);
        
        $role = $user->role;
        $role->makeHidden(['created_at', 'updated_at', 'role_permisos']);

        // Obtener los permisos asociados al rol, pluck para extraer solo el nombre
        $role_permisos = $role->role_permisos->map(function($role_permiso) {
            return [
                'estado' => $role_permiso->estado,
                'permiso' => $role_permiso->permiso->nombre
             ];
        });

        // Agregar los permisos al rol
        $role->permisos = $role_permisos;

        // Crear token de acceso
        $token = $user->createToken('auth_token')->plainTextToken;

        // Respuesta JSON
        return response()->json([
            'message' => 'Inicio de sesión exitoso, Bienvenido '.$user->nombres,
            'usuario' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }

    // Cerrar sesión
    public function logout()
    {
        // Quitar token de acceso
        auth()->user()->tokens()->delete();

        // Respuesta JSON
        return response()->json([
            'message' => 'Sesión cerrada correctamente',
            'status' => '200'
        ], 200);
    }
}
