<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Posts::paginate(10);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all();

        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:100', 'min:1'],
            'description' => ['required', 'string', 'min:1'],
            'category_id' => ['required', 'exists:categories,id'],
            'images' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048', 'required']
        ]);

        $image = $request->file('images');
        $imagePath = $image->store('public/images');

        $post = Posts::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'user_id' => auth()->user()->id,
            'images' => str_replace('public/', '', $imagePath)
        ]);

        return redirect()->route('posts.my_posts')->with('success', 'After successfully creating the post, you will need to wait for admin approval. Redirecting you to your dashboard.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('posts.show', [
            'posts' => Posts::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Posts::findOrFail($id);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Posts $post)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:100', 'min:1', Rule::unique('posts')->ignore($post)],
            'description' => ['required', 'string', 'min:1'],
            'category_id' => ['required', 'exists:categories,id'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // $imagePath = $image->store('images');
        }
        $post->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'image' => $image
        ]);

        return redirect()->route('categories.index')->with('success', 'Post has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Posts $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post has been deleted successfully.');
    }

    public function byUser(Posts $posts)
    {
        $user_id = auth()->user()->id;
        $posts = Posts::where('user_id', $user_id)
            ->get();

        return view('posts.my_posts', compact('posts'));
    }
}
