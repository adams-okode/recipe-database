<?php

namespace App\Http\Controllers;

use App\Models\Cuisine;
use Illuminate\Http\Request;

class CuisineController extends Controller
{
    /**
     * Display a listing of the cuisines.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $cuisines = Cuisine::with('recipes')->get();
        return response()->json($cuisines);
    }

    /**
     * Store a newly created cuisine in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:cuisines',
        ]);

        $cuisine = Cuisine::create($validatedData);

        return response()->json($cuisine, 201);
    }

    /**
     * Display the specified cuisine.
     *
     * @param  \App\Models\Cuisine  $cuisine
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Cuisine $cuisine)
    {
        $cuisine->load('recipes');
        return response()->json($cuisine);
    }

    /**
     * Update the specified cuisine in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cuisine  $cuisine
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Cuisine $cuisine)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:cuisines,name,' . $cuisine->id,
        ]);

        $cuisine->update($validatedData);

        return response()->json($cuisine);
    }

    /**
     * Remove the specified cuisine from storage.
     *
     * @param  \App\Models\Cuisine  $cuisine
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Cuisine $cuisine)
    {
        $cuisine->delete();

        return response()->json(null, 204);
    }
}
