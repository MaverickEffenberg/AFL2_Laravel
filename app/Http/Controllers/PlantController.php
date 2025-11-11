<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\Category;

use Illuminate\Http\Request;

class PlantController extends Controller
{

    public function shop(Request $request)
{
    $search = $request->query('search'); // get search keyword

    if ($search) {
        $plants = Plant::where('name', 'like', "%{$search}%")->get();
    } else {
        $plants = Plant::all();
    }

    return view('store', compact('plants', 'search'))->with('title', 'Store');

}

    // List all plants
    public function home()
    {
        $plants = Plant::all();

        return view('home', compact('plants'));
    }
    public function index()
    {
        $plants = Plant::all();
        $plants = Plant::with('category')->get();
        return view('plants.index', compact('plants'));
    }

    // Show form to create new plants
   public function create()
{
    $categories = Category::all(); // pass all categories
    return view('plants.create', compact('categories'));
}


    // Store new plants
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image_url' => 'required',
            'category_id' => 'required',
            'stock' => 'required',
            'price' => 'required'
        ]);

        Plant::create($request->all());

        return redirect()->route('plants.index')
                         ->with('success', 'Plant created successfully.');
    }

    // Show single plants
    public function show($id)
    {
        $plant = Plant::findOrFail($id);
        return view('plants.show', compact('plant'));
    }

    // Show edit form
    public function edit($id)
{
    $plant = Plant::findOrFail($id);
    $categories = Category::all();  // <-- important
    return view('plants.edit', compact('plant', 'categories'));
}

    // Update plants
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'image_url' => 'required|string',
            'category_id' => 'required',
            
            'stock' => 'required',
            'price' => 'required'],);

        $plant = Plant::findOrFail($id);
        $plant->update($request->all());

        return redirect()->route('plants.index')
                         ->with('success', 'Plant updated successfully.');
    }

    // Delete plants
    public function destroy($id)
    {
        $plants = Plant::findOrFail($id);
        $plants->delete();

        return redirect()->route('plants.index')
                         ->with('success', 'Plant deleted successfully.');
    }
}


