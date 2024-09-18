<?php

namespace App\Http\Controllers;

use App\Models\Mazo;
use Illuminate\Http\Request;
use App\Http\Resources\Mazo\MazoCollection;
use App\Http\Resources\Mazo\MazoResource;
use App\Http\Requests\Mazo\StoreMazoRequest;
use App\Http\Requests\Mazo\UpdateMazoRequest;

class MazoController extends Controller
{
    // CONSTANTES
    const MAZO_NOT_FOUND = 'Mazo no encontrado';
    const MAZO_NOT_FOUND_MESSAGE = 'El mazo con el ID proporcionado no existe';

    // MOSTRAR TODOS LOS MAZOS
    public function index()
    {
        try {
            // Obtenemos todos los mazos
            $mazos = Mazo::all();

            // Retornamos la colección de mazos en formato JSON
            return new MazoCollection($mazos);
        } catch (\Exception $e) {
            // Retornamos un mensaje de error
            return response()->json([
                'message' => 'Error al obtener los mazos',
                'error'=> $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    // CREAR UN NUEVO MAZO
    public function store(StoreMazoRequest $request)
    {
        try {
            // Asignamos el ID del usuario autenticado al mazo
            $request->merge(['user_id' => auth()->user()->id]);

            // Creamos un nuevo mazo
            return new MazoResource(Mazo::create($request->all()));
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear el mazo',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    // MOSTRAR UN MAZO ESPECÍFICO
    public function show(string $idMazo)
    {
        try {
            // Buscamos un mazo por su ID
            $mazo = Mazo::find($idMazo);

            // Si el mazo no existe retornamos un error
            if (!$mazo) {
                return response()->json([
                    'message' => self::MAZO_NOT_FOUND,
                    'error' => self::MAZO_NOT_FOUND_MESSAGE,
                    'status' => 404
                ], 404);
            }

            // Retornamos el mazo en formato JSON
            return new MazoResource($mazo);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener el mazo',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    // ACTUALIZAR UN MAZO
    public function update(UpdateMazoRequest $request, string $idMazo)
    {
        try {
            // Buscamos un mazo por su ID
            $mazo = Mazo::find($idMazo);

            // Si el mazo no existe retornamos un error
            if (!$mazo) {
                return response()->json([
                    'message' => self::MAZO_NOT_FOUND,
                    'error' => self::MAZO_NOT_FOUND_MESSAGE,
                    'status' => 404
                ], 404);
            }

            // Verificamos que el usuario autenticado sea el propietario del mazo
            if ($mazo->user_id !== auth()->user()->id) {
                return response()->json([
                    'message' => 'No tienes permisos para actualizar este mazo',
                    'status' => 403
                ], 403);
            }

            // Asignamos el ID del usuario autenticado al mazo
            $request->merge(['user_id' => auth()->user()->id]);

            // Actualizamos el mazo
            $mazo->update($request->all());

            // Retornamos el mazo actualizado en formato JSON
            return new MazoResource($mazo);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el mazo',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    // ELIMINAR UN MAZO
    public function destroy(string $idMazo)
    {
        try {
            // Buscamos un mazo por su ID
            $mazo = Mazo::find($idMazo);

            // Si el mazo no existe retornamos un error
            if (!$mazo) {
                return response()->json([
                    'message' => self::MAZO_NOT_FOUND,
                    'error' => self::MAZO_NOT_FOUND_MESSAGE,
                    'status' => 404
                ], 404);
            }

            // Verificamos que el usuario autenticado sea el propietario del mazo
            if ($mazo->user_id !== auth()->user()->id) {
                return response()->json([
                    'message' => 'No tienes permisos para eliminar este mazo',
                    'status' => 403
                ], 403);
            }

            // Eliminamos el mazo
            $mazo->delete();

            // Retornamos un mensaje de éxito
            return response()->json([
                'message' => 'Mazo eliminado correctamente',
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar el mazo',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }
}
