<?php

namespace App\Http\Requests\Mazo;

use Illuminate\Foundation\Http\FormRequest;

class StoreMazoRequest extends FormRequest
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
            'nombre' => ['required', 'string', 'max:50', 'unique:mazos'],
            'descripcion' => ['required', 'string', 'max:255'],
            'tipo_mazo_id' => ['required', 'integer', 'exists:tipo_mazos,id'],
        ];
    }
}
