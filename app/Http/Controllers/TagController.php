<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tag;


class TagController extends Controller
{
    public function getall()
    {
        $tags = Tag::all();
        return response()->json($tags);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
        ]);

        $tag = Tag::create([
            'name' => $request->name
        ]);

        return response()->json($tag, 201);
    }

    public function update(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $id,
        ]);

        $tag->update([
            'name' => $request->name
        ]);

        return response()->json($tag);
    }

    public function delete($id)
    {
        $tag = Tag::findOrFail($id);

        $tag->delete();

        return response()->json(['message' => 'Tag deleted successfully']);
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
    
        $tags = Tag::where('name', 'like', '%' . $query . '%')
            ->select('id', 'name')
            ->limit(10)
            ->get();
    
        return response()->json($tags);
    }

    
    
}
