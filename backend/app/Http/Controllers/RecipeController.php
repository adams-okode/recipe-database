<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    /**
     * Display a listing of the recipes.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $recipes = Recipe::with('cuisine', 'ingredients')->orderByDesc('created_at')->paginate(10);
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
        $request->validate([
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

        Log::info($request->hasFile('image'));

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
        Log::info(json_encode($request->all()));
        // Validate incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'cuisine_id' => 'required|exists:cuisines,id',
            'instructions' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ingredients' => 'required|array',
            'ingredients.*.id' => 'nullable|exists:ingredients,id',
            'ingredients.*.name' => 'required|string|max:255',
            'ingredients.*.quantity' => 'required|string|max:50',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the old image if a new one is uploaded
            if ($recipe->image_path) {
                Storage::disk('public')->delete($recipe->image_path);
            }
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = $recipe->image_path; // Keep the current image if none is uploaded
        }

        // Extract recipe data from validated data
        $recipeData = $request->only(['name', 'cuisine_id', 'instructions']);
        $recipeData['image_path'] = $imagePath;

        // Update the recipe
        $recipe->update($recipeData);

        // Update or create the ingredients
        $ingredientsData = $request->input('ingredients', []);
        $existingIngredientIds = $recipe->ingredients->pluck('id')->toArray();

        // Loop through each ingredient from the request
        foreach ($ingredientsData as $ingredientData) {
            if (isset($ingredientData['id'])) {
                // Update existing ingredient
                $ingredient = $recipe->ingredients()->find($ingredientData['id']);
                if ($ingredient) {
                    $ingredient->update([
                        'name' => $ingredientData['name'],
                        'quantity' => $ingredientData['quantity'],
                    ]);
                }
                // Remove ID from the list of existing IDs to leave only those that need to be deleted
                $existingIngredientIds = array_diff($existingIngredientIds, [$ingredientData['id']]);
            } else {
                // Create new ingredient
                $recipe->ingredients()->create([
                    'name' => $ingredientData['name'],
                    'quantity' => $ingredientData['quantity'],
                ]);
            }
        }

        // Optionally delete ingredients that are no longer present in the request
        $recipe->ingredients()->whereIn('id', $existingIngredientIds)->delete();

        return response()->json($recipe->load('ingredients'));
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
