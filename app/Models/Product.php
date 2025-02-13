<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
	protected $fillable = ['name', 'slug', 'description', 'moreDescription', 'additionnalInfos', 'stock', 'soldePrice', 'regularPrice', 'imageUrls', 'brand', 'isAvaible', 'isBestSeller', 'isNewArrival', 'isFeatured', 'isSpecialOffer'];

	public function categories()
	{
		
		return $this->belongsToMany(\App\Models\Category::class);
	
	}


}
