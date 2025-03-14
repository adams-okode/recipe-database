<?php

namespace Database\Factories;

use App\Models\Recipe;
use App\Models\Cuisine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    protected $model = Recipe::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'cuisine_id' => Cuisine::inRandomOrder()->first()->id, // Create a new cuisine for each recipe
            'instructions' => $this->faker->paragraphs(3, true),
            'image_path' => $this->faker->imageUrl(),
        ];
    }
}
