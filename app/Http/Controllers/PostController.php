<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowPostRequest;
use App\Http\Requests\StorePostRequest;
use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PostController extends Controller
{
    public function index()
    {
        // I had to create attribute but what if I want to retrieve it formatted on the fly or I re-edit the output ?//
        // $allPosts = Post::with('user')->get()->map(function ($post) {
        //     $post->created_at_formatted = Carbon::parse($post->created_at)->format('Y-m-d');
        //     $post->updated_at_formatted = Carbon::parse($post->updated_at)->format('Y-m-d');
        //     return $post;
        // });

        $posts = Post::with('user')->paginate(8);
        // $allPosts = $posts->map(function ($post) {
        //     $post->created_at_formatted = Carbon::parse($post->created_at)->format('Y-m-d');
        //     $post->updated_at_formatted = Carbon::parse($post->updated_at)->format('Y-m-d');
        //     return $post;
        // });

        $allPosts = $posts;
        foreach ($posts as $post) {
            $post->created_at_formatted = Carbon::parse($post->created_at)->format('Y-m-d');
            $post->updated_at_formatted = Carbon::parse($post->updated_at)->format('Y-m-d');
        }
        $update = null;
        $delete = null;

        if (session()->get('update')) {
            $update = session()->get('update');
        }

        if (session()->get('delete')) {
            $delete = session()->get('delete');
        }
        return view('post.index', ['posts' => $allPosts, 'postLinks'=>$posts,'update'=>$update, 'delete'=>$delete]);
    }

    public function show(ShowPostRequest $request, $id)
    {
        // Next time I want to retrieve post with its users together
        $post = Post::where('id', $id)->with(['comments.user'])->get()->map(function ($post) {
            $post->created_at_formatted = Carbon::parse($post->created_at)->format('Y-m-d');
            $post->updated_at_formatted = Carbon::parse($post->updated_at)->format('Y-m-d');
            return $post;
        })->first();
        $user = null;
        if ($post) {
            $userID = $post->user_id;
            $user = User::where('id', $userID)->first();
        } else {
            abort(404);
        }
        $users = User::all();
        return view('post.show', ['post' => $post, 'user'=> $user,'users'=>$users]);
    }

    public function create()
    {
        $users = User::all();
        return view("post.create", ['users' => $users]);
    }

    public function store(StorePostRequest $request)
    {
        $input = $request->only(['title','description','post_creator']);

        Post::create([
            'title' => $input['title'],
            'description' => $input['description'],
            'user_id' => $input['post_creator'],
        ]);
        return redirect()->route('posts.index');
    }

    public function edit(ShowPostRequest $request, $id)
    {
        $post = Post::where('id', $id)->first();
        if (!$post) {
            abort(404);
        }
        $author = User::where('id', $post->user_id)->first();
        $users = User::all();
        return view("post.edit", ['post' => $post, 'users'=> $users, 'author'=>$author]);
    }

    public function update(StorePostRequest $request, $id)
    {
        $input = $request->only(['title','description','post_creator']);
        $postUpdate = Post::where('id', $id)->update([
            'title' => $input['title'],
            'description' => $input['description'],
            'user_id' => $input['post_creator'],
        ]);

        return redirect()->route('posts.index')->with('update', $postUpdate);
    }

    public function destroy($id)
    {
        $deleted = Post::where('id', $id)->delete();
        return redirect()->route('posts.index')->with('delete', $deleted);
    }
}
