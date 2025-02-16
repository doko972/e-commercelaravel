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
        $isRequired = request()->isMethod("POST") ?"required|": "";
        return [
            //
            'name' => $isRequired.'string',
			'slug' => $isRequired.'',
			'description' => $isRequired.'string',
			'moreDescription' => $isRequired.'string',
			'additionnalInfos' => $isRequired.'string',
			'stock' => $isRequired.'string',
			'soldePrice' => $isRequired.'string',
			'regularPrice' => $isRequired.'string',
			'imageUrls' => $isRequired.'array|max:5',
			'imageUrls.*' => 'image|mimes:webp,jpeg,png,jpg,gif|max:2048',
			'brand' => $isRequired.'string',
			'isAvailable' => $isRequired.'in:true,false|nullable',
			'isBestSeller' => $isRequired.'in:true,false|nullable',
			'isNewArrival' => $isRequired.'in:true,false|nullable',
			'isFeatured' => $isRequired.'in:true,false|nullable',
			'isSpecialOffer' => $isRequired.'in:true,false|nullable',
            'categories' => $isRequired.'array|exists:categories,id'
			
        ];
    }
    public function prepareForValidation()
    {
        $this->merge([
            'slug' => \Illuminate\Support\Str::slug($this->input('name')),
			'isAvailable' => $this->input('isAvailable') ? 1 : 0,
			'isBestSeller' => $this->input('isBestSeller') ? 1 : 0,
			'isNewArrival' => $this->input('isNewArrival') ? 1 : 0,
			'isFeatured' => $this->input('isFeatured') ? 1 : 0,
			'isSpecialOffer' => $this->input('isSpecialOffer') ? 1 : 0,
			
        ]);
    }
}