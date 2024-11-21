<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('comments.replies')->get();
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->load('comments.replies');
        return view('posts.show', compact('post'));
    }
}
