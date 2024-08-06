<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cuisine_id',
        'instructions',
        'image_path',
    ];

    /**
     * Get the cuisine that the recipe belongs to.
     */
    public function cuisine()
    {
        return $this->belongsTo(Cuisine::class);
    }

    /**
     * Get the ingredients for the recipe.
     */
    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }
}
