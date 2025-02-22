<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'moreDescription', 'additionnalInfos', 
        'stock', 'soldePrice', 'regularPrice', 'imageUrls', 'brand',
        'isAvailable', 'isBestSeller', 'isNewArrival', 'isFeatured', 'isSpecialOffer'
    ];

    /**
     * Casts pour convertir automatiquement les champs booléens.
     */
    protected $casts = [
        'isAvailable' => 'boolean',
        'isBestSeller' => 'boolean',
        'isNewArrival' => 'boolean',
        'isFeatured' => 'boolean',
        'isSpecialOffer' => 'boolean',
    ];

    public function categories()
    {
        // return $this->belongsToMany(\App\Models\Category::class);
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function imageUrls()
    {
        return json_decode($this->imageUrls, true) ?? [];
    }

	public function tags()
	{
		
		return $this->belongsToMany(\App\Models\Tag::class);
	
	}

}
