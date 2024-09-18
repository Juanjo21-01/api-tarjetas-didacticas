<?php

namespace App\Http\Requests\Tarjeta;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTarjetaRequest extends FormRequest
{
    // Autorizar la petición
    public function authorize(): bool
    {
        return true;
    }

    // Reglas de validación
    public function rules(): array
    {
         $method = $this->method();

        if ($method === 'PUT'){
            return [
                'pregunta' => ['required', 'string'],
                'respuesta' => ['required', 'string'],
                'mazo_id' => ['required', 'integer', 'exists:mazos,id'],
            ];
        } else {
            return [
                'pregunta' => ['sometimes', 'string'],
                'respuesta' => ['sometimes', 'string'],
                'mazo_id' => ['sometimes', 'integer', 'exists:mazos,id'],
            ];
        }
    }
}
