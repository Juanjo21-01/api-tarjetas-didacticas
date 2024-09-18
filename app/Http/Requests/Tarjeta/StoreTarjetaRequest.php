<?php

namespace App\Http\Requests\Tarjeta;

use Illuminate\Foundation\Http\FormRequest;

class StoreTarjetaRequest extends FormRequest
{
    // Autorizar la petición
    public function authorize(): bool
    {
        return true;
    }

    // Reglas de validación
    public function rules(): array
    {
        return [
            'pregunta' => ['required', 'string'],
            'respuesta' => ['required', 'string'],
            'mazo_id' => ['required', 'integer', 'exists:mazos,id'],
        ];
    }
}
