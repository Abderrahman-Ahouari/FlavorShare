<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
            'recipe_id' => 'required|exists:recipes,id',
            'content' => 'required|string',
            'parent_comment_id' => 'nullable|exists:comments,id',
        ]);
    
        $comment = Comment::create([
            'user_id' => auth()->id(),
            'recipe_id' => $data['recipe_id'],
            'content' => $data['content'],
            'parent_comment_id' => $data['parent_comment_id'] ?? null,
        ]);
    
        return response()->json($comment, 201);
    }


    public function delete(Comment $comment)
    {    
        $comment->delete();
    
        return response()->json(['message' => 'Comment deleted successfully.']);
    }

    

}
