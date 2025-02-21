<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
            'name' => $isRequired . 'string',
            'slug' => $isRequired . 'string',
            'description' => $isRequired . 'string',
            'moreDescription' => $isRequired . 'string',
            'additionnalInfos' => $isRequired . 'string',
            'stock' => $isRequired . 'integer|min:0',
            'soldePrice' => $isRequired . 'numeric|min:0',
            'regularPrice' => $isRequired . 'numeric|min:0',
            'imageUrls' => $isRequired . 'array|max:5',
            'imageUrls.*' => 'image|mimes:webp,jpeg,png,jpg,gif|max:2048',
            'brand' => $isRequired . 'string',
            'isAvailable' => 'nullable|boolean',
            'isBestSeller' => 'nullable|boolean',
            'isNewArrival' => 'nullable|boolean',
            'isFeatured' => 'nullable|boolean',
            'isSpecialOffer' => 'nullable|boolean',
            'categories' => $isRequired . 'array|exists:categories,id',
            'tags' => 'array|exists:tags,id',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'slug' => \Illuminate\Support\Str::slug($this->input('name')),
            'isAvailable' => filter_var($this->input('isAvailable'), FILTER_VALIDATE_BOOLEAN),
            'isBestSeller' => filter_var($this->input('isBestSeller'), FILTER_VALIDATE_BOOLEAN),
            'isNewArrival' => filter_var($this->input('isNewArrival'), FILTER_VALIDATE_BOOLEAN),
            'isFeatured' => filter_var($this->input('isFeatured'), FILTER_VALIDATE_BOOLEAN),
            'isSpecialOffer' => filter_var($this->input('isSpecialOffer'), FILTER_VALIDATE_BOOLEAN),
        ]);
    }

}