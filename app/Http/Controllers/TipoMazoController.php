<?php

namespace App\Http\Controllers;

use App\Models\TipoMazo;
use Illuminate\Http\Request;
use App\Http\Resources\Mazo\TipoMazoCollection;
use App\Http\Resources\Mazo\TipoMazoResource;
use App\Http\Requests\Mazo\StoreTipoMazoRequest;
use App\Http\Requests\Mazo\UpdateTipoMazoRequest;

class TipoMazoController extends Controller
{
    // CONSTANTES
    const TIPO_MAZO_NOT_FOUND = 'Tipo de mazo no encontrado';
    const TIPO_MAZO_NOT_FOUND_MESSAGE = 'El tipo de mazo con el ID proporcionado no existe';

    // MOSTRAR TODOS LOS TIPOS DE MAZO
    public function index()
    {
        try {
            // Obtenemos todos los tipos de mazo
            $tiposMazo = TipoMazo::all();

            // Retornamos la colección de tipos de mazo en formato JSON
            return new TipoMazoCollection($tiposMazo);
        } catch (\Exception $e) {
            // Retornamos un mensaje de error
            return response()->json([
                'message' => 'Error al obtener los tipos de mazo',
                'error'=> $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    // CREAR UN NUEVO TIPO DE MAZO
    public function store(StoreTipoMazoRequest $request)
    {
        try {
            // Creamos un nuevo tipo de mazo
            return new TipoMazoResource(TipoMazo::create($request->all()));
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear el tipo de mazo',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    // MOSTRAR UN TIPO DE MAZO ESPECÍFICO
    public function show(string $idTipoMazo)
    {
        try {
            // Buscamos un tipo de mazo por su ID
            $tipoMazo = TipoMazo::find($idTipoMazo);

            // Si el tipo de mazo no existe retornamos un error
            if (!$tipoMazo) {
                return response()->json([
                    'message' => self::TIPO_MAZO_NOT_FOUND,
                    'error' => self::TIPO_MAZO_NOT_FOUND_MESSAGE,
                    'status' => 404
                ], 404);
            }

            // Retornamos el tipo de mazo en formato JSON
            return new TipoMazoResource($tipoMazo);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener el tipo de mazo',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    // ACTUALIZAR UN TIPO DE MAZO
    public function update(UpdateTipoMazoRequest $request, string $idTipoMazo)
    {
        try {
            // Buscamos un tipo de mazo por su ID
            $tipoMazo = TipoMazo::find($idTipoMazo);

            // Si el tipo de mazo no existe retornamos un error
            if (!$tipoMazo) {
                return response()->json([
                    'message' => self::TIPO_MAZO_NOT_FOUND,
                    'error' => self::TIPO_MAZO_NOT_FOUND_MESSAGE,
                    'status' => 404
                ], 404);
            }

            // Actualizamos el tipo de mazo
            $tipoMazo->update($request->all());

            // Retornamos el tipo de mazo en formato JSON
            return new TipoMazoResource($tipoMazo);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el tipo de mazo',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    // ELIMINAR UN TIPO DE MAZO
    public function destroy(string $idTipoMazo)
    {
        try {
            // Buscamos un tipo de mazo por su ID
            $tipoMazo = TipoMazo::find($idTipoMazo);

            // Si el tipo de mazo no existe retornamos un error
            if (!$tipoMazo) {
                return response()->json([
                    'message' => self::TIPO_MAZO_NOT_FOUND,
                    'error' => self::TIPO_MAZO_NOT_FOUND_MESSAGE,
                    'status' => 404
                ], 404);
            }

            // Eliminamos el tipo de mazo
            $tipoMazo->delete();

            // Retornamos un mensaje de éxito
            return response()->json([
                'message' => 'Tipo de mazo eliminado correctamente',
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar el tipo de mazo',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }
}
