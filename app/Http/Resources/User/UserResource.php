<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    // Arreglo de campos que se devolverán
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombres' => $this->nombres,
            'apellidos' => $this->apellidos,
            'dpi' => $this->dpi,
            'email' => $this->email,
            'role' => $this->role->nombre,
            'mazos' => $this->mazos->map(function($mazo){
                return [
                    'id' => $mazo->id,
                    'nombre' => $mazo->nombre,
                    'descripcion' => $mazo->descripcion,
                    'tipo_mazo' => $mazo->tipo_mazo->nombre,
                    'creado' => $mazo->created_at->format('d-m-Y'),
                    'tarjetas' => $mazo->tarjetas->map(function($tarjeta){
                        return [
                            'id' => $tarjeta->id,
                            'pregunta' => $tarjeta->pregunta,
                            'respuesta' => $tarjeta->respuesta,
                        ];
                    })->toArray(),
                ];
            })->toArray(),
        ];
    }
}
