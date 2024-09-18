<?php

namespace App\Http\Resources\Tarjeta;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TarjetaResource extends JsonResource
{
    // Arreglo de campos que se devolverán
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'pregunta' => $this->pregunta,
            'respuesta' => $this->respuesta,
            'creado' => $this->created_at->format('d-m-Y'),
            'mazo' => [
                'nombre' => $this->mazo->nombre,
                'tipo' => $this->mazo->tipo_mazo->nombre,
            ]
        ];
    }
}
