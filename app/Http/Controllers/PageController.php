<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('home', [
            'title' => 'My Carnivlora'
        ]);
    }

    public function about()
    {
        return view('about', [
            'title' => 'About Us'
        ]);
    }
    public function profile()
    {
        return view('profile', [
            'title' => 'Profile'
        ]);
        
    }

    public function blog()
    {
        $blogs = \App\Models\Blog::latest()->paginate(10);

        return view('blog', [
            'title' => 'Blog',
            'blogs' => $blogs,
        ]);
    }
}
