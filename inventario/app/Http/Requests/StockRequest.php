<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cantidad' => 'required|integer|min:0|max:999', 
        ];
    }

    public function messages()
    {
        return [
            'cantidad.min' => 'La cantidad no puede ser menor a 0.',
            'cantidad.max' => 'La cantidad no puede tener mas de tres digitos',
        ];
    }
}
