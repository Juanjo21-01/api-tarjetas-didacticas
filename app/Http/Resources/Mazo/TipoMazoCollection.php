<?php

namespace App\Http\Resources\Mazo;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TipoMazoCollection extends ResourceCollection
{
    // Arreglo de campos que se devolverán
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
