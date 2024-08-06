<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the recipes.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $recipes = Recipe::with('cuisine', 'ingredients')->paginate();
        return response()->json($recipes);
    }

    /**
     * Store a newly created recipe in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'cuisine_id' => 'required|exists:cuisines,id',
            'instructions' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ingredients' => 'required|array',
            'ingredients.*.name' => 'required|string|max:255',
            'ingredients.*.quantity' => 'required|string|max:50',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Extract recipe data and ingredients from validated data
        $recipeData = $request->only(['name', 'cuisine_id', 'instructions']);
        $recipeData['image_path'] = $imagePath;
        $ingredientsData = $request->input('ingredients');

        // Create the recipe
        $recipe = Recipe::create($recipeData);

        // Create the associated ingredients
        foreach ($ingredientsData as $ingredient) {
            $recipe->ingredients()->create([
                'name' => $ingredient['name'],
                'quantity' => $ingredient['quantity'],
            ]);
        }

        return response()->json($recipe->load('ingredients'), 201);
    }


    /**
     * Display the specified recipe.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Recipe $recipe)
    {
        $recipe->load('cuisine', 'ingredients');
        return response()->json($recipe);
    }

    /**
     * Update the specified recipe in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Recipe $recipe)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'cuisine_id' => 'required|exists:cuisines,id',
            'instructions' => 'required|string',
            'image_path' => 'nullable|string',
        ]);

        $recipe->update($validatedData);

        return response()->json($recipe);
    }

    /**
     * Remove the specified recipe from storage.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return response()->json(null, 204);
    }
}
