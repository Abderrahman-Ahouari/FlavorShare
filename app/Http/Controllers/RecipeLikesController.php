<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\RecipeLike;
use App\Models\RecipeFavorite;

class RecipeLikesController extends Controller
{
    public function like(Request $request, $recipeId)
    {
        $user = auth()->user();
        $recipe = Recipe::findOrFail($recipeId);

        // Check if the user has already liked the recipe
        $like = RecipeLike::where('user_id', $user->id)->where('recipe_id', $recipe->id)->first();

        if ($like) {
            // If the user has already liked the recipe, remove the like
            $like->delete();
            return response()->json(['message' => 'Recipe unliked successfully.']);
        } else {
            // If the user has not liked the recipe, add a new like
            RecipeLike::create([
                'user_id' => $user->id,
                'recipe_id' => $recipe->id,
            ]);
        }
    }


    public function favorite(Request $request, $recipeId)
    {
        $user = auth()->user();
        $recipe = Recipe::findOrFail($recipeId);

        // Check if the user has already favorited the recipe
        $favorite = RecipeFavorite::where('user_id', $user->id)->where('recipe_id', $recipe->id)->first();

        if ($favorite) {
            // If the user has already favorited the recipe, remove the favorite
            $favorite->delete();
            return response()->json(['message' => 'Recipe unfavorited successfully.']);
        } else {
            // If the user has not favorited the recipe, add a new favorite
            RecipeFavorite::create([
                'user_id' => $user->id,
                'recipe_id' => $recipe->id,
            ]);
        }
    }
}
