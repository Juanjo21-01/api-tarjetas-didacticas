<?php

namespace App\Http\Resources\Role;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RolePermisoResource extends JsonResource
{
    // Arreglo de campos que se devolverán
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'role_id' => $this->role->nombre,
            'permiso_id' => $this->permiso->nombre,
            'estado' => $this->estado,
        ];
    }
}
