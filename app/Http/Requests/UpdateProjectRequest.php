<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
            'name' => ['required','max:100','min:5', Rule::unique('projects')->ignore($this->project)],
            'description' => ['nullable', 'max:300'],
            'link' => ['required', Rule::unique('projects')->ignore($this->project)],
            'cover_image' => ['nullable', 'image', 'max:5000'],
            'type_id' => ['nullable', 'numeric', 'exists:types,id'],
            'technologies' => ['exists:technologies,id']
        ];
    }
}
