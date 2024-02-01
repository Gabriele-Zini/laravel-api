<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'name' => ['required', 'max:50', 'min:3', Rule::unique('projects')->ignore($this->project)],
            'description' => ['required', 'max:500', 'min:5'],
            'cover_image' => ['nullable', 'image', 'max:512'],
            'type_id' => ['nullable'],
            'technologies' => ['nullable', 'exists:technologies,id'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'il nome è obbligatorio',
            'name.min' => 'il numero minimo di caratteri per il nome è :min',
            'name.max' => 'il numero massimo di caratteri per il nome è :max',
            'name.unique' => 'esiste già un nome così',
            'description.min' => 'il numero minimo di caratteri per la descrizione è :min',
            'description.max' => 'il numero massimo di caratteri per la descrizione è :max',
            'description.required' => 'la descrizione è obbligatoria',
        ];
    }
}
