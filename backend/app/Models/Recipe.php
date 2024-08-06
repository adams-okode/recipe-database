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

    protected $appends = ['image_url'];


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

    /**
     * Accessor for the full image URL.
     *
     * @return string
     */
    public function getImageUrlAttribute(): string
    {
        // Check if the image path is already a full URL
        if (filter_var($this->attributes['image_path'], FILTER_VALIDATE_URL)) {
            return $this->attributes['image_path'];
        }

        // Prepend the app URL to the image path
        return config('app.url') . '/storage/' . $this->attributes['image_path'];
    }
}
