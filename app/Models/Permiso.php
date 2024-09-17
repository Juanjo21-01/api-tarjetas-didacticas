<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Permiso extends Model
{
    // Nombre de la tabla
    protected $table = 'permisos';

    // Campos que se pueden llenar
    protected $fillable = ['nombre'];

    // Relación uno a muchos
    public function role_permisos(): HasMany
    {
        return $this->hasMany(RolePermisos::class);
    }
}
