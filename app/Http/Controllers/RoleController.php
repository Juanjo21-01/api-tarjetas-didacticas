<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Resources\Role\RoleCollection;
use App\Http\Resources\Role\RoleResource;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;

class RoleController extends Controller
{
    // CONSTANTES
    const ROLE_NOT_FOUND = 'Rol no encontrado';
    const ROLE_NOT_FOUND_MESSAGE = 'El rol con el ID proporcionado no existe';

    // MOSTRAR TODOS LOS ROLES
    public function index()
    {
        try {
            // Obtenemos todos los roles
            $roles = Role::all();

            // Retornamos la colección de roles en formato JSON
            return new RoleCollection($roles);
        } catch (\Exception $e) {
            // Retornamos un mensaje de error
            return response()->json([
                'message' => 'Error al obtener los roles',
                'error'=> $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    // CREAR UN NUEVO ROL
    public function store(StoreRoleRequest $request)
    {
        try {
            // Creamos un nuevo rol
            return new RoleResource(Role::create($request->all()));
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear el rol',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    // MOSTRAR UN ROL ESPECÍFICO
    public function show(string $idRole)
    {
        try {
            // Buscamos un rol por su ID
            $role = Role::find($idRole);

            // Si el rol no existe retornamos un error
            if (!$role) {
                return response()->json([
                    'message' => self::ROLE_NOT_FOUND,
                    'error' => self::ROLE_NOT_FOUND_MESSAGE,
                    'status' => 404
                ], 404);
            }

            // Retornamos el rol en formato JSON
            return new RoleResource($role);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener el rol',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    // ACTUALIZAR UN ROL
    public function update(UpdateRoleRequest $request, string $idRole)
    {
        try {
            // Buscamos un rol por su ID
            $role = Role::find($idRole);

            // Si el rol no existe retornamos un error
            if (!$role) {
                return response()->json([
                    'message' => self::ROLE_NOT_FOUND,
                    'error' => self::ROLE_NOT_FOUND_MESSAGE,
                    'status' => 404
                ], 404);
            }

            // Actualizamos el rol
            $role->update($request->all());

            // Retornamos el rol actualizado en formato JSON
            return new RoleResource($role);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el rol',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    // ELIMINAR UN ROL
    public function destroy(string $idRole)
    {
        try {
            // Buscamos un rol por su ID
            $role = Role::find($idRole);

            // Si el rol no existe retornamos un error
            if (!$role) {
                return response()->json([
                    'message' => self::ROLE_NOT_FOUND,
                    'error' => self::ROLE_NOT_FOUND_MESSAGE,
                    'status' => 404
                ], 404);
            }

            // Eliminamos el rol
            $role->delete();

            // Retornamos un mensaje de éxito
            return response()->json([
                'message' => 'Rol eliminado con éxito',
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar el rol',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }
}
