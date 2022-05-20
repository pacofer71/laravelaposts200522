<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nombre'=>['required', 'string', 'min:3', 'unique:categories,nombre'],
            'descripcion'=>['required', 'string', 'min:10'],
            'image'=>['required', 'image', 'max:2048']
        ];
    }
}
