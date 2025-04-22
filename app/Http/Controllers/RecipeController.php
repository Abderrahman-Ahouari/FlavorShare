<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\recipe;



class RecipeController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'preparation_time' => 'nullable|integer|min:1',
            'servings' => 'nullable|integer|min:1',
            'steps' => 'nullable|array',
            'steps.*.title' => 'required_with:steps|string',
            'steps.*.description' => 'required_with:steps|string',
            'video_type' => 'nullable|in:url,file',
            'video' => 'nullable',
            'cover_image' => 'nullable|image|max:2048', // ✅
            'status' => 'nullable|in:safe,banned',
        ]);
    
        if ($request->video_type === 'file' && $request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('recipe_videos', 'public');
        } elseif ($request->video_type === 'url') {
            $data['video'] = $request->input('video');
        }
    
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('recipe_covers', 'public');
        }
    
        $data['user_id'] = auth()->id();
        $data['status'] = $data['status'] ?? 'safe';
    
        $recipe = Recipe::create($data);
    
        return response()->json($recipe, 201);
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
    
}
