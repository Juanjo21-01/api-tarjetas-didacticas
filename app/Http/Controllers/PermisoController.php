<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use Illuminate\Http\Request;
use App\Http\Resources\Permiso\PermisoCollection;
use App\Http\Resources\Permiso\PermisoResource;
use App\Http\Requests\Permiso\StorePermisoRequest;
use App\Http\Requests\Permiso\UpdatePermisoRequest;

class PermisoController extends Controller
{
    // CONSTANTES
    const PERMISO_NOT_FOUND = 'Permiso no encontrado';
    const PERMISO_NOT_FOUND_MESSAGE = 'El permiso con el ID proporcionado no existe';

    // MOSTRAR TODOS LOS PERMISOS
    public function index()
    {
        try {
            // Obtenemos todos los permisos
            $permisos = Permiso::all();

            // Retornamos la colección de permisos en formato JSON
            return new PermisoCollection($permisos);
        } catch (\Exception $e) {
            // Retornamos un mensaje de error
            return response()->json([
                'message' => 'Error al obtener los permisos',
                'error'=> $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    // CREAR UN NUEVO PERMISO
    public function store(StorePermisoRequest $request)
    {
        try {
            // Creamos un nuevo permiso
            return new PermisoResource(Permiso::create($request->all()));
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear el permiso',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    // MOSTRAR UN PERMISO ESPECÍFICO
    public function show(string $idPermiso)
    {
        try {
            // Buscamos un permiso por su ID
            $permiso = Permiso::find($idPermiso);

            // Si el permiso no existe retornamos un error
            if (!$permiso) {
                return response()->json([
                    'message' => self::PERMISO_NOT_FOUND,
                    'error' => self::PERMISO_NOT_FOUND_MESSAGE,
                    'status' => 404
                ], 404);
            }

            // Retornamos el permiso en formato JSON
            return new PermisoResource($permiso);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener el permiso',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    // ACTUALIZAR UN PERMISO
    public function update(UpdatePermisoRequest $request, string $idPermiso)
    {
        try {
            // Buscamos un permiso por su ID
            $permiso = Permiso::find($idPermiso);

            // Si el permiso no existe retornamos un error
            if (!$permiso) {
                return response()->json([
                    'message' => self::PERMISO_NOT_FOUND,
                    'error' => self::PERMISO_NOT_FOUND_MESSAGE,
                    'status' => 404
                ], 404);
            }

            // Actualizamos el permiso
            $permiso->update($request->all());

            // Retornamos el permiso actualizado en formato JSON
            return new PermisoResource($permiso);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el permiso',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    // ELIMINAR UN PERMISO
    public function destroy(string $idPermiso)
    {
        try {
            // Buscamos un permiso por su ID
            $permiso = Permiso::find($idPermiso);

            // Si el permiso no existe retornamos un error
            if (!$permiso) {
                return response()->json([
                    'message' => self::PERMISO_NOT_FOUND,
                    'error' => self::PERMISO_NOT_FOUND_MESSAGE,
                    'status' => 404
                ], 404);
            }

            // Eliminamos el permiso
            $permiso->delete();

            // Retornamos un mensaje de éxito
            return response()->json([
                'message' => 'Permiso eliminado con éxito',
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar el permiso',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }
}
