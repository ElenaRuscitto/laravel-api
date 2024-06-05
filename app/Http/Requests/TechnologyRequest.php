<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TechnologyRequest extends FormRequest
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
            'name' => 'required|min:3|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Inserire un nome',
            'name.min' => 'Il nome deve contenere almeno :min caratteri',
            'name.max' => 'Il nome non deve contenere più di :max caratteri',
        ];
    }
}
