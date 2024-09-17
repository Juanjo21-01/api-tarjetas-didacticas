<?php

namespace App\Http\Resources\Permiso;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PermisoResource extends JsonResource
{
    // Arreglo de campos que se devolverán
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'roles_asignados' => $this->role_permisos->map(function($role){
                return [
                    'id' => $role->id,
                    'nombre' => $role->role->nombre,
                    'estado' => $role->estado
                ];
            })->toArray(),
        ];
    }
}
