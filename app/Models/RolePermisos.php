<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RolePermisos extends Model
{
    // Nombre de la tabla
    protected $table = 'role_permisos';

    // Campos que se pueden llenar
    protected $fillable = [
        'role_id',
        'permiso_id',
        'estado'
    ];

    // Relación uno a muchos (inversa)
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function permiso(): BelongsTo
    {
        return $this->belongsTo(Permiso::class);
    }
}
