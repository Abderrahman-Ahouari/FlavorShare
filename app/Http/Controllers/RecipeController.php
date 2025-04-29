<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\recipe;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Ingredient;



class RecipeController extends Controller
{


    public function create(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'preparation_time' => 'required|integer|min:1',
            'servings' => 'required|integer|min:1',
            'status' => 'nullable|in:safe,banned',
            'video_type' => 'nullable|in:url,file',
            'video' => 'nullable',
            'cover_image' => 'nullable|image|max:2048',
    
            'categories' => 'nullable|array',
            'categories.*' => 'integer|exists:categories,id',
    
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:100', // Now accepting tag names
    
            'ingredients' => 'required|array|min:1',
            'ingredients.*.ingredient_id' => 'required|integer|exists:ingredients,id',
            'ingredients.*.quantity' => 'required|numeric|min:0.01',
            'ingredients.*.unit' => 'required|string|max:50',
    
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',
    
            'steps' => 'required|array|min:1',
            'steps.*.description' => 'required|string',
        ]);
    
        if ($request->video_type === 'file' && $request->hasFile('video')) {
            $validated['video'] = $request->file('video')->store('recipe_videos', 'public');
        } elseif ($request->video_type === 'url') {
            $validated['video'] = $request->input('video');
        }
    
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('recipe_covers', 'public');
        }
    
        $validated['user_id'] = auth()->id();
        $validated['status'] = $validated['status'] ?? 'safe';
    
        $recipe = Recipe::create($validated);
    
        // ✅ Sync categories
        $recipe->categories()->sync($validated['categories'] ?? []);
    
        // ✅ Handle tags: create if not exists
        $tagIds = [];
        if (!empty($validated['tags'])) {
            foreach ($validated['tags'] as $tagName) {
                $tag = \App\Models\Tag::firstOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }
        }
        $recipe->tags()->sync($tagIds);
    
        // ✅ Attach ingredients
        foreach ($validated['ingredients'] as $ingredient) {
            $recipe->ingredients()->attach($ingredient['ingredient_id'], [
                'quantity' => $ingredient['quantity'],
                'unit' => $ingredient['unit']
            ]);
        }
    
        // ✅ Store recipe images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('recipe_images', 'public');                        
                $recipe->images()->create(['image_path' => $path]);
            }
        }
    
        // ✅ Store steps
        foreach ($validated['steps'] as $step) {
            $recipe->steps()->create(['description' => $step['description']]);
        }
    }
    

    
    public function update(Request $request, Recipe $recipe)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'preparation_time' => 'nullable|integer|min:1',
            'servings' => 'nullable|integer|min:1',
            'steps' => 'nullable|array',
            'steps.*.title' => 'required_with:steps|string',
            'steps.*.description' => 'required_with:steps|string',
            'video_type' => 'nullable|in:url,file',
            'video' => 'nullable',
            'status' => 'nullable|in:safe,banned',
        ]);
    
        if ($request->video_type === 'file' && $request->hasFile('video')) {
            $videoPath = $request->file('video')->store('recipe_videos', 'public');
            $data['video'] = $videoPath;
        } elseif ($request->video_type === 'url') {
            $data['video'] = $request->input('video');
        }
    
        $recipe->update($data);
    
        return response()->json($recipe);
    }
    
    
    public function delete(Recipe $recipe)
    {
        $this->authorize('delete', $recipe); // optional
    
        $recipe->delete();
    
        return response()->json(['message' => 'Recipe deleted successfully.']);
    }


    public function create_recipe_view()
    {
        $categories = Category::all();
        $tags = Tag::select('id', 'name')->get();
        $ingredients = Ingredient::select('id', 'name')->get(); 
    
        return view('user.create_recipe', compact('categories', 'tags', 'ingredients'));
    }
    
    
}
