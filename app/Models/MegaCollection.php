<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MegaCollection extends Model
{
    use HasFactory;

    protected $table = 'megacollections';
    protected $fillable = ['title', 'description', 'buttonText', 'buttonLink', 'imageUrl'];
}
