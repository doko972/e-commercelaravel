<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageFormRequest extends FormRequest
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
        $isRequired = request()->isMethod("POST") ? "required|" : "";
        
        return [
            'title' => $isRequired . 'string',
            'slug' => $isRequired . 'string',
            'content' => $isRequired . 'string',
            'isHead' => 'nullable|boolean',
            'isFoot' => 'nullable|boolean',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'slug' => \Illuminate\Support\Str::slug($this->input('title')),

            // ✅ Correction : Stocker en 1 ou 0 au lieu de 'true' ou 'false'
            'isHead' => $this->boolean('isHead') ? 1 : 0,
            'isFoot' => $this->boolean('isFoot') ? 1 : 0,
        ]);
    }
}
