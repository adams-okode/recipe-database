<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    /**
     * Display a listing of the ingredients.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $ingredients = Ingredient::with('recipe')->paginate();

        return response()->json($ingredients);
    }

    /**
     * Store a newly created ingredient in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'recipe_id' => 'required|exists:recipes,id',
            'name' => 'required|string|max:255',
            'quantity' => 'required|string|max:50',
        ]);

        $ingredient = Ingredient::create($validatedData);

        return response()->json($ingredient, 201);
    }

    /**
     * Display the specified ingredient.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Ingredient $ingredient)
    {
        $ingredient->load('recipe');
        return response()->json($ingredient);
    }

    /**
     * Update the specified ingredient in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        $validatedData = $request->validate([
            'recipe_id' => 'required|exists:recipes,id',
            'name' => 'required|string|max:255',
            'quantity' => 'required|string|max:50',
        ]);

        $ingredient->update($validatedData);

        return response()->json($ingredient);
    }

    /**
     * Remove the specified ingredient from storage.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();

        return response()->json(null, 204);
    }
}
