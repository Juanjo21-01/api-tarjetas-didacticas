<?php

namespace App\Http\Requests\Mazo;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMazoRequest extends FormRequest
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
                'nombre' => ['required', 'string', 'max:50'],
                'descripcion' => ['required', 'string', 'max:255'],
                'tipo_mazo_id' => ['required', 'integer', 'exists:tipo_mazos,id'],
            ];
        } else {
            return [
                'nombre' => ['sometimes', 'string', 'max:50'],
                'descripcion' => ['sometimes', 'string', 'max:255'],
                'tipo_mazo_id' => ['sometimes', 'integer', 'exists:tipo_mazos,id'],
            ];
        }
    }
}
