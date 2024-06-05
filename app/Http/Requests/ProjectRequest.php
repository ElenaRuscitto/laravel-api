<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'title' => 'required|min:5|max:60',
            'link' => 'required',
            'image' => 'image|mimes:jpg,png|max:20480'

        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Il Titolo è un campo obbligatorio',
            'title.min' => 'Il Titolo deve essere almeno di :min  caratteri',
            'title.max' => 'Il Titolo può essere al massimo di :max  caratteri',
            'link.required' => 'Il Link è un campo obbligatorio',
            'image.image' => 'Il file caricato deve essere un immagine',
            'image.mimes' => "L'immagine caricata può essere solo in formato .jpg e .png",
            'image.max' => "L'immagine caricata non può essere più pesante di :max KB"
        ];
    }
}
