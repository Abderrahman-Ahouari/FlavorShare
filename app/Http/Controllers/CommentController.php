<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function create(Request $request, $recipeId)
    {
        $data = $request->validate([
            'content' => 'required|string',
        ]);

        $comment = Comment::create([
            'user_id' => auth()->id(),
            'recipe_id' => $recipeId,
            'content' => $data['content'],
        ]);

        return redirect()->back();
    }

    public function delete(Comment $comment)
    {    
        $comment->delete();
    
        return response()->json(['message' => 'Comment deleted successfully.']);
    }

}
