<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $params = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'body' => 'required|max:2000',
            'url' => 'nullable',
        ]);
        
        $post = Post::findOrFail($params['post_id']);
        $post->comments()->create($params);
        
        return redirect()->route('posts.show', ['post' => $post]);
    }
    
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        
        \DB::transaction(function ()use($comment){
            $comment->delete();
        });
        
        return redirect()->route('top');
    }
}
