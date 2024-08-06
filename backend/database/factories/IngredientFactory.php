<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Recipe;
use App\Models\Ingredient;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{
    protected $model = Ingredient::class; // Link the factory to the Ingredient model

    protected $ingredientNames = [
        'Flour', 'Sugar', 'Salt', 'Baking Powder', 'Butter', 'Eggs', 'Milk',
        'Vanilla Extract', 'Cocoa Powder', 'Yeast', 'Olive Oil', 'Garlic',
        'Tomato Sauce', 'Basil', 'Oregano', 'Cheese', 'Chicken', 'Beef',
        'Rice', 'Pasta', 'Beans', 'Lentils', 'Carrots', 'Broccoli', 'Spinach',
        'Onions', 'Pepper', 'Chili', 'Cumin', 'Cinnamon'
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'recipe_id' => Recipe::inRandomOrder()->first()->id,
            'name' => $this->faker->randomElement($this->ingredientNames),
            'quantity' => $this->faker->randomFloat(2, 0.1, 5) . ' ' . $this->faker->randomElement(['grams', 'ml', 'pieces', 'cups', 'tablespoons']),
        ];
    }
}
