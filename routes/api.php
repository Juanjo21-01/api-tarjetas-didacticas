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
use App\Http\Controllers\TarjetaController;

// RUTAS DE AUTENTICACIÓN
Route::prefix('auth')->group(function(){
    Route::post('register', [AuthController::class, 'register'])->middleware('auth:sanctum');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

// RUTAS PROTEGIDAS
Route::middleware('auth:sanctum')->group(function(){
    // Rutas de roles
    Route::apiResource('roles', RoleController::class);
    // Rutas de permisos
    Route::apiResource('permisos', PermisoController::class);
    // Rutas de roles con permisos
    Route::apiResource('roles-permisos', RolePermisosController::class);
    // Rutas de usuarios
    Route::get('usuarios', [UserController::class, 'index']);
    Route::get('usuarios/{id}', [UserController::class, 'show']);
    Route::put('usuarios/{id}', [UserController::class, 'update']);
    Route::patch('usuarios/{id}', [UserController::class, 'update']);
    Route::delete('usuarios/{id}', [UserController::class, 'destroy']);
    // Rutas de tipos de mazos
    Route::apiResource('tipos-mazos', TipoMazoController::class);
    // Rutas de mazos
    Route::apiResource('mazos', MazoController::class);
    // Rutas de tarjetas
    Route::apiResource('tarjetas', TarjetaController::class);
});

// RUTAS PÚBLICAS
Route::get('tipos-mazos', [TipoMazoController::class, 'index']);
Route::get('tipos-mazos/{tipos_mazo}', [TipoMazoController::class, 'show']);
Route::get('mazos', [MazoController::class, 'index']);
Route::get('mazos/{mazo}', [MazoController::class, 'show']);
Route::get('tarjetas', [TarjetaController::class, 'index']);
Route::get('tarjetas/{tarjeta}', [TarjetaController::class, 'show']);
