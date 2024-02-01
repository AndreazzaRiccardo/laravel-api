<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'name' => ['required','max:100','min:5','unique:projects'],
            'description' => ['nullable', 'max:300'],
            'link' => ['required','unique:projects'],
            'cover_image' => ['nullable', 'image', 'max:5000'],
            'type_id' => ['nullable', 'numeric', 'exists:types,id'],
            'technologies' => ['exists:technologies,id']
        ];
    }
}
