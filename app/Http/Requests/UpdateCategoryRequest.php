<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nombre'=>['required', 'string', 'min:3', 'unique:categories,nombre,'.$this->category->id],
            'descripcion'=>['required', 'string', 'min:10'],
            'image'=>['nullable', 'image', 'max:2048']
        ];
    }
}
