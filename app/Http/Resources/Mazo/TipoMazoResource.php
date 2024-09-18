<?php

namespace App\Http\Resources\Mazo;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TipoMazoResource extends JsonResource
{
    // Arreglo de campos que se devolverán
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'mazos_creados' => [
                'total' => $this->mazos->count(),
                'mazos' => $this->mazos->map(function($mazo){
                    return [
                        'id' => $mazo->id,
                        'nombre' => $mazo->nombre,
                        'descripcion' => $mazo->descripcion,
                    ];
                })->toArray()
            ]
        ];
    }
}
