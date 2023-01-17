<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function postsShow()
    {
        $posts = Post::latest()
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.username')
            ->get();
        return view('home', ['posts' => $posts]);
    }

    public function createPost(Request $request)
    {
        Post::create([
            'user_id' => Auth::user()->id,
            'text' => $request->userdata
        ]);
         $post = Post::latest('created_at')
             ->join('users', 'posts.user_id', '=', 'users.id')
             ->select('posts.*', 'users.username')
             ->first()
             ->toArray();
        return $post;
    }

    public function editPost(Request $request)
    {
        Post::where('id', '=', $request->postId)->update([
            'text' => $request->userdata,
        ]);
        $post = Post::latest('updated_at')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.username')
            ->first()
            ->toArray();
        return $post;
    }

    public function deletePost(Request $request)
    {
        Post::find($request->postId)->delete();
        return $request->postId;
    }
}
