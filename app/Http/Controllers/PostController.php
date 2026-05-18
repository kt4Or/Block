<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {

        $posts = Post::with('category')->orderBy('id', 'desc')->paginate(2);
        return view('posts.index', compact('posts'));
    }

    public function show($slug)
    {
        
        $post = Post::with(['category', 'tags'])->where('slug', $slug)->firstOrFail();
        
        
        $post->increment('views');
        
        
        return view('posts.show', compact('post'));
    }
}
