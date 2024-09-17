<?php

namespace App\Http\Controllers;

use App\Models\RolePermisos;
use Illuminate\Http\Request;
use App\Http\Resources\Role\RolePermisoCollection;
use App\Http\Resources\Role\RolePermisoResource;
use App\Http\Requests\Role\StoreRolePermisoRequest;
use App\Http\Requests\Role\UpdateRolePermisoRequest;

class RolePermisosController extends Controller
{
    // CONSTANTES
    const ROLE_PERMISOS_NOT_FOUND = 'Rol del Permiso no encontrado';
    const ROLE_PERMISOS_NOT_FOUND_MESSAGE = 'El rol del permiso con el ID proporcionado no existe';

    // MOSTRAR TODOS LOS ROLES
    public function index()
    {
        try {
            // Obtenemos todos los roles
            $rolePermisos = RolePermisos::all();

            // Retornamos la colección de roles en formato JSON
            return new RolePermisoCollection($rolePermisos);
        } catch (\Exception $e) {
            // Retornamos un mensaje de error
            return response()->json([
                'message' => 'Error al obtener los roles con permisos',
                'error'=> $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    // CREAR UN NUEVO ROL
    public function store(StoreRolePermisoRequest $request)
    {
        try {

            // Verificamos si el rol con permisos ya existe
            $rolePermisos = RolePermisos::where('role_id', $request->role_id)->where('permiso_id', $request->permiso_id)->first();

            // Si el rol con permisos ya existe retornamos un error
            if ($rolePermisos) {
                return response()->json([
                    'message' => 'Rol con permisos ya existe',
                    'error' => 'El rol con permisos ya existe',
                    'status' => 400
                ], 400);
            }

            // Creamos un nuevo rol
            return new RolePermisoResource(RolePermisos::create($request->all()));
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear el rol con permisos',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    // MOSTRAR UN ROL ESPECÍFICO
    public function show(string $idRolePermisos)
    {
        try {
            // Buscamos un rol por su ID
            $rolePermisos = RolePermisos::find($idRolePermisos);

            // Si el rol no existe retornamos un error
            if (!$rolePermisos) {
                return response()->json([
                    'message' => self::ROLE_PERMISOS_NOT_FOUND,
                    'error' => self::ROLE_PERMISOS_NOT_FOUND_MESSAGE,
                    'status' => 404
                ], 404);
            }

            // Retornamos el rol en formato JSON
            return new RolePermisoResource($rolePermisos);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener el rol con permisos',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    // ACTUALIZAR UN ROL
    public function update(UpdateRolePermisoRequest $request, string $idRolePermisos)
    {
        try {
            // Buscamos un rol por su ID
            $rolePermisos = RolePermisos::find($idRolePermisos);

            // Si el rol no existe retornamos un error
            if (!$rolePermisos) {
                return response()->json([
                    'message' => self::ROLE_PERMISOS_NOT_FOUND,
                    'error' => self::ROLE_PERMISOS_NOT_FOUND_MESSAGE,
                    'status' => 404
                ], 404);
            }

            // Actualizamos el rol solo en el atributo estado
            $rolePermisos->update($request->only('estado'));

            // Retornamos el rol en formato JSON
            return new RolePermisoResource($rolePermisos);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el rol con permisos',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    // ELIMINAR UN ROL
    public function destroy(string $idRolePermisos)
    {
        try {
            // Buscamos un rol por su ID
            $rolePermisos = RolePermisos::find($idRolePermisos);

            // Si el rol no existe retornamos un error
            if (!$rolePermisos) {
                return response()->json([
                    'message' => self::ROLE_PERMISOS_NOT_FOUND,
                    'error' => self::ROLE_PERMISOS_NOT_FOUND_MESSAGE,
                    'status' => 404
                ], 404);
            }

            // Eliminamos el rol
            $rolePermisos->delete();

            // Retornamos un mensaje de éxito
            return response()->json([
                'message' => 'Rol con Permisos eliminado con éxito',
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar el rol con permisos',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }
}
