<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'rut' => ['required', 'max:255', 'string'],
            'nombres' => ['required', 'max:255', 'string'],
            'apellidos' => ['required', 'max:255', 'string'],
            'proveedor_id' => ['required', 'exists:proveedors,id'],
            'motivo' => ['required', 'max:255', 'string'],
            'estado_id' => ['required', 'exists:estados,id'],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }
}
