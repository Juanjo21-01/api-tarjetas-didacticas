<?php

namespace App\Http\Resources\Tarjeta;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TarjetaCollection extends ResourceCollection
{
    // Arreglo de campos que se devolverán
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
