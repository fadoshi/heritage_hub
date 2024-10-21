<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tags = Tag::all(); // Retrieve all tags from the 'tags' table
        $posts = Post::with('tags', 'user')->latest()->Paginate(5); // Fetch posts with related tags and user
        return view('home', compact('posts', 'tags'));        
    }

    public function show(Post $post)
    {
        $tags = Tag::all();
        //$post = Post::with('tags', 'user')->find($post);
        return view('blog', ['post' => $post, 'tags' => $tags]);
    }
}
