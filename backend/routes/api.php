<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\CuisineController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Recipes CRUD Routes
Route::get('recipes', [RecipeController::class, 'index'])->name('recipes.index');
Route::post('recipes', [RecipeController::class, 'store'])->name('recipes.store');
Route::get('recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');
Route::post('recipes/{recipe}', [RecipeController::class, 'update'])->name('recipes.update');
Route::patch('recipes/{recipe}', [RecipeController::class, 'update'])->name('recipes.patch');
Route::delete('recipes/{recipe}', [RecipeController::class, 'destroy'])->name('recipes.destroy');

Route::apiResource('ingredients', IngredientController::class);
Route::apiResource('cuisines', CuisineController::class);
