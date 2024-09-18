<?php

namespace App\Http\Requests\Mazo;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTipoMazoRequest extends FormRequest
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
            'nombre' => ['required', 'string', 'max:50', 'unique:tipo_mazos'],
        ];
    }
}
