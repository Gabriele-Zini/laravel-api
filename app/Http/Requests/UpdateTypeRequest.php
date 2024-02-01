<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class UpdateTypeRequest extends FormRequest
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
            'name' => ['required', 'max:50', 'min:3', Rule::unique('types')->ignore($this->type)],
            'slug'=>['nullables'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'il nome è obbligatorio',
            'name.min' => 'il numero minimo di caratteri per il nome è :min',
            'name.max' => 'il numero massimo di caratteri per il nome è :max',
            'name.unique' => 'esiste già un nome così',
        ];
    }
}
