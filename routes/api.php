<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\RolePermisosController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TipoMazoController;
use App\Http\Controllers\MazoController;

const AUTH_SANCTUM = 'auth:sanctum';
const USER_ID = 'usuarios/{id}';

// RUTAS DE AUTENTICACIÓN
Route::prefix('auth')->group(function(){
    Route::post('register', [AuthController::class, 'register'])->middleware(AUTH_SANCTUM);
    Route::post('login', [AuthController::class, 'login']);
    Route::get('logout', [AuthController::class, 'logout'])->middleware(AUTH_SANCTUM);
});

// RUTAS PROTEGIDAS
Route::middleware(AUTH_SANCTUM)->group(function(){
    // Rutas de roles
    Route::apiResource('roles', RoleController::class);
    // Rutas de permisos
    Route::apiResource('permisos', PermisoController::class);
    // Rutas de roles con permisos
    Route::apiResource('roles-permisos', RolePermisosController::class);
    // Rutas de usuarios
    Route::get('usuarios', [UserController::class, 'index']);
    Route::get(USER_ID, [UserController::class, 'show']);
    Route::put(USER_ID, [UserController::class, 'update']);
    Route::patch(USER_ID, [UserController::class, 'update']);
    Route::delete(USER_ID, [UserController::class, 'destroy']);
    // Rutas de tipos de mazos
    Route::apiResource('tipos-mazos', TipoMazoController::class);
    // Rutas de mazos
    Route::apiResource('mazos', MazoController::class);
});
