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
			'isAvaible' => $isRequired.'in:true,false|nullable',
			'isBestSeller' => $isRequired.'in:true,false|nullable',
			'isNewArrival' => $isRequired.'in:true,false|nullable',
			'isFeatured' => $isRequired.'in:true,false|nullable',
			'isSpecialOffer' => $isRequired.'in:true,false|nullable'
			
        ];
    }
    public function prepareForValidation()
    {
        $this->merge([
            'slug' => \Illuminate\Support\Str::slug($this->input('name')),
			'isAvaible' => $this->input('isAvaible') ? 'true' : 'false',
			'isBestSeller' => $this->input('isBestSeller') ? 'true' : 'false',
			'isNewArrival' => $this->input('isNewArrival') ? 'true' : 'false',
			'isFeatured' => $this->input('isFeatured') ? 'true' : 'false',
			'isSpecialOffer' => $this->input('isSpecialOffer') ? 'true' : 'false',
			
        ]);
    }
}