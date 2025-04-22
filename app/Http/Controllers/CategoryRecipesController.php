<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\recipe;
use App\Models\category;


class CategoryRecipesController extends Controller
{
    public function attachCategories(Request $request, $recipeId)
    {
        $request->validate([
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id',
        ]);

        $recipe = Recipe::findOrFail($recipeId);
        $recipe->categories()->attach($request->category_ids);

        return response()->json(['message' => 'Categories attached successfully']);
    }

    public function detachCategories(Request $request, $recipeId)
    {
        $request->validate([
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id',
        ]);

        $recipe = Recipe::findOrFail($recipeId);
        $recipe->categories()->detach($request->category_ids);

        return response()->json(['message' => 'Categories detached successfully']);
    }

    public function syncCategories(Request $request, $recipeId)
    {
        $request->validate([
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id',
        ]);

        $recipe = Recipe::findOrFail($recipeId);
        $recipe->categories()->sync($request->category_ids);

        return response()->json(['message' => 'Categories synced successfully']);
    }

    public function getCategoriesForRecipe($recipeId)
    {
        $recipe = Recipe::with('categories')->findOrFail($recipeId);

        return response()->json($recipe->categories);
    }

    public function getRecipesForCategory($categoryId)
    {
        $category = Category::with('recipes')->findOrFail($categoryId);

        return response()->json($category->recipes);
    }
}
