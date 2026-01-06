<?php

namespace App\Http\Controllers;

use App\Models\Blog;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', \App\Http\Middleware\CheckIfAdmin::class])->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data['user_id'] = Auth::id();


        // set published_at automatically when created
        $data['published_at'] = now();

        // Handle uploaded image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('blogs', 'public');
            $data['image_url'] = '/storage/' . $path;
        }

        Blog::create($data);

        return redirect()->route('blog')->with('success', 'Blog created.');
    }

    public function update(Request $request, Blog $blog)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

 

        // Handle image replacement
        if ($request->hasFile('image')) {
            // delete old image if exists
            if ($blog->image_url) {
                $old = ltrim(str_replace('/storage/', '', $blog->image_url), '/');
                Storage::disk('public')->delete($old);
            }
            $path = $request->file('image')->store('blogs', 'public');
            $data['image_url'] = '/storage/' . $path;
        }

        $blog->update($data);

        return redirect()->route('blog')->with('success', 'Blog updated.');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blog')->with('success', 'Blog deleted.');
    }
}
