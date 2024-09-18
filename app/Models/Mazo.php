<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mazo extends Model
{
    // Nombre de la tabla
    protected $table = 'mazos';

    // Campos que se pueden llenar
    protected $fillable = ['nombre', 'descripcion', 'tipo_mazo_id', 'user_id'];

    // Relación uno a muchos
    public function tipo_mazo(): belongsTo
    {
        return $this->belongsTo(TipoMazo::class);
    }

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tarjetas(): hasMany
    {
        return $this->hasMany(Tarjeta::class);
    }
}
