<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('tags', 'user')->get(); // Fetch posts with related tags and user
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all(); // Fetch all tags for selection
        return view('admin.posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        //dd($request);
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = null;           
        }
        //$request->image->store('images');

        // Save post to the database
        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $imageName,
            'user_id' => Auth::id()
            //'user_id' => auth()->guard('id'),
        ]);

        // Sync or attach the selected tags to the post
        $post->tags()->sync($request->input('tags'));

        return redirect()->route('admin_posts_index')->with('success', 'Post created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $tags = Tag::all();

        return view('admin.posts.edit', ['post' => $post, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
         // Validate the incoming data
         $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($post->image && File::exists(public_path('images/' . $post->image))) {
                File::delete(public_path('images/' . $post->image));
            }

            // Save the new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            // If no new image is uploaded, keep the current image
            $imageName = $post->image;
        }

        // Update the post details
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $imageName, // Update the image if necessary
        ]);

        // Sync the tags with the post
        // The sync method updates the pivot table to match the provided array of tag IDs
        $post->tags()->sync($request->input('tags', [])); // Use empty array if no tags are provided

        // Redirect with success message
        return redirect()->route('admin_posts_index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin_posts_index');
    }
}
