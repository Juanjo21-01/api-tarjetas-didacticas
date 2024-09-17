<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends Controller
{
    // CONSTANTES
    const USER_NOT_FOUND = 'Usuario no encontrado';
    const USER_NOT_FOUND_MESSAGE = 'El usuario con el ID proporcionado no existe';

    // MOSTRAR TODOS LOS USUARIOS
    public function index()
    {
        try {
            // Obtenemos todos los usuarios
            $users = User::all();

            // Retornamos la colección de usuarios en formato JSON
            return new UserCollection($users);
        } catch (\Exception $e) {
            // Retornamos un mensaje de error
            return response()->json([
                'message' => 'Error al obtener los usuarios',
                'error'=> $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    // MOSTRAR UN USUARIO ESPECÍFICO
    public function show(string $idUser)
    {
        try {
            // Buscamos un usuario por su ID
            $user = User::find($idUser);

            // Si el usuario no existe retornamos un error
            if (!$user) {
                return response()->json([
                    'message' => self::USER_NOT_FOUND,
                    'error' => self::USER_NOT_FOUND_MESSAGE,
                    'status' => 404
                ], 404);
            }

            // Retornamos el usuario en formato JSON
            return new UserResource($user);
        } catch (\Exception $e) {
            // Retornamos un mensaje de error
            return response()->json([
                'message' => 'Error al obtener el usuario',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

    // ACTUALIZAR UN USUARIO
    public function update(UpdateUserRequest $request, string $idUser)
    {
        try {
            // Buscamos un usuario por su ID
            $user = User::find($idUser);

            // Si el usuario no existe retornamos un error
            if (!$user) {
                return response()->json([
                    'message' => self::USER_NOT_FOUND,
                    'error' => self::USER_NOT_FOUND_MESSAGE,
                    'status' => 404
                ], 404);
            }

            // Actualizamos el usuario
            $user->update($request->all());

            // Retornamos el usuario actualizado en formato JSON
            return new UserResource ($user);
        } catch (\Exception $e) {
            // Retornamos un mensaje de error
            return response()->json([
                'message' => 'Error al actualizar el usuario',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    
    }

    // ELIMINAR UN USUARIO
    public function destroy(string $idUser)
    {
        try {
            // Buscamos un usuario por su ID
            $user = User::find($idUser);

            // Si el usuario no existe retornamos un error
            if (!$user) {
                return response()->json([
                    'message' => self::USER_NOT_FOUND,
                    'error' => self::USER_NOT_FOUND_MESSAGE,
                    'status' => 404
                ], 404);
            }

            // Eliminamos el usuario
            $user->delete();

            // Retornamos un mensaje de éxito
            return response()->json([
                'message' => 'Usuario eliminado correctamente',
                'status' => 200
            ], 200);
        } catch (\Exception $e) {
            // Retornamos un mensaje de error
            return response()->json([
                'message' => 'Error al eliminar el usuario',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }
}
