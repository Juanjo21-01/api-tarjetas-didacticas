<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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

        if ($method === 'PUT') {
            // Encriptamos la contraseña
            $this->merge([
                'password' => bcrypt($this->password),
            ]);
            return [
                'nombres' => ['required', 'string', 'max:50'],
                'apellidos' => ['required', 'string', 'max:50'],
                'dpi' => ['required', 'string', 'max:13', 'unique:users,dpi,'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'],
                'password' => ['required', 'string', 'max:255'],
                'role_id' => ['required', 'integer', 'exists:roles,id'],
            ];
        } else {
            if (!$this->filled('password')) {
                return [
                    'nombres' => ['sometimes', 'string', 'max:50'],
                    'apellidos' => ['sometimes', 'string', 'max:50'],
                    'dpi' => ['sometimes', 'string', 'max:13', 'unique:users,dpi,'],
                    'email' => ['sometimes', 'string', 'email', 'max:255', 'unique:users,email,'],
                    'role_id' => ['sometimes', 'integer', 'exists:roles,id'],
                ];
            } else {
                // ENCRIPTAR CONTRASEÑA
                $this->merge([
                    'password' => bcrypt($this->password),
                ]);
                return [
                    'nombres' => ['sometimes', 'string', 'max:50'],
                    'apellidos' => ['sometimes', 'string', 'max:50'],
                    'dpi' => ['sometimes', 'string', 'max:13', 'unique:users,dpi,'],
                    'email' => ['sometimes', 'string', 'email', 'max:255', 'unique:users,email,'],
                    'password' => ['sometimes', 'string', 'max:255'],
                    'role_id' => ['sometimes', 'integer', 'exists:roles,id'],
                ];
            }
        }
    }
}
