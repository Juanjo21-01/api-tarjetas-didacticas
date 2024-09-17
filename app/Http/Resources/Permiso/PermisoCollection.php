<?php

namespace App\Http\Resources\Permiso;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PermisoCollection extends ResourceCollection
{
    // Arreglo de campos que se devolverán
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
