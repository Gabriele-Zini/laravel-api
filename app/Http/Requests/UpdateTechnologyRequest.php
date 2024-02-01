<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTechnologyRequest extends FormRequest
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
            'technology_name' => ['required'],
            'hex_color' => ['nullable', 'starts_with:#', 'size:7'],
        ];
    }

    public function messages() {
        return [
            'hex_color.starts_with'=> "l'hex color deve iniziare con #",
            'hex_color.size'=> "l'hex color deve avere :size caratteri",
        ];
    }
}
