<?php

namespace App\Http\Resources\Mazo;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MazoResource extends JsonResource
{
    // Arreglo de campos que se devolverán
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'tipo_mazo' => $this->tipo_mazo->nombre,
            'user' => $this->user->nombres,
            'creado' => $this->created_at->format('d-m-Y'),
        ];
    }
}
