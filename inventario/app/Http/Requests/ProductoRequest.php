<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
             'precio' => 'required|numeric|max:999999', // Máximo de 6 dígitos
            // Otras reglas de validación para otros campos si es necesario
        ];
    }

    public function messages()
    {
        return [
            'precio.max' => 'El precio no puede tener más de 6 dígitos.',
        ];
    }
}