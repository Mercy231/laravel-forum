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
        $sql = Post::orderBy('updated_at', 'desc')->get()->toArray();
        $posts = [];
        foreach ($sql as $post) {
            $post = (array)$post;
            $post['username'] = User::find($post['user_id'])->username;
            $posts [] = $post;
        }
        return view('home', ['posts' => $posts]);
    }

    public function createPostShow()
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        return view('createPost');
    }

    public function createPost(Request $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $post = Post::create([
            'user_id' => Auth::user()->id,
            'text' => $request->text
        ]);
        if (!$post) {
            return redirect('createPost')->withErrors([
                'createPostError' => 'Unexpected error creating post'
            ]);
        } else {
            return redirect('home');
        }
    }

    public function editPostShow($id)
    {
        if (!Auth::check()) {
            return redirect('login');
        } elseif (Auth::user()->id !== Post::find($id)->user_id) {
            return redirect('home');
        }
        $post = Post::find($id)->toArray();
        return view('editPost', ['post' => $post]);
    }

    public function editPost($id, Request $request)
    {
        if (!Auth::check()) {
            return redirect('login');
        } elseif (Auth::user()->id !== Post::find($id)->user_id) {
            return redirect('home');
        }
        $post = Post::find($id);
        $post->text = $request->text;
        $post->save();
        return redirect('home');
    }

    public function deletePost($id)
    {
        if (!Auth::check()) {
            return redirect('login');
        } elseif (Auth::user()->id !== Post::find($id)->user_id) {
            return redirect('home');
        }
        $post = Post::find($id)->delete();
        return redirect('home');
    }
}
