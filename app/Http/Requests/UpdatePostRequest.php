<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
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
            'titulo'=>['required', 'string', 'min:3', 'unique:posts,titulo,'.$this->post->id],
            'contenido'=>['required', 'string', 'min:10'],
            'estado'=>['required', Rule::in(['PUBLICADO', 'BORRADOR'])],
            'tags'=>['required_without_all', 'exists:tags,id'],
            'image'=>['nullable', 'image', 'max:2048'],
            'category_id'=>['required', 'exists:categories,id']
        ];
    }

    public function messages(){
        return[
            'tags.required_without_all'=>"Elija al menos una etiqueta para el post",
            'tags.exists'=>"la etiqueta NO está registrada!!!"
        ];

    }
}
