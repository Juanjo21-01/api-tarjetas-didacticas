<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoMazo extends Model
{
    // Nombre de la tabla
    protected $table = 'tipo_mazos';

    // Campos que se pueden llenar
    protected $fillable = ['nombre'];

    // Relación uno a muchos
    public function mazos(): HasMany
    {
        return $this->hasMany(Mazo::class);
    }
}
