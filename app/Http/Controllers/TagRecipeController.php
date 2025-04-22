<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\recipe;
use App\Models\tag;




class TagRecipeController extends Controller
{
    // Attach tags to a recipe
    public function attachTags(Request $request, $recipeId)
    {
        $recipe = Recipe::findOrFail($recipeId);

        $tags = Tag::find($request->tag_ids); // assuming the tags' IDs are passed in an array

        $recipe->tags()->attach($tags);

        return response()->json(['message' => 'Tags attached successfully'], 200);
    }

    // Detach tags from a recipe
    public function detachTags(Request $request, $recipeId)
    {
        $recipe = Recipe::findOrFail($recipeId);

        $tags = Tag::find($request->tag_ids); // assuming the tags' IDs are passed in an array

        $recipe->tags()->detach($tags);

        return response()->json(['message' => 'Tags detached successfully'], 200);
    }

    // Get all tags for a recipe
    public function getTagsForRecipe($recipeId)
    {
        $recipe = Recipe::findOrFail($recipeId);

        $tags = $recipe->tags;

        return response()->json($tags);
    }

    // Get all recipes for a tag
    public function getRecipesForTag($tagId)
    {
        $tag = Tag::findOrFail($tagId);

        $recipes = $tag->recipes;

        return response()->json($recipes);
    }

    // Sync tags for a recipe (attach new tags, detach removed tags)
    public function syncTags(Request $request, $recipeId)
    {
        $recipe = Recipe::findOrFail($recipeId);

        $tags = Tag::find($request->tag_ids); // assuming the tags' IDs are passed in an array

        $recipe->tags()->sync($tags);

        return response()->json(['message' => 'Tags synced successfully'], 200);
    }
}
