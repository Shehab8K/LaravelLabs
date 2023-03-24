<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = new Comment();
        $comment->comment = $request->input('comment');
        $comment->commentable_id = $request->input('commentable_id');
        $comment->commentable_type = $request->input('commentable_type');
        $comment->user_id = $request->input('user_id');
        $comment->save();

        return back();
    }

    public function edit($id)
    {
        $comment = Comment::where('id', $id)->with("user")->first();
        $users = User::all();
        return view("comment.edit", ['comment' => $comment, 'users'=> $users]);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        $comment->comment = $request->input('comment');
        $comment->commentable_type = $request->input('commentable_type');
        $comment->user_id = $request->input('user_id');

        $comment->update();

        return redirect()->route('posts.show', $comment->commentable_id);
    }
    
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $post = $comment->commentable_id;
        
        $comment->delete();

        return redirect()->route('posts.show', $post);
    }
}
