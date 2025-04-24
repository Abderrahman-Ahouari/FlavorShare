<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;




class CategoryController extends Controller
{
    public function getall()       
    {
        return Category::all();
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = Category::create($request->only('name', 'description'));

        return response()->json($category, 201);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($request->only('name', 'description'));

        return response()->json($category);
    }

    public function delete(Category $category)       
    {
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}
