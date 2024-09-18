<?php

namespace App\Http\Controllers;

use App\Models\Tarjeta;
use Illuminate\Http\Request;
use App\Http\Resources\Tarjeta\TarjetaCollection;
use App\Http\Resources\Tarjeta\TarjetaResource;
use App\Http\Requests\Tarjeta\StoreTarjetaRequest;
use App\Http\Requests\Tarjeta\UpdateTarjetaRequest;

class TarjetaController extends Controller
{
    // CONSTANTES
    const TARJETA_NOT_FOUND = 'Tarjeta no encontrada';
    const TARJETA_NOT_FOUND_MESSAGE = 'La tarjeta con el ID proporcionado no existe';

    // MOSTRAR TODAS LAS TARJETAS
    public function index()
    {
        try {
            // Obtenemos todas las tarjetas
            $tarjetas = Tarjeta::all();

            // Retornamos la colección de tarjetas en formato JSON
            return new TarjetaCollection($tarjetas);
        } catch (\Exception $e) {
            // Retornamos un mensaje de error
            return response()->json([
                'message' => 'Error al obtener las tarjetas',
                'error'=> $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    // CREAR UNA NUEVA TARJETA
    public function store(StoreTarjetaRequest $request)
    {
        try {
            // Creamos una nueva tarjeta
            return new TarjetaResource(Tarjeta::create($request->all()));
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear la tarjeta',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    // MOSTRAR UNA TARJETA ESPECÍFICA
    public function show(string $idTarjeta)
    {
        try {
            // Buscamos una tarjeta por su ID
            $tarjeta = Tarjeta::find($idTarjeta);

            // Si la tarjeta no existe, retornamos un mensaje de error
            if (!$tarjeta) {
                return response()->json([
                    'message' => self::TARJETA_NOT_FOUND,
                    'error' => self::TARJETA_NOT_FOUND_MESSAGE,
                    'status' => 404
                ], 404);
            }

            // Retornamos la tarjeta en formato JSON
            return new TarjetaResource($tarjeta);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al obtener la tarjeta',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    // ACTUALIZAR UNA TARJETA
    public function update(UpdateTarjetaRequest $request, string $idTarjeta)
    {
        try {
            // Buscamos una tarjeta por su ID
            $tarjeta = Tarjeta::find($idTarjeta);

            // Si la tarjeta no existe, retornamos un mensaje de error
            if (!$tarjeta) {
                return response()->json([
                    'message' => self::TARJETA_NOT_FOUND,
                    'error' => self::TARJETA_NOT_FOUND_MESSAGE,
                    'status' => 404
                ], 404);
            }

            // Actualizamos la tarjeta
            $tarjeta->update($request->all());

            // Retornamos la tarjeta actualizada en formato JSON
            return new TarjetaResource($tarjeta);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar la tarjeta',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    // ELIMINAR UNA TARJETA
    public function destroy(string $idTarjeta)
    {
        try {
            // Buscamos una tarjeta por su ID
            $tarjeta = Tarjeta::find($idTarjeta);

            // Si la tarjeta no existe, retornamos un mensaje de error
            if (!$tarjeta) {
                return response()->json([
                    'message' => self::TARJETA_NOT_FOUND,
                    'error' => self::TARJETA_NOT_FOUND_MESSAGE,
                    'status' => 404
                ], 404);
            }

            // Eliminamos la tarjeta
            $tarjeta->delete();

            // Retornamos un mensaje de éxito
            return response()->json([
                'message' => 'Tarjeta eliminada correctamente',
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar la tarjeta',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }
}
