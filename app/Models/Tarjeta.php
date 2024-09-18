<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tarjeta extends Model
{
    // Nombre de la tabla
    protected $table = 'tarjetas';

    // Campos que se pueden llenar
    protected $fillable = ['pregunta', 'respuesta', 'mazo_id'];

    // Relación uno a muchos
    public function mazo()
    {
        return $this->belongsTo(Mazo::class);
    }
}
