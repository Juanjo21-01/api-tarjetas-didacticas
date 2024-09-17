<?php

namespace App\Http\Resources\Role;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    // Arreglo de campos que se devolverán
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'permisos_asignados' => $this->role_permisos->map(function($permiso){
                return [
                    'id' => $permiso->id,
                    'nombre' => $permiso->permiso->nombre,
                    'estado' => $permiso->estado
                ];
            })->toArray(),
        ];
    }
}
